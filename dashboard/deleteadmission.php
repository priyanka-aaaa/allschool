<?php 
include('../includes/connection.php');

$id=$_GET["admissionid"];
$sql="delete from admission where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: admission.php");
?>