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


<?php include('header.php'); ?>
<?php include('nav.php'); ?>



<div class="workouts">
  <div id="workout_column">
    <h5>WORKOUTS</h5>
        <ul>
            <li><a href="https://www.muscleandstrength.com/workouts/arnold-schwarzenegger-volume-workout-routines" target="_blank">Arnold Schwarzenegger</a></li>
            <li><a href="https://www.bodybuilding.com/fun/jay_cutler_olympia_training.htm" target="_blank">Jay Cutler </a></li>
            <li><a href="https://www.bodybuilding.com/content/ronnie-colemans-fitness-program.html" target="_blank">Ronnie Coleman </a></li>
            <li><a href="https://www.nerdfitness.com/blog/how-to-build-your-own-workout-routine/" target="_blank">Workout Guide </a></li>
        </ul>
  </div>
  <div id="workout_column">
     <h5>PRODUCTS</h5>
        <ul>
            <li><a href="https://www.highsnobiety.com/2017/07/05/best-workout-supplements/" target="_blank">What To Take? </a></li>
            <li><a href="https://www.theproteinworks.com/the-best-post-workout-supplements" target="_blank">Post Workout Supplement Guide </a></li>
            <li><a href="https://www.bodybuilding.com/store/" target="_blank">Bodybuilding.com Supplements </a></li>
            <li><a href="https://www.gnc.com/protein-fitness/" target="_blank">GNC.com Supplements </a></li>
        </ul>
  </div>
</div>


<?php include('footer.php'); ?>

</html>