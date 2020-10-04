<?php

if (isset($_POST['loginBtn'])) {

    // connect to db
    require 'config.php';

    # var for login
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) { # if either field is empty
        header("Location: ../index.php?error=emptyfields");
        exit();

    } else { # check wif db for username and password
        
        # query db for infor user inputted
        $sql = "SELECT * FROM user WHERE Username='$username' AND Password='$password'";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);  // fetch array that consist of data of current row

        if ($resultCheck > 0) {  # if user found
            # start the session
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['MonashId'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['name'] = $row['Fullname'];
            
            # redirect user to homepage
            header("Location: ../home.php");
            exit();


        } else {  # if user not found 
            header("Location: ../index.php?error=userNull");
            exit();

        }

    }


} else {
    header("Location: ../index.php");
    exit();
}