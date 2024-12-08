<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

if(isset($_POST['submit'])){

    include('../dbconn.php');
    $idd = $_POST['idd'];

    // Sanitize inputs
    $sname = mysqli_real_escape_string($dbcon, $_POST['sname']);
    $rname = mysqli_real_escape_string($dbcon, $_POST['rname']);
    $remail = filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL);
    $sphone = filter_var($_POST['sphone'], FILTER_SANITIZE_NUMBER_INT);
    $rphone = filter_var($_POST['rphone'], FILTER_SANITIZE_NUMBER_INT);
    $sadd = mysqli_real_escape_string($dbcon, $_POST['saddress']);
    $radd = mysqli_real_escape_string($dbcon, $_POST['raddress']);
    $wgt = filter_var($_POST['wgt'], FILTER_VALIDATE_FLOAT);
    $billn = mysqli_real_escape_string($dbcon, $_POST['billno']);
    $originalDate = $_POST['date'];
    $newDate = date("Y-m-d", strtotime($originalDate));

    // File upload handling
    $imagenam = $_FILES['simg']['name'];
    $tempnam = $_FILES['simg']['tmp_name'];
    $target_dir = "../images/";

    if (!empty($imagenam)) {
        $target_file = $target_dir . basename($imagenam);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($tempnam);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.');</script>";
            exit();
        }

        // Check file size
        if ($_FILES["simg"]["size"] > 5000000) { // 5MB
            echo "<script>alert('Sorry, your file is too large.');</script>";
            exit();
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            exit();
        }

        // Move uploaded file
        if (move_uploaded_file($tempnam, $target_file)) {
            // Success
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            exit();
        }
    } else {
        $imagenam = ""; // If no new image uploaded, keep the existing one
    }

    // Update query
    $qry = "UPDATE `courier` SET 
            `sname`='$sname',
            `rname`='$rname',
            `remail`='$remail',
            `sphone`='$sphone',
            `rphone`='$rphone',
            `saddress`='$sadd',
            `raddress`='$radd',
            `weight`='$wgt',
            `billno`='$billn',
            `image`='$imagenam',
            `date`='$newDate' 
            WHERE `c_id`='$idd'";

    $run = mysqli_query($dbcon, $qry);

    if($run){
        echo "<script>alert('Data Updated Successfully');</script>";
        echo "<script>window.open('home.php','_self');</script>";
    } else {
        echo "<script>alert('Error updating data.');</script>";
    }

    mysqli_close($dbcon);

}
?>
