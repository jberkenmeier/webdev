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
    $prs = $dao->getPrs($_SESSION['id']);
?>

<div class = "exercise_nav">
    <p> MY PR's <p>        
</div><br>
        
<div id="exercise_btns">
    <input type="button" onclick="location.href='/editprs.php';" value="Add New Pr" />
</div>

<div id="exercise_content">
    
    <?php
    echo "<table>
    <tr>
    <th>Exercise</th>
    <th>Weight</th>
    </tr>";

    foreach ($prs as $pr){
    echo "<tr>";
    echo "<td>" . htmlentities($pr['pr_name']) . "</td>";
    echo "<td>" . htmlentities($pr['pr_value']) . "</td>";
    echo "</tr>";
    }
    echo "</table>";

    ?>
</div>






<?php include('footer.php'); ?>

</html>