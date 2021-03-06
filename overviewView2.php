<?php
  session_start();
  require 'script/overview_script.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Overview-View | Student</title>
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
          <a class="mdl-navigation__link" href="overview.html">Return to Overview</a>
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
        <a class="mdl-navigation__link" href="visualisation.html">Visualisation</a>
        <?php
        if ($_SESSION['type'] == "Student"){
            $studentID = $_SESSION['id'];
            $projectID = $_GET['select'];
            //extracting data from the database
            $sql = "SELECT * FROM teammembers WHERE ProjectID='$projectID' AND MonashID=$studentID";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $teamID = $row['TeamID'];
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
              echo $projectInfo;
            ?>
            <!-- <div id="studentSort">
              <h1>Project Name : FIT2101 Assignment 1 
              <br>Teacher In Charge : Dr.Ema
              <br>Start Date : 1-Sep-2020
              <br>Due Date : 10-Sep-2020
              <br>
              <br>Team Name : Best Team
              <br>Team Members : Amy, Ben, Chris
              </h1>
            </div> -->
          </div>

<!-- Team Info -->
          <div id = outputArea>
            <table id = "studentOverview" class="mdl-data-table mdl-js-data-table mdl-data-table--2dp">
              <tr>
                <td>Name</td>
                <td>Time Spent</td>
                <!-- <td>Progress</td>  'ignore this for now' -->
                <td>View / Edit</td>
              </tr>
              <?php
                echo $teamInfo;
              ?>
              <!-- <tr>
                <td>Amy</td> 
                <td>Carry</td> 
                <td>57 Hours</td> 
                <td>100%</td> 
                <td><a href = "overviewEdit.html" target = "_self">Edit</a></td> 
              </tr>
              <tr>
                <td>Ben</td> 
                <td>Deadweight</td>
                <td>27 Hours</td>
                <td>1%</td>
                <td><a href = "overviewEdit.html" target = "_self">Edit</a></td>
              </tr>
              <tr>
                <td>Chris</td> 
                <td>ScrumMaster</td> 
                <td>1 Hours</td>
                <td>69%</td>
                <td><a href = "overviewEdit.html" target = "_self">Edit</a></td>
              </tr> -->
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
