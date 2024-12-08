<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('../dbconn.php');

$idd = $_GET['sid'];
$uqry = "SELECT * FROM `courier` WHERE `c_id`='$idd'";
$run = mysqli_query($dbcon, $uqry);
$data = mysqli_fetch_assoc($run);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 70%;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }
        th {
            background-color: #00FF00;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }
        td input[type="text"],
        td input[type="number"],
        td input[type="date"],
        td input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        td input[type="submit"] {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        td input[type="submit"]:hover {
            background-color: #ff7f00;
        }
        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="editdata.php" method="POST" enctype="multipart/form-data">
        <table>
            <thead>
                <tr>
                    <th colspan="4">Update The Details As Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">SENDER</td>
                    <td colspan="2">RECEIVER</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="sname" value="<?php echo htmlspecialchars($data['sname']); ?>" required></td>
                    <td>Name:</td>
                    <td><input type="text" name="rname" value="<?php echo htmlspecialchars($data['rname']); ?>" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="semail" value="<?php echo htmlspecialchars($data['semail']); ?>" readonly></td>
                    <td>Email:</td>
                    <td><input type="text" name="remail" value="<?php echo htmlspecialchars($data['remail']); ?>" required></td>
                </tr>
                <tr>
                    <td>Phone No.:</td>
                    <td><input type="number" name="sphone" value="<?php echo htmlspecialchars($data['sphone']); ?>" required></td>
                    <td>Phone No.:</td>
                    <td><input type="number" name="rphone" value="<?php echo htmlspecialchars($data['rphone']); ?>" required></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" name="saddress" value="<?php echo htmlspecialchars($data['saddress']); ?>" required></td>
                    <td>Address:</td>
                    <td><input type="text" name="raddress" value="<?php echo htmlspecialchars($data['raddress']); ?>" required></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;"><hr></td>
                </tr>
                <tr>
                    <td>Weight:</td>
                    <td><input type="number" name="wgt" value="<?php echo htmlspecialchars($data['weight']); ?>" required></td>
                    <td>Receipt No.:</td>
                    <td><input type="number" name="billno" value="<?php echo htmlspecialchars($data['billno']); ?>" required></td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly></td>
                    <td>Items Image:</td>
                    <td><input type="file" name="simg"></td>
                </tr>
                <tr>
                    <td colspan="4" class="center">
                        <input type="hidden" name="idd" value="<?php echo htmlspecialchars($data['c_id']); ?>">
                        <input type="submit" name="submit" value="Update">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>
