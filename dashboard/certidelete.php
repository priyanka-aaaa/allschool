<?php 
include('../includes/connection.php');

$id=$_GET["certificateid"];
$sql="delete from leaving_certificate where leave_id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: school-leaving-certificate.php");
