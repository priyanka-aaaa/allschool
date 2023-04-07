<?php 
include('../includes/connection.php');

$id=$_GET["schoolid"];
$sql="delete from school where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: allschool.php");
?>