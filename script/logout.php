<?php

session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // bring user back to login page