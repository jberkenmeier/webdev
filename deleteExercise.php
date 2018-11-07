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

</head>
        
<body>

<?php 
    include('header.php');
    include('nav.php');
    require_once 'Dao.php';
    $dao = new Dao();
    // $categories = $dao->getCategories($_SESSION['id']);
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

<form method="post" action="/deleteExerciseHandler.php" enctype="multipart/form-data">
<h2> Delete Exercise </h2>
<div id="login">


<?php
  echo "<select name='title'>";
?>
<option value="">Exercise Title:</option>
<?php
foreach ($titles as $title) {
    echo "<option data-value='" . $title['exer_name'] . "'>" . $title['exer_name'] . "</option>";
    }
echo "</select>";

?><br><br>

  <button type="submit">Delete</button>
  <input type="button" onclick="location.href='/editExercise.php';" value="Cancel" />

</div>

<div id="bottom_login">
  <span class="register"><a href="/exercises.php">Back to exercises</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
