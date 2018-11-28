<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
}
$exercise = $_POST['exercise'];
$set = $_POST['set'];
$rep = $_POST['rep'];
$weight = $_POST['weight'];
$id = $_SESSION['id'];

$_SESSION['presets']['set'] = $set;
$_SESSION['presets']['rep'] = $rep;
$_SESSION['presets']['weight'] = $weight;

require_once 'Dao.php';
$dao = new Dao();
$bad = false;

if(empty($exercise)){
    $_SESSION['messages'][] = "Exercise is required.";
    $bad = true;
}

if (empty($set)) {
    $_SESSION['messages'][] = "Set is required.";
    $bad = true;
}

if (!is_numeric($set)) {
    $_SESSION['messages'][] = "Set needs to be a number.";
    $bad = true;
}

if (empty($rep)) {
    $_SESSION['messages'][] = "Rep is required.";
    $bad = true;
}

if (!is_numeric($rep)) {
    $_SESSION['messages'][] = "Rep needs to be a number.";
    $bad = true;
}

if (empty($weight)) {
    $_SESSION['messages'][] = "Weight is required.";
    $bad = true;
}

if (!is_numeric($weight)) {
    $_SESSION['messages'][] = "Weight needs to be a number.";
    $bad = true;
}


if ($bad) {
  header('Location: /addWorkout.php');
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
unset($_SESSION['presets']);
$dao->addWorkout($exercise, $set, $rep, $weight, $id);

header('Location: /history.php');
exit;