<?php 
include('../includes/connection.php');

$id=$_GET["secid"];
$sql="delete from section where id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: section.php");
?>