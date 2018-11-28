<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header('Location: /index.php');
  exit;
}
?>

<html>
<head>

<title>MyWorkoutSpace</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css">
<link rel="icon" type="image/png" href="/images/icon3.png"/>

</head>
        
<body>

<?php include('header.php');
      include('nav.php'); 
      // include('subnav.php');
?>
            
<div class="columns">
  <div id="exercises">
    <a href="/exercises.php">My Exercises</a>
    <p>View and manage your exercises</p>
  </div>
  <div id="history">
    <a href="/history.php">My History</a>
    <p>View and manage your workout history</p>
  </div>
  <div id="prs">
    <a href="/prs.php">My PR's</a>
    <p>View and manage your pr's</p>
  </div>
  <div class="clear"></div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
