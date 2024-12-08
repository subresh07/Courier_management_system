<?php
include "dbconn.php";
require_once "session.php";

// Initialize error message
$error = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data
    $qry = $dbcon->prepare("SELECT u_id, email, password FROM `login` WHERE `email`=?");
    $qry->bind_param("s", $email);
    $qry->execute();
    $result = $qry->get_result();   

    // Check if a user with the given email exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // Start session and store user data
            session_start();
            $_SESSION['uid'] = $row['u_id'];
            $_SESSION['email'] = $row['email'];

            // Redirect to home page upon successful login
            header("Location: home/home.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    // Close prepared statement
    $qry->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sajha Courier Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        .btn-danger {
            background-color: #e84118;
            border-color: #e84118;
        }

        .btn-danger:hover {
            background-color: #c23616;
            border-color: #c23616;
        }

        .text-primary {
            color: #273c75;
        }

        .text-danger {
            color: #e84118;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">SAJHA COURIER SERVICE</h1>
                <p>Nepal's Best Courier Service</p>
            </div>
            <div class="card-body">
                <h2 class="text-primary">Login</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <p class="text-danger">Please fill in your details ⮯⮯</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter username/email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <input type="submit" name="submit" class="btn btn-primary" value="Sign In">
                        <button type="button" onclick="window.location.href='resetpswd.php'" class="btn btn-danger">Reset Password</button>
                    </div>
                </form>
                <p class="text-danger">Don't have an account?⮞➤ <a href="register.php" class="text-primary">Register here</a>.</p>
                <div class="text-center">
                    <a href="admin/adminlogin.php" class="text-primary">Admin Login</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
