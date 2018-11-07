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
    $categories = $dao->getCategories($_SESSION['id']);
?>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

<form method="post" action="/addExerciseHandler.php" enctype="multipart/form-data">
<h2> Add Exercise </h2>
<div id="login">

<?php
  echo "<select name='category'>";
?>
<option value="">Category</option>
<?php
foreach ($categories as $category) {
    echo "<option data-value='" . htmlentities($category['exer_category']) . "'>" . htmlentities($category['exer_category']) . "</option>";
    }
echo "</select>";

?>
<input type="button" onclick="location.href='/addCategory.php';" value="Add New Category" /><br>

  <label for="title"><b>Exercise Title</b></label><br>
  <input type="text" placeholder="Enter Exercise Title" value="<?php echo isset($_SESSION['presets']['title']) ? $_SESSION['presets']['title'] : ''; ?>" name="title" required><br>

  <label for="desription"><b>Exercise Description</b></label><br>
  <textarea id="desc" placeholder="Enter Exercise Description" name="description" required></textarea><br>

  <button type="submit">Submit</button>
  <button type="reset" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  <span class="register"><a href="/exercises.php">Back to Exercises</a> | <a href="/addWorkout.php">Back to Add Workout</a> | <a href="/editprs.php">Back to Add Prs</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
