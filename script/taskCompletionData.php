<?php
require 'config.php';

// prerequisite data
$current_Monashid = $_SESSION['id'];
$current_TeamID = $_GET['teamID'];
$current_ProjectID = $_GET['select'];

// obtaining tasks per team per project
$sql_taskPerTeam = "SELECT TimeSpent AND IsComplete FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID'";
$obj_taskPerTeam = mysqli_query($db, $sql_taskPerTeam);
// obtaining tasks per person per team per project
$sql_taskPerMember = "SELECT TimeSpent AND IsComplete FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID' AND MonashID = '$current_Monashid'";
$obj_taskPerMember = mysqli_query($db, $sql_taskPerMember);

// calculate completion percentage of the team
$totalTimePerTeam = 0;
$completedTimePerTeam = 0;
while ($taskPerTeam_row = mysqli_fetch_assoc($obj_taskPerTeam)) {
    $totalTimePerTeam += $taskPerTeam_row['TimeSpent'];
    if ($taskPerTeam_row['IsComplete'] == 1) {
        $completedTimePerTeam += $taskPerTeam_row['TimeSpent'];
    }
}
$taskPerTeamCompletionPercentage = completionPercentage($completedTimePerTeam, $totalTimePerTeam);

// calculate completion percentage of the teammember
$totalTimePerMember = 0;
$completedTimePerMember = 0;
while ($taskPerMember_row = mysqli_fetch_assoc($obj_taskPerMember)) {
    $totalTimePerMember += $taskPerMember_row['TimeSpent'];
    if ($taskPerMember_row['IsComplete'] == 1) {
        $completedTimePerMember += $taskPerMember_row['TimeSpent'];
    }
}
$taskPerMemberCompletionPercentage = completionPercentage($completedTimePerMember, $totalTimePerMember);

// functions
function completionPercentage($completedTimespan, $totalTimespan) {
    if ($totalTimespan == 0 && $completedTimespan == 0) {
        return 1;
    } else if ($totalTimespan == 0 || $completedTimespan == 0) {
        return 0;
    } else {
        return $completedTimespan/$totalTimespan;
    }
}
?>
