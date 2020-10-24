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
                <form action="" method="post">
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
            <!-- This is originally the table area. -->
            <div id = 'outputArea'></div>
          </div>

          <!-- Edit Buttons -->
          <div class="mdl-cell mdl-cell--9-col">
            <div id="button1">
                <br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name='addStudent' >Add Student</button>
              </div>
            </form>
          </div>
          <!-- code for adding a student-->
          <?php
            if(isset($_POST['addStudent'])){
                header("Location: ../addStudent.php?teamID=".$_GET['teamID']);
                exit();
            }elseif(isset($_POST['delete'])){
               $MonashId = $_POST['delete'];
               // delete teammember from sql
               $sql_delete_teammember= "DELETE FROM teammembers WHERE MonashID='$MonashId'";
               $delete_teammember_action= mysqli_query($db, $sql_delete_teammember);
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
