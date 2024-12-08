<?php
session_start();
if (isset($_SESSION['uid'])) {
    header('location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: grey;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            margin-top: 50px;
            max-width: 500px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .header-text {
            color: #00BCD4;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #2980b9;
            border-color: #2980b9;
            color: white;
        }
        .btn-custom:hover {
            background-color: #1a5276;
            border-color: #1a5276;
        }
        .footer-text {
            color: #00BCD4;
            font-weight: bold;
        }
        .footer-text a {
            color: #2980b9;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
        .btn-back-home {
            background-color: #e74c3c;
            border-color: #e74c3c;
            color: white;
            margin-bottom: 20px;
        }
        .btn-back-home:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .admin-header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center admin-header">
            <h5><a href="../index.php" class="btn btn-back-home">Back to Home</a></h5>
            <h1 class="header-text">Admin Login</h1>
            <p class="header-text">Welcome to SAJHA Courier</p>
        </div>
        <div class="login-container mx-auto">
            <h2 style="color: #2c3e50;">Admin Login</h2>
            <form action="adminlogin.php" method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="uname" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="login" class="btn btn-custom" value="Login" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include('../dbconn.php');
if (isset($_POST['login'])) {
    $ademail = $_POST['uname'];
    $password = $_POST['pass'];
    $qry = "SELECT * FROM `adlogin` WHERE `email`='$ademail' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        ?>
        <script>
            alert("Only admin can login.");
            window.open('adminlogin.php', '_self');
        </script>
        <?php
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['a_id'];
        $_SESSION['uid'] = $id;
        header('location:dashboard.php');
    }
}
?>
