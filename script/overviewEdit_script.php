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
    <td colspan="6" style="text-align:center">You currently have no active task </td>
                </tr>';
}

# loop through every task for this member
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

    # print each task
    # when user click on delete button they will be direction to deleteRow page with taskId
    # to delete the row in db and then redirect back to this page
    $isComplete = $row['IsComplete'];
    $checkBox = "";
    $value;
    if ($isComplete == 1){
        $value = "Yes";  

    } else {
        $value = "No";
    }
    // onkeyup="return enter(event, this.getAttribute(id), document.getElementById(this.getAttribute("id").innerText)"
    $taskInfo .= '<tr>
                    <td><div contenteditable="false">' . $row['TaskTitle']  . '</td> 
                    <td><div contenteditable="false">' . $row['Note']  . '</td>
                    <td><div contenteditable="false">' . $row['ETA']  . '</td>
                    <td><div contenteditable="true" class="time" id='.$row['TaskID'].'>' . $row['TimeSpent'] .'</td>' .
                    '<form action="script/updateCheckbox.php?tId='. $row['TaskID'] .'&name='. $name .'" method="post">  
                        <td><button name="isComplete" value="'. $value . '" style="border: 2px solid #14E10C">' . $value . '</button></td>
                        <td><button name="deleteBtn" class="mdl-navigation__link">Delete Task</button></td>
                    </form>
                  </tr>';
    
    $totalHour += $row['TimeSpent'];

}


