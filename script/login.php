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
        $sql = "SELECT * FROM user WHERE username='$username' AND pwdUser='$password'";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {  # if user found
            # start the session
            session_start();
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $row['MonashId'];
            
            header("Location: ../homepage.html");
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