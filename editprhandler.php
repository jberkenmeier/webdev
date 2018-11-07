<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$exercise = $_POST['exercise'];
$weight = $_POST['weight'];
$id = $_SESSION['id'];

$_SESSION['presets']['prweight'] = $weight;

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

if (empty($exercise)) {
    $_SESSION['messages'][] = "Exercise is required.";
    $bad = true;
}

if (empty($weight)) {
    $_SESSION['messages'][] = "Weight is required.";
    $bad = true;
}

if ($bad) {
  header('Location: /editprs.php');
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
unset($_SESSION['presets']);
if(!$dao->addPr($exercise, $weight, $id)){
    $_SESSION['messages'][] = "shit";
}
header('Location: /prs.php');
exit;