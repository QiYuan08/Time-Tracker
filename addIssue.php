<!DOCTYPE html>
<?php 
session_start();
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Add report</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/createProject.css">
  </head>

  <body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	<div class="mdl-layout__header-row">
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" id = "homeButton" href="home.html">Home</a>
      </nav>
      <div class="mdl-tooltip" data-mdl-for="homeButton">
      Back to home
      </div>
    <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" id = "logout" href="">Log out</a>
      </nav>
      <div class="mdl-tooltip" data-mdl-for="logout">
      Log out
      </div>
  	</div>
  	</header>

    <div id = "header">
      <h3>Report an issue</h3>
    </div>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
            echo "<p align='center'> Fill in all fields! </p>";
        }
    }
    ?>
    <div class = "content">
    <form action=" " METHOD="POST">
      <div>
        <label for="issueTitle">Issue title:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="issueTitle" name="issueTitle">
        </div>
      </div>

      <div>
        <label for="id">Your student ID:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="id"  name="id">
        </div>
      </div>

      <div>
        <label for="description">Description:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="description"  name="description">
        </div>
      </div>

      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" name="cancel" ">
        Cancel
      </button>
      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"  name ="report"">
        Report
      </button>
      </form> 
      </div>
      <?php
    
    if(isset($_POST["report"])){
    // connect to db
        require 'script/config.php';
        $TeamId = intval($_GET['teamID']);
    //list of the variables inputted by the user
        $IssueTitle = $_POST["issueTitle"];
        $studentId = $_POST['id'];
        $issue = $_POST['description'];

        if(empty($IssueTitle)| empty($studentId)| empty($issue)) {
            header("Location: ./addIssue.php?error=emptyfields&teamID=".$TeamId."&issueTitle=".$IssueTitle."&id=".$studentId."&description=".$issue);
            //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that were filled before
            exit(); //exits the code when the user doesn't fill out all the inputs
        } else {
            $sql = "INSERT INTO issue (IssueId, MonashId, TeamId, Description, Title) VALUES ('','$studentId','$TeamId','$issue','$IssueTitle')";
            mysqli_query($db, $sql);
            header("Location: ./issuesNReports.php?teamID=".$TeamId); //ends the process for creating a new project
            exit(); //exits the code

        }
    } elseif(isset($_POST["cancel"])){
        header("Location: ./issuesNReports.php?teamID=".$TeamId);
        exit();
    } 
    ?>
    </div>
  </div>
  </body>
</html>
