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

<?php include('header.php'); ?>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

<form method="post" action="/addCategoryHandler.php" enctype="multipart/form-data">
<h2> Add New Exercise Category </h2>
<div id="addCategory">
  <label for="category"><b>Exercise Category (i.e. Chest, Back)</b></label><br>
  <input type="text" placeholder="Enter Category" value="<?php echo isset($_SESSION['presets']['category']) ? $_SESSION['presets']['category'] : ''; ?>" name="category" required><br>
      
  <button type="submit">Submit</button>
  <button type="reset" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  <span class="register"> <a href="/exercises.php">Back to Exercises</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
