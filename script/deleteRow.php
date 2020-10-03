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
        header("Location: ../overviewEdit.php?name='$name'"); # send user back to overviewEdit.php
    }
} else {
    echo "<h2>Button not detected </h2>";
}