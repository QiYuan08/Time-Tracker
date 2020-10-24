<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Add student</title>
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
        <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
      </nav>
      <div class="mdl-tooltip" data-mdl-for="logout">
      Log out
      </div>
  	</div>
  	</header>

    <div id = "header">
      <h3>Add new student</h3>
    </div>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
            echo "<p align='center'> Fill in all fields! </p>";
        } elseif($_GET['error'] == "notFound"){
            echo "<p align='center'> Student not found in the system! </p>";
        } elseif($_GET['error'] == "exists"){
            echo "<label align='center'> Student is already in a system! </label>";
        }
    }
    ?>
    <form action=" " method="post">
    <div class = "content">
      <div>
        <label for="unitCode">Student ID:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" name='studentId'>
        </div>
      </div>

      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" name='cancel' type='submit' ">
        Cancel
      </button>
      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" name='add' type='submit' ">
        Add
      </button>
      </div>
    </form>
    </div>
  </div>

  <?php 
  if(isset($_POST['add'])){
    require 'script/config.php';
    $studentId= $_POST['studentId'];
    $teamID = $_GET['teamID'];
    //getting the project ID 
    $sql = "SELECT * FROM teamlist WHERE TeamID='$teamID'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $ProjectID = $row['ProjectID'];
    if(empty($studentId)) {
        header("Location: ../addStudent.php?error=emptyfields&teamID=".$_GET['teamID']);
        //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that were filled before
        exit(); //exits the code when the user doesn't fill out all the inputs
    } else {
        //checks if student is in the system 
        $sql2 = "SELECT * FROM user WHERE MonashId='$studentId'";
        $result2 = mysqli_query($db, $sql2);
        $resultCheck = mysqli_num_rows($result2);
        if($resultCheck>0){
            //getting all the teams with this student 
            $sql3 = "SELECT * FROM teammembers WHERE MonashID='$studentId'";
            $result3 = mysqli_query($db, $sql3);
            while($row = $result3->fetch_assoc()) {
                $teamIdComp =$row['TeamID'];
                $sql4 = "SELECT * FROM teamlist WHERE TeamID='$teamIdComp'";
                $result4 = mysqli_query($db, $sql4);
                $comp = mysqli_fetch_assoc($result4);
                if($comp['ProjectID'] == $ProjectID){
                    header("Location: ../addStudent.php?error=exists&teamID=".$_GET['teamID']);
                    exit();
                }
            }
            //if the member is new to this project 
            // gets the name of the user from the user database
            $sql5 = "SELECT * FROM user WHERE MonashId='$studentId'";
            $result5 = mysqli_query($db, $sql5);
            $studentInfo = mysqli_fetch_assoc($result5);
            $studentName = $studentInfo['FullName'];
            $sql6 = "INSERT INTO `teammembers`(MemID, ProjectID, TeamID, MonashID, Name) VALUES (' ', '$ProjectID', '$teamID','$studentId','$studentName')";
            $result6 = mysqli_query($db, $sql6);
            header("Location: ../overviewT.php?teamID=".$_GET['teamID']);
            exit();
        } else {
            header("Location: ../addStudent.php?error=notFound&teamID=".$_GET['teamID']);
            exit();
        }
    }
  } elseif(isset($_POST['cancel'])){
       header("Location: ../overviewT.php?teamID=".$_GET['teamID']);
  }
  ?>
  </body>
</html>
