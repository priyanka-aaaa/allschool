<?php 
include('../includes/connection.php');

$id=$_GET["classid"];
$sql="delete from class_name where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: class.php");
?>