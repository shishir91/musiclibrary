<?php

    session_start();

    if (!$_SESSION['isLoggedIn']) {
        header('Location: index.php?page=login');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Library</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://kit.fontawesome.com/4474a89330.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #191414; */
            background-color: #262626;
        }

        .in {
            display: grid;
            place-items: center;
        }
    </style>
</head>

<body>
    <?php
    $name = $_SESSION['name'];

    include('Connection/connection.php');

    // if (isset($_GET['page'])) {
    //     $page = $_GET['page'];
    // } else {
    //     $page = 'home';
    // }
    include('subpages/dnav.php');
    echo "<br><br>";
    echo "<div class='in'>";
    echo "<h1 style = 'color:gray; font-weight: bold;'>Welcome back " . $name . "</h1>";
    include("subpages/$page.php");
    echo "</div>";
    ?>
</body>


</html>