<?php
include '../includes/connection.php';
if (isset($_POST['submit'])) {
    $id = $_POST['valueid'];
    $fullname = $_POST['full-name'];
    $emails = $_POST['email'];
    $phones = $_POST['phone'];
    $qualifications = $_POST['qualification'];
    $specialitys = $_POST['speciality'];
    $descriptions = $_POST['description'];
    $joinings = $_POST['joining-date'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $subject = $_POST['subject'];
    $addresses = $_POST['address'];

    $queryResult = "UPDATE teacher set fullname='$fullname', email='$emails', phone = '$phones', qualification='$qualifications', speciality='$specialitys' , description='$descriptions', joining_date = '$joinings', dob = '$dob', aadhar = '$aadhar', subject = '$subject', address = '$addresses' WHERE id = '$id'";
    $result1 = mysqli_query($conn, $queryResult);

    if ($result1) {
        $msg = '<div class="alert alert-success" role="alert">
          Teacher update successfully!
        </div>';
      } else {
        $msg = '<div class="alert alert-danger" role="alert">
          Failed to update teacher!
        </div>';
      }
}
?>