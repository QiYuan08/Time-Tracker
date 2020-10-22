<?php
require 'config.php';
require 'getProjectInfo.php';

$monashId = $_SESSION['id'];
$ETA = $_POST['timespent'];
$title = $_POST['task'];
$isComplete = null;
$note = $_POST['desc'];

if(isset($_POST['isComplete'])){
    $isComplete = 1;
} else {
    $isComplete = 0;
}

$keepeye .="overview: ". $isComplete .",";
$sql = "INSERT INTO task (TaskID, ProjectID, TeamID, MonashID, TaskTitle, IsComplete, ETA, TimeSpent, Note) VALUES ('', '$projectId', '$teamId', '$monashId', '$title', '$IsComplete', '$ETA', 0,  '$note')";
$result = mysqli_query($db, $sql);

if ($result == false){
    header("Location: ../overviewEdit.php?name=".$name."&errno=f"); # add fail
} else{
    header("Location: ../overviewEdit.php?name=".$name. "&errno=t"); # add successfull
}


