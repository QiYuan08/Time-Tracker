<?php
session_start();

if(isset($_GET["issue"])){

    if ($_SESSION['type'] == "Teacher"){
        header("Location: ../issueDescriptionTeacher.php?select=".$_GET['issue']);
    } else {
        header("Location: ../issueDescriptionStudent.php?select=".$_GET['issue']);
    }
    
}
 ?>