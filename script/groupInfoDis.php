<?php
require 'config.php';

//known variables
$current_Monashid = $_POST['Monashid'];
$current_ProjectID = $_POST['ProjectID'];
$current_TeamID = $_POST['TeamID'];
if (empty($current_Monashid) || empty($current_ProjectID) || empty($current_TeamID)) {
  exit('Key user data is empty. <br>Do NOT resubmit form data. The site requires data you entered earlier in order to be properly displayed.');
}

//obtaining specific return data
$sql_project = "SELECT * FROM project WHERE ProjectID='$current_ProjectID'";
$obj_from_project = mysqli_query($db, $sql_project);
$obj_from_project_rows = mysqli_num_rows($obj_from_project); //must be 1

$sql_teamlist = "SELECT * FROM teamlist WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID'";
$obj_from_teamlist = mysqli_query($db, $sql_teamlist);
$obj_from_teamlist_rows = mysqli_num_rows($obj_from_teamlist); //must be 1

// $sql_task = "SELECT * FROM task WHERE MonashID='$current_Monashid'";
// $obj_from_task = mysqli_query($db, $sql_task);
// $obj_from_task_rows = mysqli_num_rows($obj_from_task); //this varies


//filtered data
//project table
$obj_from_project_arr = mysqli_fetch_assoc($obj_from_project); //array of entries
$ProjectName_from_project = $obj_from_project_arr['Name'];
$MonashID_from_project = $obj_from_project_arr['MonashID'];
$UnitCode_from_project = $obj_from_project_arr['unitCode'];
$StartDate_from_project = $obj_from_project_arr['StartDate'];
$EndDate_from_project = $obj_from_project_arr['EndDate'];
$Summary_from_project = $obj_from_project_arr['Summary'];

//teamlist table
$TeamName_from_teamlist = $obj_from_teamlist['TeamName'];

//teammembers table
// $TeamMemberName_from_teammebmers

// //task table
// $TaskName_from_task = "<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">;
// $TaskName_from_task += "<thead>";
// $TaskName_from_task += "<tr>";
// $TaskName_from_task += "<th>";
// $TaskName_from_task += "<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="table-header">";
// $TaskName_from_task += "<input type="checkbox" id="table-header" class="mdl-checkbox__input" />";
// $TaskName_from_task += "</label>";
// $TaskName_from_task += "</th>";
// $TaskName_from_task += "<th class="mdl-data-table__cell--non-numeric">Task</th>";
// $TaskName_from_task += "<th>Time to Spend</th>";
// $TaskName_from_task += "</tr>";
// $TaskName_from_task += "</thead>";
// $TaskName_from_task += "<tbody>";
// //begin <tr> iteration
// $iter = 0
// while ($current_row = mysqli_fetch_assoc($obj_from_task)) {
//   $iter += 1;
//   $TaskName_from_task += "<tr>";
//   $TaskName_from_task += "<td class="mdl-data-table__cell--non-numeric"><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="row['$iter']">";
//   $TaskName_from_task += "<md-checkbox type="checkbox" id="row['$iter']" class="mdl-checkbox__input" />"
//   $TaskName_from_task += "</label></td>";
//   $TaskName_from_task += "<td>" . $current_row['TaskTitle'] . "</td>";
//   $TaskName_from_task += "<td>" . $current_row['IsComplete'] . "</td>";
//   $TaskName_from_task += "</tr>";
// }
// $TaskName_from_task += "</tbody>";
// $TaskName_from_task += "</table>";

?>
