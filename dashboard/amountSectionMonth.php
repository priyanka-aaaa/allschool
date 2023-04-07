<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$session = $_POST["session"];
$section = $_POST["section"];
$class = $_POST["class"];
$month = $_POST["month"];

$sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and section_id='$section' and admission.school_id = '$school_id' and admission.session = '$session' and receipt.month = '$month'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $total = $row['SUM(receipt.total_paying_amount)'];
}
echo $total;
?>
