<?php
session_start();

if(isset($_GET["select"])){

    $_SESSION['ProjectID'] = $_GET['select'];

    if ($_SESSION['type'] == "Teacher"){
        header("Location: ../projectInfo.php?select=".$_GET['select']);
    } else {
        header("Location: ../overview.php??select=".$_GET['select']);
    }
    
}
 ?>