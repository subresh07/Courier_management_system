<?php
include('dbconn.php');
session_start();
$userId = $_SESSION['gid'];

if (isset($_POST['submit'])) {
    $password = $_POST['pass'];

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the hashed password in the database
    $update_query = "UPDATE `login` SET `password` = ? WHERE `u_id` = ?";
    $stmt = $dbcon->prepare($update_query);
    $stmt->bind_param("si", $hashed_password, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>
            alert("Password Updated Successfully :)");
            window.open("logout.php", "_self");
        </script>';
        exit();
    } else {
        echo '<script>
            alert("Failed to update password. Please try again.");
            window.open("reset.php", "_self");
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password - Sajha Courier Service</title>
    <style>
        body {
            background-image: url('images/Reset.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #0066cc; /* Blue */
        }

        label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            font-weight: bold;
            color: #0066cc; /* Blue */
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #28a745; /* Green */
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker Green */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Set New Password</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="pass">New Password</label>
            <input type="password" id="pass" name="pass" placeholder="Enter new password" required />
            <input type="submit" name="submit" value="Update" />
        </form>
    </div>
</body>

</html>
