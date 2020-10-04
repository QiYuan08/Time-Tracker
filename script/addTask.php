<?php
require 'config.php';
require 'getProjectInfo.php';

$monashId = $_SESSION['id'];
$timeSpent = $_POST['timespent'];
$comment = $_POST['task'];
$isComplete = null;
if(!empty($_POST['isComplete'])){
    $iscomplete = true;
} else {
    $isComplete = false;
}

$sql = "INSERT INTO task (TaskID, MonashId, TeamID, ProjectID, TimeSpent, Comment) VALUES ('','$monashId','$teamId','$projectId','$timeSpent','$comment')";
$result = mysqli_query($db, $sql);

if ($result == false){
    header("Location: ../overviewEdit.php?name=".$name."&errno=f"); # add fail
} else{
    header("Location: ../overviewEdit.php?name=".$name."&errno=t"); # add successfull
}


