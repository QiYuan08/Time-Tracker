<?php
if(isset($_POST["create"])){
  // connect to db
  require 'config.php';

  //list of the variables inputted by the user
  $ProjectName = $_POST["projectName"];
  $UnitCode = $_POST["unitCode"];
  $ProjectDesc = $_POST["projectDesc"];
  $StartDate = $_POST["startDate"];
  $DueDate= $_POST["dueDate"];

  if(empty($ProjectName) || empty($UnitCode) || empty($ProjectDesc) || empty($StartDate) || empty($DueDate)) {
    header("Location: ../createProject.php?error=emptyfields&projectName=".$ProjectName."&unitCode=".$UnitCode."&projectDesc=".$ProjectDesc."&startDate=".$StartDate."&dueDate=".$DueDate);
    //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that were filled before
    exit(); //exits the code when the user doesn't fill out all the inputs
  } else {
    $sql = "INSERT INTO project (ProjectID, Name, unitCode, StartDate, EndDate, Summary) VALUES ('','$ProjectName','$UnitCode','$StartDate','$DueDate', '$ProjectDesc')";
    mysqli_query($db, $sql);
    header("Location: ../home.php"); //ends the process for creating a new project
    exit(); //exits the code

  }
} elseif(isset($_POST["cancel"])){
    header("Location: ../home.php");
} else {
    header("Location: ../createProject.php");
    exit();
}

?>
