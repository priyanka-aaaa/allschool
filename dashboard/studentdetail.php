<?php
session_start();
include('../includes/connection.php');
$roll_no = $_POST["roll_no"];
$admission_class = $_POST["admission_class"];
$studentdetail = $_POST["section"];
$session = $_SESSION["session"];
$sql2 = "select * from admission where roll_no='$roll_no' and class_id='$admission_class' and section_id='$studentdetail' and session='$session'";
$res2 = mysqli_query($conn, $sql2);
$count7 = mysqli_num_rows($res2);
if ($count7 == 0) {
echo "student is not exist";
die;
}
$allclass = array();
$response   = array();
$data = mysqli_fetch_array($res2);
$id = $data["id"];
$name = $data["name"];
$father_name = $data["father_name"];
$phone = $data["phone"];
$decided_fee = $data["decided_fee"];
$student_id = $data["id"];
$balance_amount = $data["balance_amount"];
$month = $data["month"];
$paid_amount = $data["paid_amount"];
$sql3 = "select * from receipt where student_id='$id'";
$res3 = mysqli_query($conn, $sql3);
echo $name . "&&" . $father_name . "&&" . $phone . "&&" . $decided_fee . "&&" . $student_id . "&&" . $balance_amount . "&&" . $month . "&&" . $paid_amount;
