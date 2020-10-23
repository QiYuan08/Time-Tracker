<!DOCTYPE html>
<html>
<head>
  <title>Overview | Teacher</title>
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
        <?php echo "<a class='mdl-navigation__link' href=taskSummary.php?>Task Summary</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID={$_GET['teamID']}'>Issues and reports</a>"; ?>
      </nav>
    </div>

    <!-- Project Info -->
    <main class="mdl-layout__content">
      <div class="page-content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--2-col"></div>
          <div class="mdl-cell mdl-cell--8-col">
            <div id="studentSort">
              <!--getting the project information-->
              <?php
              session_start();

              $teamId = $_GET['teamID'];
              //extracting data from the database
              require 'script/config.php';
              $sql = "SELECT * FROM teamlist WHERE TeamID='$teamId'";
              $result = mysqli_query($db, $sql);
              $row = mysqli_fetch_assoc($result);
              $ProjectId = $row['ProjectID'];

              //extracting project information
              $sql2 = "SELECT * FROM project WHERE ProjectID='$ProjectId'";
              $result2 = mysqli_query($db, $sql2);
              $projectInfo = mysqli_fetch_assoc($result2);

              //extracting team information
              $sql3 = "SELECT * FROM teamlist WHERE TeamID='$teamId'";
              $result3 = mysqli_query($db, $sql3);
              $teamInfo = mysqli_fetch_assoc($result3);

              ?>
              <h1>Project Name: <?php echo $projectInfo['unitCode']." ".$projectInfo['Name']; ?>
                <br>Teacher In Charge:
                <?php
                $teacherInChargeID = $projectInfo['MonashID'];
                //to obtain teacher's name, head to user table:
                $sql_teacherName_from_user = "SELECT FullName FROM user WHERE MonashId='$teacherInChargeID'";
                $obj_teacherName_from_user = mysqli_query($db, $sql_teacherName_from_user);
                $teacherInCharge_fetch = mysqli_fetch_assoc($obj_teacherName_from_user);
                $teacherInCharge = $teacherInCharge_fetch['FullName'];
                echo $teacherInCharge;
                ?>
                <br>Start Date: <?php echo $projectInfo['StartDate']; ?>
                <br>Due Date: <?php echo $projectInfo['EndDate']; ?>
                <br>
                <br>Team Name: <?php echo $teamInfo['TeamName']; ?>
                <br>Team Members:
                <form action="" method="get">
                  <?php
                  $sql4 = "SELECT * FROM teammembers WHERE TeamID='$teamId' ";
                  $result4= mysqli_query($db, $sql4);
                  $output = ' ';
                  if(mysqli_num_rows($result4)== 0){
                    $output .= 'No team members in this team';
                  } else {
                    while($row = $result4->fetch_assoc()) {
                      $output .= '<span class="mdl-chip mdl-chip--contact">';
                      $output .= "<span class='mdl-chip__contact mdl-color--teal mdl-color-text--white material-icons'>";
                      $output .= 'person_outline';
                      $output .=  "</span>";
                      $output .= "<span class='mdl-chip__text'>";
                      $output .= $row["Name"];
                      $output .= '</span>';
                      $output .= "</span>";
                      $output .= "<button class='material-icons' name='delete' id='delete' type='submit' value={$row['MonashID']}>delete</button>";
                      $output .= '<br>';
                    }
                  }
                  echo $output;
                  ?>
                
                
              </h1>
            </div>
          </div>

          <!-- Team Info -->
          <div class="mdl-cell mdl-cell--8-col" align="center">

            <div id = 'outputArea'>
              <?php
              

              //known variables
              $current_Monashid = $_SESSION['id'];
              $current_TeamID = $_GET['teamID'];
                if (empty($current_Monashid) || empty($current_TeamID)) {
                exit('Key user data is empty. <br>Do NOT resubmit form data. The site requires data you entered earlier in order to be properly displayed.');
              }
              //obtaining tasks
              $sql_ProjectID = "SELECT ProjectID FROM teamlist WHERE TeamID='$current_TeamID'";
              $obj_ProjectID = mysqli_query($db, $sql_ProjectID);
              $current_ProjectID_fetch = mysqli_fetch_assoc($obj_ProjectID);
              $current_ProjectID = $current_ProjectID_fetch['ProjectID'];

              $sql_allTasks = "SELECT * FROM task WHERE ProjectID='$current_ProjectID' AND TeamID='$current_TeamID'";
              $obj_allTasks = mysqli_query($db, $sql_allTasks);
              $obj_allTasks_rows = mysqli_num_rows($obj_allTasks); //can be any numbers

              //filtered data
              //task table
              $TaskName_from_task = "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp' align='center'>";
              $TaskName_from_task .= "<thead>";
              $TaskName_from_task .= "<tr>";
              $TaskName_from_task .= "<th>";  //1st th
              $TaskName_from_task .= "<label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select' for='table-header'>";
              $TaskName_from_task .= "<input type='checkbox' id='table-header' class='mdl-checkbox__input' />";
              $TaskName_from_task .= "</label>";
              $TaskName_from_task .= "</th>";
              $TaskName_from_task .= "<th class='mdl-data-table__cell--non-numeric'>Task</th>"; //2nd th
              $TaskName_from_task .= "<th>Time to Spend</th>";  //3rd th
              $TaskName_from_task .= "</tr>";
              $TaskName_from_task .= "</thead>";
              $TaskName_from_task .= "<tbody>";
              //begin <tr> iteration
              $iter = 0;
              while($current_row = mysqli_fetch_assoc($obj_allTasks)) {
                $iter += 1;
                $TaskName_from_task .= "<tr>";
                $TaskName_from_task .= "<td class='mdl-data-table__cell--non-numeric'><label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select' for='row[" . $iter . "]'>"; //1st td
                $TaskName_from_task .= "<md-checkbox type='checkbox' id='row[" . $iter . "]' class='mdl-checkbox__input' />";
                $TaskName_from_task .= "</label></td>";
                $TaskName_from_task .= "<td>" . $current_row['TaskTitle'] . "</td>";  //2nd td
                $TaskName_from_task .= "<td>" . $current_row['IsComplete'] . "</td>"; //3rd td
                $TaskName_from_task .= "</tr>";
              }
              $TaskName_from_task .= "</tbody>";
              $TaskName_from_task .= "</table>";
              echo $TaskName_from_task;
              ?>
            </div>
          </div>

          <!-- Edit Buttons -->
          <div class="mdl-cell mdl-cell--9-col">
            <div id="button1">
                <br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name='addStudent' >Add Student</button>
              </div>
            
          </div>
          </form>
          <!-- code for adding a student-->
          <?php
            if(isset($_GET['addStudent'])){
                header("Location: ../addStudent.php?teamID=".$_GET['teamID']);
                exit();
            }elseif(isset($_GET['delete'])){
               $MonashId = $_GET['delete']; 
               $sql5= "DELETE FROM teammembers WHERE MonashID='$MonashId'";
               $result5= mysqli_query($db, $sql5);
               header("Location: ../overviewT.php?teamID=".$_GET['teamID']);
               exit();
            }
            ?>
          
        </div>
      </div>
    </main>
  </div>

</body>
</html>
