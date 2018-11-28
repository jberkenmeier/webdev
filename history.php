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
    // include('subnav.php');
    require_once 'Dao.php';
    $dao = new Dao();
    $lists = $dao->getHistoryList($_SESSION['id']);
?>

<!-- <div id="history_header">
    <h4> MY HISTORY </h4><br>
    <input type="button" onclick="location.href='/addWorkout.php';" value="Add New Workout" />
</div> -->

<div class = "exercise_nav">
    <p> MY HISTORY <p>

</div><br>

        
        
    <div id="exercise_btns">
        <input type="button" onclick="location.href='/addWorkout.php';" value="Add New Workout" />
    </div>

<div id="history_list">
    <?php


    echo "<table>
    <tr>
    <th>Date</th>
    <th>Exercise</th>
    <th>Set</th>
    <th>Rep</th>
    <th>Weight</th>
    </tr>";

    foreach ($lists as $list){
        echo "<tr>";
        echo "<td>" . htmlentities($list['hist_date']) . "</td>";
        echo "<td>" . htmlentities($list['hist_exercise']) . "</td>";
        echo "<td>" . htmlentities($list['hist_set']) . "</td>";
        echo "<td>" . htmlentities($list['hist_rep']) . "</td>";
        echo "<td>" . htmlentities($list['hist_weight']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    ?>
</div>


<?php include('footer.php'); ?>

</html>