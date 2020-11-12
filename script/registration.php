<?php

if (!empty($_POST["signup"])){

    // connect to db
    require './config.php';

   //List of the variables inputted by the user 
   $FullName =$_POST["FullName"];
   $Username = $_POST["Username"];
   $Password = $_POST["Password"];
   $Email = $_POST["Email"];
   $MonashId = $_POST["MonashId"]; 


   // validate all the inputs are inputted
    if(empty($FullName) || empty($Username) || empty($Password) || empty($Email) || empty($MonashId)) {
        $type = $_POST["signup"];
        header("Location: ../signup.php?error=emptyfields&FullName=".$FullName."&Email=".$Email."&MonashId=".$MonashId."&Username=".$Username);
       //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that were filled before 
        //this excludes the password, for privacy reasons
        exit(); //exits the code when the user doesn't fill out all the inputs 

    } else {
      //checking if the username already exists in the system 
        $sql_u = "SELECT * FROM user WHERE Username='$Username'";
        $res_u = mysqli_query($db, $sql_u);
      //checking if the student already has an account
        $sql_Id = "SELECT * FROM user WHERE MonashId='$MonashId'";
        $res_Id = mysqli_query($db, $sql_Id);
       
        if (mysqli_num_rows($res_u)>0 || mysqli_num_rows($res_Id)>0) {
             header("Location: ../signup.php?error=takenUsername&FullName=".$FullName."&Email=".$Email); //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that didn't cause the error
            //this excludes the password, for privacy reasons
            exit(); //exits the code when the user doesn't fill out all the inputs 

        } else {
        //updating the database 
            $type = $_POST["signup"];
            $sql = "INSERT INTO user (FullName, Username, MonashId, Password, Email, type) VALUES ('$FullName','$Username','$MonashId','$Password','$Email','$type')";
            mysqli_query($db, $sql);
            header("Location: ../index.php"); //ends the process for registering 
            exit(); //exits the code 

        }


    }
    //closing the sql
    $db -> close();
} else{
    header("Location:http://monashtimetracker.42web.io/signup.php");
    exit();
}
    
?>