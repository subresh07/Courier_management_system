<?php
include "dbconn.php";

// Initialize error message
$error = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $fullname = $dbcon->real_escape_string($_POST['name']);
    $phn = $dbcon->real_escape_string($_POST['ph']);
    $email = $dbcon->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if passwords match
    if ($password != $confirm_password) {
        $error = "Password mismatched!!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert into 'users' table
        $qry = $dbcon->prepare("INSERT INTO `users` (`email`, `name`, `pnumber`) VALUES (?, ?, ?)");
        $qry->bind_param("sss", $email, $fullname, $phn);
        $run = $qry->execute();

        if ($run) {
            // Insert into 'login' table
            $last_insert_id = $qry->insert_id;
            $psqry = $dbcon->prepare("INSERT INTO `login` (`email`, `password`, `u_id`) VALUES (?, ?, ?)");
            $psqry->bind_param("ssi", $email, $hashed_password, $last_insert_id);
            $psrun = $psqry->execute();

            if ($psrun) {
                // Registration successful, redirect to login page
                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed during login data insertion. Please try again.";
            }
        } else {
            $error = "Registration failed during user data insertion. Please try again.";
        }

        // Close prepared statements
        $qry->close();
        $psqry->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sajha Courier Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/brr.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color:green">Register</h2>
                <p>Please fill this form to create an account.</p>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Num.</label>
                        <input type="tel" name="ph" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-danger" value="Register">
                    </div>
                    <p>Already have an account? <a href="index.php" style="color: red;">Login here</a>.</p>
                </form>
            </div>
        </div>
        <hr>
        <p>Notice: If the email Id is registered before, it will not respond.</p>
        <p>In this case, reset your password or register with a different email Id....</p>
    </div>
</body>
</html>
