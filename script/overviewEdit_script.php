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
    <td colspan="4" style="text-align:center">You currently have no active task </td>
                </tr>';
}

# loop through every task for this member
while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

    $caption = '<caption>' . $name. ' Tasks (view Only)</caption>';
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

    $taskInfo .= '<tr>
                    <td><div contenteditable="false">' . $row['TaskTitle']  . '</td> 
                    <td><div contenteditable="false">' . $row['TimeSpent'] .'</td>' .
                    '<form action="script/updateCheckbox.php?tId='. $row['TaskID'] .'&name='. $name .'" method="post">  
                        <td><button name="isComplete" value="'. $value . '" style="border: 2px solid #14E10C">' . $value . '</button></td>
                        <td><button name="deleteBtn" class="mdl-navigation__link">Delete Task</button></td>
                    </form>
                  </tr>';
    
    $totalHour += $row['TimeSpent'];
}






















// require 'config.php'; # connect to db
// require 'getProjectInfo.php'; # get the projectId, teamId from this file

// $taskInfo = "";    # string to echo taskInfo table
// $name = $_GET['name'];
// $totalHour = 0;
// $caption = "";

// /*
//     Displaying taskInfo on html
// */
// # get task for this student in this team
// $sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$id'";
// $result = mysqli_query($db, $sql);

// # if this student has not done anything
// if (mysqli_num_rows($result) == 0){
//     $taskInfo = '<tr>
//                     <td>You currently have no active task </td>
//                 </tr>';
// }

// # loop through every task for this member
// # print each task
// while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

//     $caption = '<caption>' . $name. ' Tasks (view Only)</caption>';
//     # to delete the row in db and then redirect back to this page
//     # give each checkbox checking when user update the checkbox
//     $isComplete = $row['isComplete'];
//     $taskInfo .= '<form action="script/updateCheckbox.php" method="post">';
//     $checkBox = "";
//     if ($isComplete == 1){
//         $checkBox = '<td><input type="checkbox" checked="true" name="isComplete" value="'. $row['TaskID'] .'"></td>';

//     } else {
//         $checkBox = '<td><input type="checkbox" name="isComplete" value="'. $row['TaskID'] .'"></td>';
//     }

//     $taskInfo .= '<tr>
//                     <td><div contenteditable>' . $row['Comment']  . '</td> 
//                     <td><div contenteditable>' . $row['TimeSpent'] .'</td>'
//                     . $checkBox .
//                     '<form action="script/deleteRow.php?tId='. $row['TaskID'] .'&name='. $name .'" method="post">'. 
//                     # when user click on delete button they will be direction to deleteRow page with taskId
//                     # to delete the row in db and then redirect back to this page
//                         '<td><button name="deleteBtn" class="mdl-navigation__link">Delete Task</button></td>
//                     </form>
//                   </tr>';
    
//     $totalHour += $row['TimeSpent'];
// }

// $taskInfo .= '<button name="updateBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="button1">Save</button>
//                 </form>';
//
// }

