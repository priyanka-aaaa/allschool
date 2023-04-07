<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
include('../includes/connection.php');
$school_id = $_SESSION['id'];
$id=$_POST["id"];
$sql="DELETE FROM admission WHERE id='$id'";


$res=mysqli_query($conn,$sql);


?>