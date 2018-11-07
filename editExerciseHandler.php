<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$title = $_POST['title'];
$description = $_POST['description'];
$id = $_SESSION['id'];

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

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
if(!$dao->editExercise($title, $description, $id)){
    $_SESSION['messages'][] = "shit";
}
header('Location: /exercises.php');
exit;