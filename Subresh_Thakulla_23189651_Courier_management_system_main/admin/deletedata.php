<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}
?>

<?php
include('head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Delete Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .admintitle {
            background: #273c75;
            color: aliceblue;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .admintitle h1 {
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
        }

        .admintitle a {
            color: aliceblue;
            font-weight: bold;
            text-decoration: none;
        }

        .admintitle a:hover {
            text-decoration: underline;
        }

        .table-responsive {
            margin-top: 20px;
        }

        th {
            background-color: indigo;
            color: white;
        }

        th, td {
            text-align: center;
            vertical-align: middle;
        }

        img {
            max-width: 100px;
        }
    </style>
</head>
<body>

<div class="admintitle">
    <div class="d-flex justify-content-between">
        <a href="dashboard.php">Back to Dashboard</a>
        <h1>Search Data Information</h1>
        <a href="logout.php">Log_Out</a>
    </div>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Items Image</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Sender Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../dbconn.php');

            $qryd = "SELECT * FROM `courier`";
            $run = mysqli_query($dbcon, $qryd);

            if (mysqli_num_rows($run) < 1) {
                echo "<tr><td colspan='6'>No record found.</td></tr>";
            } else {
                $count = 0;
                while ($data = mysqli_fetch_assoc($run)) {
                    $count++;
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><img src="../images/<?php echo $data['image']; ?>" alt="pic" class="img-fluid" /></td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['semail']; ?></td>
                        <td><a href="datadeleted.php?bb=<?php echo $data['billno']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
