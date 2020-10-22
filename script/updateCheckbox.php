<?php
require 'config.php';

if (isset($_POST['deleteBtn'])){

    $taskId = $_GET['tId'];

    # query task table to delete this task
    $sql = "DELETE FROM task WHERE TaskID='$taskId'";
    $result = mysqli_query($db, $sql);
    
    if ($result == false) { # if deleted successfully
        echo "<h2>Failed to connect to MySQL </h2>";
        exit();    

    } else if ($result == true) {
        header("Location: ../overviewEdit.php?name=" . $name); # send user back to overviewEdit.php
    }

// when user click on save button 
// update that row accordingly
} else if (isset($_POST['isComplete'])){
    $taskId = $_GET['tId'];
    $name = $_GET['name'];
    $isComplete;

    # if click on yes button
    # change it to no
    if($_POST['isComplete'] == "Yes"){
        $isComplete = 0;
    } else {
        $isComplete = 1;
    }

    $sql = "UPDATE task SET IsComplete='$isComplete' WHERE TaskID='$taskId'";
    $result = mysqli_query($db, $sql);

    header("Location: ../overviewEdit.php?name=".$name, true); # refresh the page
    echo 'WADAFAK';

} else {
    header("Location: ../home.php?name=". $name); # refresh the page
}
