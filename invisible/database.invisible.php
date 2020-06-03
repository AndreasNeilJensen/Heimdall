<?php
    // Remember to change this according to your setup if you just downloaded this from my repository.
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "heimdall";

    $connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$connection){
        die("Connection failed: ".mysqli_connect_error());
    }
?>