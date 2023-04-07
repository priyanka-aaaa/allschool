<?php 
include('../includes/connection.php');

$id=$_GET["sessionid"];
$sql="delete from session where session_id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: session.php");
?>