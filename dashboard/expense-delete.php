<?php 
include('../includes/connection.php');

$id=$_GET["expenseid"];
$sql="delete from expense where expense_id='$id'";
$res2 = mysqli_query($conn, $sql);
header("Location: expense.php");
