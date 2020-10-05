<?php
require 'config.php';
require 'getProjectInfo.php';

$monashId = $_SESSION['id'];
$timeSpent = $_POST['timespent'];
$comment = $_POST['task'];
$isComplete = null;

if(isset($_POST['isComplete'])){
    $isComplete = 1;
} else {
    $isComplete = 0;
}

$keepeye .="overview: ". $isComplete .",";
$sql = "INSERT INTO task (TaskID, MonashId, TeamID, ProjectID, TimeSpent, Comment, isComplete) VALUES ('','$monashId','$teamId','$projectId','$timeSpent','$comment', '$isComplete')";
$result = mysqli_query($db, $sql);

if ($result == false){
    header("Location: ../overviewEdit.php?name=".$name."&errno=f"); # add fail
} else{
    header("Location: ../overviewEdit.php?name=".$name."&O=".$isComplete."&errno=t"); # add successfull
}


