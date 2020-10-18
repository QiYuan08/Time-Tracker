<?php
session_start();

require 'config.php';
require 'teamInfoTeacherDis.php';

//known variables
$current_Monashid = $_SESSION['id'];
$current_ProjectID = $_GET['select'];
echo $current_Monashid;
echo $current_ProjectID;
echo $current_TeamID;
// if (empty($current_Monashid) || empty($current_ProjectID) || empty($current_TeamID)) {
//   exit('Key user data is empty. <br>Do NOT resubmit form data. The site requires data you entered earlier in order to be properly displayed.');
// }

//obtaining tasks
$sql_allTasks = "SELECT * FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID'";
$obj_allTasks = mysqli_query($db, $sql_allTasks);
$obj_allTasks_rows = mysqli_num_rows($obj_allTasks); //can be any numbers

//filtered data
//task table
// $TaskName_from_task = "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp'>";
// $TaskName_from_task .= "<thead>";
// $TaskName_from_task .= "<tr>";
// $TaskName_from_task .= "<th>";  //1st th
// $TaskName_from_task .= "<label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select' for='table-header'>";
// $TaskName_from_task .= "<input type='checkbox' id='table-header' class='mdl-checkbox__input' />";
// $TaskName_from_task .= "</label>";
// $TaskName_from_task .= "</th>";
// $TaskName_from_task .= "<th class='mdl-data-table__cell--non-numeric'>Task</th>"; //2nd th
// $TaskName_from_task .= "<th>Time to Spend</th>";  //3rd th
// $TaskName_from_task .= "</tr>";
// $TaskName_from_task .= "</thead>";
// $TaskName_from_task .= "<tbody>";
// //begin <tr> iteration
// $iter = 0
// while($current_row = mysqli_fetch_assoc($obj_allTasks)) {
//   $iter += 1;
//   $TaskName_from_task .= "<tr>";
//   $TaskName_from_task .= "<td class='mdl-data-table__cell--non-numeric'><label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select' for='row[" . $iter . "]'>"; //1st td
//   $TaskName_from_task .= "<md-checkbox type='checkbox' id='row[" . $iter . "]' class='mdl-checkbox__input' />"
//   $TaskName_from_task .= "</label></td>";
//   $TaskName_from_task .= "<td>" . $current_row['TaskTitle'] . "</td>";  //2nd td
//   $TaskName_from_task .= "<td>" . $current_row['IsComplete'] . "</td>"; //3rd td
//   $TaskName_from_task .= "</tr>";
// }
// $TaskName_from_task .= "</tbody>";
// $TaskName_from_task .= "</table>";

?>
