<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('../dbconn.php');
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/1920_1080.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            padding-bottom: 80px; /* Ensure space below form for footer */
        }
        .navbar-custom {
            background-color: #343a40;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }
        .navbar-custom .navbar-nav .nav-item.active .nav-link {
            color: #f8f9fa;
        }
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .table thead th,
        .table tbody tr {
            background-color: #ffe599;
        }
        .table thead .heading {
            color: black;
        }
        .form-container {
            margin-top: 30px;
            margin-bottom: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        .form-container .form-control {
            margin-bottom: 10px;
        }
        .form-container .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="form-container">
            <form action="courier.php" method="POST" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th colspan="4" class="heading">Fill The Details Of Sender & Receiver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th colspan="2">SENDER</th>
                                <th colspan="2">RECEIVER</th>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="sname" placeholder="Sender Full Name" class="form-control" required></td>
                                <td>Name:</td>
                                <td><input type="text" name="rname" placeholder="Receiver Full Name" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type="text" name="semail" value="<?php echo htmlspecialchars($email); ?>" class="form-control" readonly></td>
                                <td>Email:</td>
                                <td><input type="email" name="remail" placeholder="Receiver Email" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Phone No.:</td>
                                <td><input type="number" name="sphone" placeholder="Sender Phone" class="form-control" required></td>
                                <td>Phone No.:</td>
                                <td><input type="number" name="rphone" placeholder="Receiver Phone" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><input type="text" name="saddress" placeholder="Sender Address" class="form-control" required></td>
                                <td>Address:</td>
                                <td><input type="text" name="raddress" placeholder="Receiver Address" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Weight (kg):</td>
                                <td><input type="number" name="wgt" placeholder="Weight in kg" class="form-control" required></td>
                                <td>Payment Id:</td>
                                <td><input type="number" name="billno" placeholder="Enter Transaction Number" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly></td>
                                <td>Items Image:</td>
                                <td><input type="file" name="simg" class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <input type="submit" name="submit" value="Place Order" class="btn btn-warning">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    // Validate and sanitize user inputs
    $sname = htmlspecialchars($_POST['sname']);
    $rname = htmlspecialchars($_POST['rname']);
    $semail = filter_var($_POST['semail'], FILTER_VALIDATE_EMAIL);
    $remail = filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL);
    $sphone = filter_var($_POST['sphone'], FILTER_SANITIZE_NUMBER_INT);
    $rphone = filter_var($_POST['rphone'], FILTER_SANITIZE_NUMBER_INT);
    $sadd = htmlspecialchars($_POST['saddress']);
    $radd = htmlspecialchars($_POST['raddress']);
    $wgt = filter_var($_POST['wgt'], FILTER_VALIDATE_FLOAT);
    $billn = htmlspecialchars($_POST['billno']);
    $newDate = date("Y-m-d", strtotime($_POST['date']));
    
    $imagenam = $_FILES['simg']['name'];
    $tempnam = $_FILES['simg']['tmp_name'];
    
    if ($imagenam) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($tempnam);
        if (in_array($file_type, $allowed_types) && $_FILES['simg']['size'] <= 5000000) {
            move_uploaded_file($tempnam, "../images/$imagenam");
        } else {
            echo "<script>alert('Invalid image file. Please upload a valid image.');</script>";
            exit();
        }
    } else {
        $imagenam = null;
    }

    // Prepare SQL statement
    $qry = $dbcon->prepare("INSERT INTO `courier` (`sname`, `rname`, `semail`, `remail`, `sphone`, `rphone`, `saddress`, `raddress`, `weight`, `billno`, `image`, `date`, `u_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $qry->bind_param("ssssssssisssi", $sname, $rname, $semail, $remail, $sphone, $rphone, $sadd, $radd, $wgt, $billn, $imagenam, $newDate, $uid);
    
    // Execute the query
    if ($qry->execute()) {
        echo "<script>alert('Order Placed Successfully :)'); window.location.href = 'courier.php';</script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }

    // Close the statement and connection
    $qry->close();
    $dbcon->close();
}
?>
