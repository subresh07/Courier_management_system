<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Item's Image</th>
                    <th>Sender Name</th>
                    <th>Receiver Name</th>
                    <th>Receiver Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../dbconn.php');

                if ($email) {
                    $qryy = $dbcon->prepare("SELECT * FROM `courier` WHERE `semail` = ?");
                    $qryy->bind_param("s", $email);
                    $qryy->execute();
                    $result = $qryy->get_result();

                    if ($result->num_rows < 1) {
                        echo "<tr><td colspan='6' class='text-center'>No record found..</td></tr>";
                    } else {
                        $count = 0;
                        while ($data = $result->fetch_assoc()) {
                            $count++;
                ?>
                            <tr>
                                <td><?php echo htmlspecialchars($count); ?></td>
                                <td>
                                    <?php if ($data['image']) { ?>
                                        <img src="../images/<?php echo htmlspecialchars($data['image']); ?>" alt="Item's Image" class="img-fluid" style="max-width: 100px;">
                                    <?php } else { ?>
                                        No Image Available
                                    <?php } ?>
                                </td>
                                <td><?php echo htmlspecialchars($data['sname']); ?></td>
                                <td><?php echo htmlspecialchars($data['rname']); ?></td>
                                <td><?php echo htmlspecialchars($data['remail']); ?></td>
                                <td>
                                    <a href="updationtable.php?sid=<?php echo htmlspecialchars($data['c_id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="deletecourier.php?bb=<?php echo htmlspecialchars($data['billno']); ?>" class="btn btn-sm btn-danger">Delete</a>
                                    <a href="status.php?sidd=<?php echo htmlspecialchars($data['c_id']); ?>" class="btn btn-sm btn-info">Check Status</a>
                                </td>
                            </tr>
                <?php
                        }
                    }
                    $qryy->close();
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No email found in session.</td></tr>";
                }

                $dbcon->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
