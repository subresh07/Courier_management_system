<?php
$dbcon = mysqli_connect('localhost', 'root', '', '23189651');

if ($dbcon === false) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
