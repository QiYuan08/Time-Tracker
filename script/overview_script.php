<?php
session_start();
# TODO: find a way to calculate progress in overview page.
# TODO: error checking for null query from db 
/*
    This file is used to display project information and team information 
    of a user in the overview page
*/
require 'config.php'; # connect to db
require 'getProjectInfo.php'; # retrive and get project info

/*
    Displaying teamInfo on html
*/
# query db to get studentId of every student in the team
$sql = "SELECT * FROM teammembers WHERE TeamID='$teamId'";
$result = mysqli_query($db, $sql);
while ($row =mysqli_fetch_assoc($result)) {  # add all the studentID into an array
    array_push($teamMembers, $row['MonashID']);
}

# loop through every member in the team to find their respective task
for ($i=0; $i < count($teamMembers); $i++){ 

    # get current student monasId from teamMembers array
    $current_monashId = $teamMembers[$i];
    $totalHour = 0; # total hour worked by a student

    # get task for all student in this team
    $sql = "SELECT * FROM task WHERE teamID='$teamId' AND ProjectID='$projectId' AND MonashID='$current_monashId'";
    $result = mysqli_query($db, $sql);

    # calculate total hour worked by student
    while($row = mysqli_fetch_assoc($result) ) { # loop through every row queried from task table

       
        if ($row['MonashID'] == $current_monashId){ # if got that student in query 
            $totalHour += $row['TimeSpent'];
        
        }
    }


    # query the other information of the student from user table
    $sql = "SELECT * FROM user WHERE MonashId='$current_monashId'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $teamInfo .= '<tr>
                    <td>' . $row['Fullname']  . '</td> 
                    <td>' . $totalHour .'</td>';
    
    if ($_SESSION['name'] == $row['Fullname']){ # if current student is user
        # allow user to edit
        $teamInfo .= '<td><a href = "overviewEdit.php?name='.$row['Fullname'] .'" target = "_self">Edit</a></td>'; 
    } else {
        # only allow user to view
        # sending the monash email for view page
        $teamInfo .= '<td><a href = "overviewView.php?name='.$row['Fullname'] .'&uid='. $current_monashId .'" target = "_self">View</a></td>'; 
    } 
    
    $teamInfo .= '</tr>';

}

mysqli_close($db);