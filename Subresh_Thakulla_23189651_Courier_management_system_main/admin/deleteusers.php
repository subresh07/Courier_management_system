<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Delete User</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .admintitle {
            background-color: #4a148c;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            text-align: center;
        }
        .admintitle h1 {
            margin: 0;
            font-size: 2.5em;
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
        }
        .nav-link {
            color: aliceblue;
            font-size: 1.2em;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .table-container {
            margin: 30px auto;
            width: 80%;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 1.2em;
            color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="admintitle">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Showing All Users</h1>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary" href="dashboard.php">Back To Dashboard</a>
                    <a class="btn btn-danger ml-2" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container table-container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Users Name</th>
                        <th>Email Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../dbconn.php');
                    $qry = "SELECT * FROM `users`";
                    $run = mysqli_query($dbcon, $qry);

                    if (mysqli_num_rows($run) < 1) {
                        echo "<tr><td colspan='4' class='no-data'>There is no Data in Database</td></tr>";
                    } else {
                        $count = 0;
                        while ($data = mysqli_fetch_assoc($run)) {
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><a class="btn btn-danger btn-sm" href="usersdeleted.php?emm=<?php echo $data['email']; ?>">Delete User</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
