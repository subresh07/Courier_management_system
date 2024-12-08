<?php
require_once "dbconn.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Sanitize input
    $email = mysqli_real_escape_string($dbcon, $email);

    $qry = "SELECT * FROM `login` WHERE `email`='$email'";
    $run = mysqli_query($dbcon, $qry);

    if (!$run) {
        echo '<script>alert("Database error. Please try again later."); window.open("resetpswd.php", "_self");</script>';
        exit();
    }

    $row = mysqli_num_rows($run);
    if ($row < 1) {
        echo '<script>alert("Email not found. Please try again or create a new account."); window.open("resetpswd.php", "_self");</script>';
        exit();
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['u_id'];
        session_start();
        $_SESSION['gid'] = $id;
        header("Location: reset.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sajha Courier Service</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/brr.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
        }

        .card-header {
            background-color: #273c75;
            color: #fff;
            text-align: center;
        }

        .btn-primary {
            background-color: #e84118;
            border-color: #e84118;
        }

        .btn-primary:hover {
            background-color: #c23616;
            border-color: #c23616;
        }

        .text-primary {
            color: #273c75;
        }

        .text-danger {
            color: #e84118;
        }

        h1, p {
            text-align: center;
        }

        .header-links {
            text-align: right;
            margin-right: 40px;
            margin-top: 10px;
        }

        .header-links a {
            color: blue;
            font-weight: bold;
        }

        .card-body form p {
            color: #e84118;
            text-align: center;
        }

        .card-body form a {
            color: #e84118;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Verify Your Details</h2>
                <p>To Reset Your Password ⮯⮯</p>
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter email ID" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="submit" class="btn btn-primary" value="Verify">
                    </div>
                    <p class="text-center">Don't have an account? ⮞➤ <a href="register.php">Register here</a>.</p>
                </form>
                <div class="header-links text-center mt-3">
                    <h5><a href="index.php" class="btn btn-outline-primary">User_SignIn</a></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional, for certain components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
