<?php

session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div align='center' style="font-weight: bold;font-family:'Times New Roman', Times, serif"><br><br><br><br>
        <h2>Welcome To HomePage <br>SAJHA Courier Management Service</h2>
        <h4>The fastest courier service of Nepal</h4><br><br>
        <h3>DBMS MINI PROJECT</h3>
        <h6>By SUBRACE</h6>
    </div>
</body>
</html>