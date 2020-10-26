<?php
require 'config.php';
require 'getProjectInfo.php';

$monashId = $_SESSION['id'];
$ETA = $_POST['timespent'];
$title = $_POST['task'];
$note = $_POST['desc'];

// $keepeye .="overview: ". $isComplete .",";
$sql = "INSERT INTO task (TaskID, ProjectID, TeamID, MonashID, TaskTitle, IsComplete, ETA, TimeSpent, Note) VALUES ('', '$projectId', '$teamId', '$monashId', '$title', 0, '$ETA', 0,  '$note')";
$result = mysqli_query($db, $sql);

if ($result == false){
    header("Location: ../overviewEdit.php?name=".$name."&errno=f"); # add fail
} else{
    header("Location: ../overviewEdit.php?name=".$name. "&errno=t"); # add successfull
}


