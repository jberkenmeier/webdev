<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: /index.php');
    exit;
  }
?>

<head>

<title>MyWorkoutSpace</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css">
<link rel="icon" type="image/png" href="/images/icon3.png"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/fadeout.js"></script>

</head>
        
<body>

<?php 
    include('header.php');
    include('nav.php');
    require_once 'Dao.php';
    $dao = new Dao();
    $exercises = $dao->getTitles($_SESSION['id']);
?>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

<form method="post" action="/editprhandler.php" enctype="multipart/form-data">
<h2> New Pr </h2>
<div id="addpr">

<?php

echo "<select name='exercise'>";
?>
<option value="">Select an exercise:</option>
<?php
foreach ($exercises as $exercise) {
    echo "<option value='" . htmlentities($exercise['exer_name']) . "'>" . htmlentities($exercise['exer_name']) . "</option>";
    }
echo "</select>";

?>
<input type="button" onclick="location.href='/addExercise.php';" value="Add New Exercise" /><br>

  <input type="text" placeholder="Enter Weight"  value="<?php echo isset($_SESSION['presets']['prweight']) ? $_SESSION['presets']['prweight'] : ''; ?>" name="weight" required><br>
  
  <button type="submit">Submit</button>
  <button type="reset" class="cancelbtn">Cancel</button><br><br>
</div>

<div id="bottom_login">
  <span class="register"> <a href="/prs.php">Back to PRs</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
