<?php

    // Initialize DB variables:
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "prosys3";

    // Initialize DB connection:
    $error_msg = "Database connection failed.";
    $con    = mysqli_connect($host, $user, $pass, $db) or die ($error_msg);

    // Start session:
    session_start();

