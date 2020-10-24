<?php
/*
    This file is used to display project information and team information 
    of a user in the overview page
*/
require 'config.php'; # connect to db
require 'getProjectInfo.php'; # get the info of project

$projectId = $_SESSION['ProjectID'];
$taskInfo = "";    # string to echo taskInfo table
$name = $_GET['name'];
$id = $_GET['uid'];
$totalHour = 0;
$caption = "";
$keepeye = "";

/*
    Displaying taskInfo on html
*/
# get task for this student in this team
$sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$id'";
$result = mysqli_query($db, $sql);

# if this student has not done anything
if (mysqli_num_rows($result) == 0){
    $taskInfo = '<tr>
                    <td colspan="5" style="text-align:center">You currently have no active task </td>
                </tr>';
}

# loop through every task for this member
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

    $caption = '<caption>' . $name. ' tasks (view Only)</caption>'; # caption of the table

    # print each task
    $taskInfo .= '<tr>
                    <td>' . $row['TaskTitle']  . '</td>
                    <td>' . $row['Note']  . '</td> 
                    <td>' . $row['TimeSpent'] .'</td>
                    <td>' . $row['ETA'] .'</td>';
    
    # the checkbox for completed/incomplete task
    if ($row['IsComplete'] == 1){
        $taskInfo .= '<td><input type="checkbox" disabled="disabled" checked="checked">
                    </tr>';
    } else{
        $taskInfo .= '<td><input type="checkbox" disabled="disabled">
                    </tr>';
    }
                    
    
    $totalHour += $row['TimeSpent'];
}

mysqli_close($db);