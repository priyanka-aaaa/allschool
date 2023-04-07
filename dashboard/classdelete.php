<?php 
include('../includes/connection.php');

$id=$_GET["id"];
$sql="delete from class where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: class.php");
?>