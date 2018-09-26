<html>
<head>

<title>MyWorkoutSpace</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css">
<link rel="icon" type="image/png" href="/images/icon3.png"/>

</head>
        
<body>

<?php include('header.php'); ?>

<form action="/home.php">
<h2> REGISTER </h2>
<div id="login">
  <label for="username"><b>Username</b></label><br>
  <input type="text" placeholder="Enter Username" name="username" required><br>

  <label for="password"><b>Password</b></label><br>
  <input type="password" placeholder="Enter Password" name="password" required><br>
      
  <button type="submit">Register</button>
  <button type="button" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  <span class="register">Already a User? <a href="/index.php">Sign In</a></span>
</div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
