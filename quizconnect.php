<?php
    // Enable error reporting for mysqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Hostname
    $host = "localhost";
    // Username
    $user = "root";
    // Password
    $pass = "";
    // Database Name
    $db   = "textgame";
    // Establish database connection
    $con = new mysqli($host, $user, $pass, $db);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
?>