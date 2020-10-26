<!DOCTYPE html>
<?php
    session_start();# get the session variable
    require 'script/config.php';
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Issues and reports</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/issues.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>

  <body>

  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	<div class="mdl-layout__header-row">
      <!-- Title -->
  	<span class="mdl-layout-title" > Issues and report </span>
    <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
      </nav>
      <div class="mdl-tooltip" data-mdl-for="logout">
      Log out
      </div>
  	</div>
  	</header>

    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="home.php">Home</a>
        <?php
        if ($_SESSION['type'] == "Teacher"){
            echo "<a class='mdl-navigation__link' href='overviewT.php?teamID={$_GET['teamID']}'>Overview</a>";
        } else if ($_SESSION['type'] == "Student"){
            $teamId = $_GET['teamID'];
            $studentID = $_SESSION['id'];
            //extracting data from the database
            $sql = "SELECT * FROM teamlist WHERE TeamID='$teamId'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $project = $row['ProjectID'];
            echo "<a class='mdl-navigation__link' href='overview.php?select={$project}'>Overview</a>";
        }?>
        <?php echo "<a class='mdl-navigation__link' href=taskSummary.php?teamID={$_GET['teamID']}>Task Summary</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID={$_GET['teamID']}'>Issues and reports</a>"; ?>

      </nav>
    </div>
    <div class="page-content">
        <div class="mdl-grid" id="">
            <form action="script/issueInfoDis.php" method="get">
            <div class="mdl-grid" id="">
    <?php
    $teamId = $_GET['teamID'];
    $sql2 = "SELECT * FROM issue WHERE TeamId='$teamId'";
    $result2 = mysqli_query($db, $sql2);
    $output = ' ';
    while($row = $result2->fetch_assoc()) {
        $output .= '<div class="mdl-cell mdl-cell--4-col">';
        $output .= '<div class="mdl-card mdl-shadow--2dp project">';
        $output .= '<div class="mdl-card__title mdl-card--expand">';
        $output .=  "<h3>{$row['Title']}</h3>";
        $output .= '</div>';
        $output .= '<div class="mdl-card__actions mdl-card--border" >';
        $output .= "<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' value={$row['IssueId']} name='issue'>";
        $output .= 'Select';
        $output .= '</button>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }
    echo $output;
    ?>
    </form>
    </div>
   </div>
    <!-- Accent-colored raised button -->
    <form action="" method="post">
    <?php

            # show fab button only if user is teacher
        if ($_SESSION['type'] == "Student"){
            echo '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" name="report">
                Report an issue
                </button>
                <div class="mdl-tooltip" data-mdl-for="report">
                Report an issue
            </div>';
            }
        ?>
    </form>
    <?php
     if(isset($_POST['report'])){
        header("Location: ./addIssue.php?teamID=".$_GET['teamID']);
        exit();
     }
    ?>
    </div>
  </div>
  </div>
  </body>
</html>
