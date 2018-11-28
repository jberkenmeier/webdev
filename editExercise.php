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
    $titles = $dao->getTitles($_SESSION['id']);
?>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

<form method="post" action="/editExerciseHandler.php" enctype="multipart/form-data">
<h2> Edit Exercise </h2>
<div id="login">


<?php
  echo "<select name='title'>";
?>
<option value="">Exercise Title:</option>
<?php
foreach ($titles as $title) {
    echo "<option data-value='" . htmlentities($title['exer_name']) . "'>" . htmlentities($title['exer_name']) . "</option>";
    }
echo "</select>";

?><br>

  <label for="description"><b>Exercise Description</b></label><br>
  <textarea id="desc" placeholder="Enter Exercise Description" value="<?php echo isset($_SESSION['presets']['desc']) ? $_SESSION['presets']['desc'] : ''; ?>" name="description" required></textarea><br>

  <button type="submit">Submit</button>
  <button type="reset" class="cancelbtn">Cancel</button>
  <input type="button" onclick="location.href='/deleteExercise.php';" value="Delete Exercise" />

</div>

<div id="bottom_login">
  <span class="register"><a href="/exercises.php">Back to exercises</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
