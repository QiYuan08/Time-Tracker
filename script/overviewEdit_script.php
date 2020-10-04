<?php
require 'config.php'; # connect to db
require 'getProjectInfo.php'; # get the projectId, teamId from this file

$taskInfo = "";    # string to echo taskInfo table
$name = $_GET['name'];
$totalHour = 0;
$caption = "";

/*
    Displaying taskInfo on html
*/
# get task for this student in this team
$sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$id'";
$result = mysqli_query($db, $sql);

# if this student has not done anything
if (mysqli_num_rows($result) == 0){
    $taskInfo = '<tr>
                    <td>You currently have no active task </td>
                </tr>';
}

# loop through every task for this member
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

    $caption = '<caption>' . $name. ' Tasks (view Only)</caption>';
    # print each task
    # when user click on delete button they will be direction to deleteRow page with taskId
    # to delete the row in db and then redirect back to this page
    $taskInfo .= '<tr>
                    <td><div contenteditable>' . $row['Comment']  . '</td> 
                    <td><div contenteditable>' . $row['TimeSpent'] .'</td>
                    <td><input type="checkbox" checked></td>
                    <form action="script/deleteRow.php?tId='. $row['TaskID'] .'&name='. $name .'" method="post">  
                        <td><button name="deleteBtn" class="mdl-navigation__link">Delete Task</button></td>
                    </form>
                  </tr>';
    
    $totalHour += $row['TimeSpent'];
}



