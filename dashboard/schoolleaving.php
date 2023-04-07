<?php

// session_start();
// if (!isset($_SESSION['id'])) {
//     header("Location: ../login.php");
// }

include('../includes/connection.php');

$sr_no=$_POST["sr_no"];

$schoolid=$_POST["schoolid"];
$sql="select dist,date,name,date_of_birth,admission_no,father_name,mother_name from admission where sr_no='$sr_no' and school_id='$schoolid'";

$res = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($res)){

$dist=$row["dist"];
$date=$row["date"];
$name=$row["name"];
$date_of_birth=$row["date_of_birth"];
$admission_no=$row["admission_no"];
$father_name=$row["father_name"];
$mother_name=$row["mother_name"];


}
echo $dist."&&".$date."&&".$name."&&".$date_of_birth."&&".$admission_no."&&".$father_name."&&".$mother_name;