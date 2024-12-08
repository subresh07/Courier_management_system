<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('header.php');
include('../dbconn.php');
$id = $_SESSION['uid'];
$qry = "SELECT * FROM `users` WHERE `u_id`='$id'";
$run = mysqli_query($dbcon, $qry);
$data = mysqli_fetch_assoc($run);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9fa;
        }

        .profile-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background: linear-gradient(to right, #ee5a6f, #f29263);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
            padding: 30px 20px;
        }

        .profile-header img {
            border-radius: 50%;
        }

        .profile-header h3 {
            margin-top: 15px;
            font-weight: 600;
        }

        .profile-header p {
            margin-bottom: 0;
        }

        .profile-body {
            padding: 20px;
        }

        .profile-body h6 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .profile-body p {
            margin-bottom: 10px;
            color: #555;
        }

        .social-links {
            margin-top: 30px;
            text-align: center;
        }

        .social-links h6 {
            margin-bottom: 15px;
            font-weight: 600;
            color: #555;
        }

        .social-links a {
            margin: 0 10px;
            font-size: 20px;
            color: #555;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #ee5a6f;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" alt="User-Profile-Image">
                    <h3><?php echo $data['name']; ?></h3>
                    <p>User</p>
                </div>
                <div class="profile-body">
                    <h6>Information</h6>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Phone:</strong> <?php echo $data['pnumber']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="social-links">
                    <h6>hey! good people</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
