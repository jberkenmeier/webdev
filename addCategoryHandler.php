<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}

$category = $_POST['category'];
$id = $_SESSION['id'];
$_SESSION['presets']['category'] = $category;

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

if (empty($category)) {
    $_SESSION['messages'][] = "Exercise category is required.";
    $bad = true;
}


if($dao->checkCategory($category, $id)){
    $_SESSION['messages'][] = "Exercise category already exists";
    $bad = true;
}

if ($bad) {
  header('Location: /addCategory.php');
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
unset($_SESSION['presets']);
if(!$dao->addEmptyCategory($category, $id)){
    $_SESSION['messages'][] = "whoops";
}
header('Location: /addExercise.php');
exit;