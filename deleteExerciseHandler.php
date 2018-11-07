<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$title = $_POST['title'];
$id = $_SESSION['id'];

require_once 'Dao.php';
$dao = new Dao();

$dao->deletePrExercise($title, $id);
if(!$dao->deleteExercise($title, $id)){
    $_SESSION['messages'][] = "shit";
}
header('Location: /exercises.php');
exit;