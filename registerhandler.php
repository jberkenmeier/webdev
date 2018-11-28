<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$_SESSION['presets']['email'] = $email;
$_SESSION['presets']['name'] = $username;
$_SESSION['presets']['pass'] = $password;

require_once 'Dao.php';
$dao = new Dao();
$presets = array();
$bad = false;

if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)){ 
    $_SESSION['messages'][] = "Invalid email";
    $bad = true;
}


if (empty($email)) {
  $_SESSION['messages'][] = "Email is required.";
  $bad = true;
}

if(strlen($email) > 200){
  $_SESSION['messages'][] = "Email needs to be less than 200 characters";
  $bad = true;
}

if (empty($username)) {
  $_SESSION['messages'][] = "Name is required.";
  $bad = true;
}

if(strlen($username) > 100){
  $_SESSION['messages'][] = "Username needs to be less than 100 characters";
  $bad = true;
}

if (empty($password)) {
  $_SESSION['messages'][] = "Password is required.";
  $bad = true;
}

if(strlen($password) > 50){
    $_SESSION['messages'][] = "Password needs to be less than 50 characters";
    $bad = true;
}

if(strlen($password) < 8){
  $_SESSION['messages'][] = "Password needs to be 8 characters or more";
  $bad = true;
}

if($dao->checkRegistrationUsername($username)){
  $_SESSION['messages'][] = "Username already Exists";
  $bad = true;
}

if($dao->checkRegistrationEmail($email)){
    $_SESSION['messages'][] = "Email already Exists";
    $bad = true;
}


if ($bad) {
  header('Location: /register.php');
  $_SESSION['validated'] = 'bad';
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
$_SESSION['username'] = $username;
$_SESSION['logged_in'] = true;
$dao->addUser($email, $username, $password);
$_SESSION['id'] = $dao->getID($username);
unset($_SESSION['presets']);

header('Location: /home.php');
exit;