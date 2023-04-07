<?php 
include('../includes/connection.php');

$id=$_GET["expenseid"];
$sql="delete from expense_type where expense_id ='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: expense_type.php");
?>