<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

include('../dbconn.php');

$idd = $_GET['sidd'];

$qryy = "SELECT * FROM `courier` WHERE `c_id`='$idd'";
$run = mysqli_query($dbcon, $qryy);
$data = mysqli_fetch_assoc($run);

$stdate = $data['date'];
$tddate = date('Y-m-d');

$statusMessage = ($stdate == $tddate) ? "On The Way..." : "Items Delivered<br>Have a nice day";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            background-color: red;
            text-align: center;
            padding: 20px;
            color: #ffffff;
            border-radius: 5px 5px 0 0;
        }

        .status-message {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            background-color: green;
            height: 60px;
            width: 130px;
            border-radius: 15px;
            cursor: pointer;
            border: none;
            color: white;
            font-size: 16px;
        }

        .button-container button:hover {
            background-color: #2e8b57;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <h1>Status >> <?php echo $statusMessage; ?></h1>
        <div class="status-message">
            <p><?php echo ($stdate == $tddate) ? "" : "HAVE A NICE DAY"; ?></p>
        </div>
        <hr>
        <div class="button-container">
            <button onclick="window.location.href='trackMenu.php'">Go Back</button>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
