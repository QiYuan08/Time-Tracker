<?php
    require 'script/overview_script.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Task Summary | Student</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
  <link rel="stylesheet" href="css/overview.css"> <!-- styles/overview.css -->
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#ffffff">
</head>

<!-- Header -->
<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Monash Time Tracker</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
        </nav>
      </div>
    </header>

<!-- Navigation drawer -->
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="home.php">Home</a>
        <?php echo "<a class='mdl-navigation__link' href='overviewT.php?teamID={$_GET['teamID']}'>Overview</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href='taskSummary.php?teamID={$_GET['teamID']}'>Task Summary</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID={$_GET['teamID']}'>Issues and reports</a>"; ?>
      </nav>
    </div>

<!-- Project Info -->
    <main class="mdl-layout__content">
      <div class="page-content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--2-col"></div>
          <div class="mdl-cell mdl-cell--8-col">
          <?php
            echo $projectInfo
          ?>
          </div>

<!-- Team Info -->
          <div id = outputArea>
            <table id = "studentTaskSummary" class="mdl-data-table mdl-js-data-table mdl-data-table--2dp">
              <tr style="background-color:DeepSkyBlue" font-weight="bold">
                <td>Task assigned to</td> <!-- student's name  -->
                <td>Task</td> <!-- student's task/tasks  -->
                <td>Task Description</td> <!-- description  -->
                <td>Est. Worktime</td> <!-- ETA  -->
                <td>Task Completion</td> <!-- checkbox  -->
              </tr>
              <?php
              require 'script/config.php';
              require 'script/taskCompletionData.php';
              //known variables
              $current_Monashid = $_SESSION['id'];
              $current_TeamID = $_GET['teamID'];

              if (empty($current_Monashid) || empty($current_TeamID)) {
                exit('Key user data is empty. <br>Do NOT resubmit form data. The site requires data you entered earlier in order to be properly displayed.');
              }

              //obtaining tasks
              // 1) SOLELY GETTING THE PROJECT ID
              // /* test **/ echo $current_Monashid; echo $current_TeamID;
              $sql_ProjectID = "SELECT ProjectID FROM teamlist WHERE TeamID='$current_TeamID'";
              $obj_ProjectID = mysqli_query($db, $sql_ProjectID);
              $current_ProjectID_fetch = mysqli_fetch_assoc($obj_ProjectID);
              $current_ProjectID = $current_ProjectID_fetch['ProjectID'];
              // 2) EXTRACTING ALL TASK INFORMATION
              $sql_allTasks = "SELECT * FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID'";
              $obj_allTasks = mysqli_query($db, $sql_allTasks);
              $obj_allTasks_rows = mysqli_num_rows($obj_allTasks); //can be any numbers
              // 3) EXTRACTING STUDENT FULLNAMES
              $sql_allStudents = "SELECT * FROM teammembers WHERE MonashID IN (SELECT MonashID FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID') AND TeamID='$current_TeamID'";
              $obj_allStudents = mysqli_query($db, $sql_allStudents);
              $obj_allStudents_rows = mysqli_num_rows($obj_allStudents); //no. of students
              // 3.5) SORTING FULLNAMES INTO ARRAY (FOR CHECKING NAME IN CORRS. w/ ID LATER IN THE NEXT WHILE LOOP)
              $students_id_arr = array();
              $students_name_arr = array();
              // This loop is for creating a synchronized array of student ID and names.
              while($current_row_student = mysqli_fetch_assoc($obj_allStudents)) {
                  array_push($students_id_arr, $current_row_student['MonashID']);
                  array_push($students_name_arr, $current_row_student['Name']);
              }

              //filtered data
              //task table
              $TaskName_from_task .= "<tbody>";
              //begin <tr> iteration
              $iter = 0;
              while($current_row_task = mysqli_fetch_assoc($obj_allTasks)) {
                // Prelimanary step 1) verify student name with id.
                $current_student_name = null;
                // figure out what is the current student name by searching in the array
                for ($inner = 0; $inner < count($students_id_arr); $inner++) {
                    if ($students_id_arr[$inner] == $current_row_task['MonashID']) {
                        $current_student_name = $students_name_arr[$inner];
                    }
                }
                // Prelimanary step 2) change isComplete's boolean appereance.
                $current_task_isComplete = $current_row_task['IsComplete'];
                if ($current_task_isComplete == 1) {
                    $current_task_isComplete = "Completed";
                } else {
                    $current_task_isComplete = "Incomplete";
                }
                // Prelimanary step 3) see if the name assigned with the task exist in teammember table
                // Student can be non-existant, so that they are null sometimes. This can happen as sometimes students may be removed from the group.
                // This is designed in a way given that all of the task data is not removed from the mysql even when one teammember is removed from the group.
                // This way, when the teammember is added back in, all task data can be restored back again.
                if ($current_student_name != null) {
                    $TaskName_from_task .= "<tr>";
                    $TaskName_from_task .= "<td class='mdl-data-table__cell--non-numeric'>" . $current_student_name . "</td>"; //1st td
                    $TaskName_from_task .= "<td>" . $current_row_task['TaskTitle'] . "</td>";  //2nd td
                    $TaskName_from_task .= "<td>" . $current_row_task['Note'] . "</td>"; //3rd td
                    $TaskName_from_task .= "<td>" . $current_row_task['TimeSpent'] . "</td>"; //4th td
                    $TaskName_from_task .= "<td>" . $current_task_isComplete . "</td>"; //5th td
                    $TaskName_from_task .= "</tr>";
                }
                $iter += 1;
              }
              $TaskName_from_task .= "</tbody>";
              echo $TaskName_from_task;
              echo '<p style="color:white"><b>Total task completion: ' . $taskPerTeamCompletionPercentage*100 . '%</b></p>';
              ?>
            </table>
          </div>

        </div>
      </div>
    </main>
  </div>
  <!-- <script src="scripts/shared.js" charset="utf-8"></script> -->
  <script src="scripts/overview.js"></script> <!-- no need to change ig?  -->
</body>
</html>
