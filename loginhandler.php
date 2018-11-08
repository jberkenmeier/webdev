<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['presets']['username'] = $username;
$_SESSION['presets']['password'] = $password;

require_once 'Dao.php';
$dao = new Dao();
$presets = array();
$bad = false;

if (empty($username)) {
    $_SESSION['messages'][] = "Name is required.";
    $bad = true;
}

if (empty($password)) {
    $_SESSION['messages'][] = "Password is required.";
    $bad = true;
}

if(!$dao->checkUserValidation($username, $password)){
    $_SESSION['messages'][] = "Something went wrong :(";
    $bad = true;
}


if ($bad) {
  header('Location: /index.php');
  $_SESSION['validated'] = 'bad';
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
$_SESSION['username'] = $username;
$_SESSION['id'] = $dao->getID($username);
$_SESSION['logged_in'] = true;
unset($_SESSION['presets']);
header('Location: /home.php');
exit;