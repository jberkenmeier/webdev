<?php
session_start();
?>

<html>
<head>

<title>MyWorkoutSpace</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css">
<link rel="icon" type="image/png" href="/images/icon3.png"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/fadeout.js"></script>

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

<form method="post" action="/registerhandler.php" enctype="multipart/form-data">
<h2> REGISTER </h2>
<div id="login">
  <label for="email"><b>Email</b></label><br>
  <input type="text" placeholder="Enter Email" value="<?php echo isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : ''; ?>" name="email" required><br>

  <label for="username"><b>Username</b></label><br>
  <input type="text" placeholder="Enter Username" value="<?php echo isset($_SESSION['presets']['name']) ? $_SESSION['presets']['name'] : ''; ?>" name="username" required><br>

  <label for="password"><b>Password</b></label><br>
  <input type="password" placeholder="Enter Password" value="<?php echo isset($_SESSION['presets']['pass']) ? $_SESSION['presets']['pass'] : ''; ?>" name="password" required><br>
      
  <button type="submit">Register</button>
  <button type="reset" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  <span class="register">Already a User? <a href="/index.php">Sign In</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
