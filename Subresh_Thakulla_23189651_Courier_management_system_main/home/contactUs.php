<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CDN link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Drop a Message</h2>
                        <p>We are waiting for your response..</p>
                    </div>
                    <div class="card-body">
                        <form action="contactUs.php" method="POST">
                            <div class="form-group">
                                <input class="form-control" name="email" type="email" placeholder="Email ID" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="subject" type="text" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Compose your message.." rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="send" class="btn btn-primary btn-block">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['send'])) {
    include('../dbconn.php');
    
    // Access user entered data
    $eml = $_POST['email'];
    $sub = $_POST['subject'];
    $msg = $_POST['message'];

    $qry = "INSERT INTO `contacts` (`email`, `subject`, `msg`) VALUES ('$eml', '$sub', '$msg')";
    $run = mysqli_query($dbcon, $qry);

    if ($run) {
        echo '<script>
                alert("Thanks, we will be looking at your concern :)");
                window.open("home.php", "_self");
              </script>';
    }
}
?>
