<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$category = $_POST['category'];
$title = $_POST['title'];
$desc = $_POST['description'];
$id = $_SESSION['id'];

$_SESSION['presets']['title'] = $title;
$_SESSION['presets']['category'] = $category;

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

if (empty($category)) {
    $_SESSION['messages'][] = "Category is required.";
    $bad = true;
}

if (empty($title)) {
    $_SESSION['messages'][] = "Title is required.";
    $bad = true;
}

if (empty($desc)) {
    $_SESSION['messages'][] = "Description is required.";
    $bad = true;
}

if($dao->checkTitle($category, $title, $id)){
    $_SESSION['messages'][] = "Exercise title already exists, use edit";
    $bad = true;
}

if ($bad) {
  header('Location: /addExercise.php');
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
$dao->addPrExercise($title, $id);
unset($_SESSION['presets']);
if(!$dao->addExercise($category, $title, $desc, $id)){
    $_SESSION['messages'][] = "shit";
}
header('Location: /exercises.php');
exit;