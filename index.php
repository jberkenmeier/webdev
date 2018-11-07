<?php
session_start();
?>

<head>

<title>MyWorkoutSpace</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css">
<link rel="icon" type="image/png" href="/images/icon3.png"/>

</head>
        
<body>

<?php include('loginHeader.php'); ?>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

<form method="post" action="/loginhandler.php" enctype="multipart/form-data">
<h2> LOGIN </h2>
<div id="login">
  <label for="username"><b>Username</b></label><br>
  <input type="text" placeholder="Enter Username"  value="<?php echo isset($_SESSION['presets']['username']) ? $_SESSION['presets']['username'] : ''; ?>" name="username" required><br>

  <label for="password"><b>Password</b></label><br>
  <input type="password" placeholder="Enter Password"  value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : ''; ?>" name="password" required><br>
      
  <button type="submit">Login</button>
  <button type="reset" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  <span class="register">Not a User? <a href="/register.php">Register</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
