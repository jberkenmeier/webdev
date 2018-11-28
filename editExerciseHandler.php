<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$title = $_POST['title'];
$description = $_POST['description'];
$id = $_SESSION['id'];

$_SESSION['presets']['desc'] = $description;

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

if (empty($title)) {
    $_SESSION['messages'][] = "Title is required.";
    $bad = true;
}

if (empty($description)) {
    $_SESSION['messages'][] = "Description is required.";
    $bad = true;
}

if ($bad) {
  header('Location: /editExercise.php');
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
unset($_SESSION['presets']);
if(!$dao->editExercise($title, $description, $id)){
    $_SESSION['messages'][] = "whoops";
}
header('Location: /exercises.php');
exit;