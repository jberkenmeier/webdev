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


<?php 
    include('header.php');
    include('nav.php');
    require_once 'Dao.php';
    $dao = new Dao();
    $lists = $dao->getExerciseList($_SESSION['id']);
?>

<div class = "exercise_nav">
    <p> MY EXERCISES <p>

</div><br>
        
<div id="exercise_btns">
    <input type="button" onclick="location.href='/addExercise.php';" value="Add New Exercise" />
    <input type="button" onclick="location.href='/editExercise.php';" value="Edit Exercise" />
</div>

<div id="exercise_list">
<?php


    echo "<table>
    <tr>
    <th>Category</th>
    <th>Exercise</th>
    <th>Description</th>
    </tr>";

    foreach ($lists as $list){
    echo "<tr>";
    echo "<td>" . htmlentities($list['exer_category']) . "</td>";
    echo "<td>" . htmlentities($list['exer_name']) . "</td>";
    echo "<td>" . htmlentities($list['exer_description']) . "</td>";
    echo "</tr>";
    }
    echo "</table>";

    ?>
</div>

<?php include('footer.php'); ?>

</html>