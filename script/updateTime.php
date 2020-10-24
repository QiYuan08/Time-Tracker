<?php

require 'config.php';
require 'getProjectInfo.php';

$totalHour = 0;

if (isset($_GET['tId'])) {
    $taskId = $_GET['tId'];
    $time = $_GET['t'];

    $sql = "UPDATE task SET TimeSpent='$time' WHERE TaskID='$taskId'";
    $result = mysqli_query($db, $sql);


}

# get task for this student in this team
$sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$id'";
$result = mysqli_query($db, $sql);

# update total time spent for a astudent
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table
    
    $totalHour += $row['TimeSpent'];
}
echo $totalHour;