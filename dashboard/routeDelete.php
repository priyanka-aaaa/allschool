<?php 
include('../includes/connection.php');

$id=$_GET["id"];
$sql="delete from route where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: route.php");
?>