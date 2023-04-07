<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$session = $_POST["session"];
$section = $_POST["section"];
$rollno = $_POST["rollno"];
$mydate = $_POST["date"];
$date = date("Y-m-d", strtotime($mydate));
$class = $_POST["class"];
$sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and admission.section_id='$section' and admission.roll_no='$rollno' and admission.school_id = '$school_id' and admission.session = '$session' and receipt.date = '$date'";

$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $total = $row['SUM(receipt.total_paying_amount)'];
}
echo $total;
?>
