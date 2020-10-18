<?php
session_start();

require 'config.php';

$username = $_SESSION['username'];
$monashId = $_SESSION['id'];
$task = "";

# find the student with this username and monashId in task table
$sql = "SELECT * FROM yeamList WHERE MonashID='$monashId'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_row($result)){
        echo "<p>$task += $row[0] .",". $row[1] .",". $row[2] </p>";
    }
} else {
    $task = "<p>WADAFAKKK!!!!!</p>";
}


////////////////////////////////////////////////////////////////////////////////////////////////
<?php
# TODO: find a way to calculate progress in overview page.
# TODO: error checking for null query from db 
/*
    This file is used to display project information and team information 
    of a user in the overview page
*/
require 'config.php'; # connect to db

$taskInfo = "";    # string to echo taskInfo table
$id = $_GET['uid'];
$teamId = $_GET['tId'];
$projectId = $_GET['pId'];
$name = $_GET['name'];
$keepeye = "";
$keepeye .= $id . ", ";
$caption = "";

/*
    Displaying taskInfo on html
*/
# get task for this student in this team
$sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$id'";
$result = mysqli_query($db, $sql);

# loop through every task for this member
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

    $caption = '<caption>' . $name. ' Tasks (view Only)</caption>';
    # print each task
    $taskInfo .= '<tr>
                    <td><input type="text" disabled="disabled">' . $row['Comment']  . '</td> 
                    <td><input type="number" disabled="disabled">' . $row['TimeSpent'] .'</td>
                    <td><input type="checkbox" disabled="disabled" checked="checked">
                    </tr>';
}


