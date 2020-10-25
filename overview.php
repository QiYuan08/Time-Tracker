<?php
    require 'script/overview_script.php';
    session_start();# get the session variable
    require 'script/config.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Overview | Student</title>
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
        <a class="mdl-navigation__link" href="overview.php">Overview</a>
        
        <?php
        if ($_SESSION['type'] == "Student"){
            $studentID = $_SESSION['id'];
            $projectID = $_GET['select'];
            //extracting data from the database
            $sql = "SELECT * FROM teammembers WHERE ProjectID='$projectID' AND MonashID=$studentID";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $teamID = $row['TeamID'];
            echo "<a class='mdl-navigation__link' href='taskSummary.php?teamID={$teamID}'>Task Summary</a>";
            echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID={$teamID}'>Issues and reports</a>"; 
        }
        ?>
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
            <table id = "studentOverview" class="mdl-data-table mdl-js-data-table mdl-data-table--2dp">
              <tr>
                <td>Name</td>
                <td>Time Spent</td>
                <td>Task Completion</td> <!-- remove for now cuz dono how to calculate yet -->
                <td>View / Edit</td>
              </tr>
              <?php
                echo $teamInfo;
              ?>
            </table>
          </div>

        </div>
      </div>
    </main>
  </div>
  
  <!-- <script src="scripts/shared.js" charset="utf-8"></script> -->
  <script src="scripts/overview.js"></script>
</body>
</html>
