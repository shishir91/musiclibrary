<?php

    $servername = "localhost";
    $username = "root";
    $pwd = "";
    $dbname = "musicLibrary";

    //create a connection
    $conn = mysqli_connect($servername, $username, $pwd, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>