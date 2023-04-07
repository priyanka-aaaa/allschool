<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$month = $_POST["month"];
$mydate = $_POST["date"];
$class = $_POST["class"];
$section = $_POST["section"];
$session = $_POST["session"];
$date = date("Y-m-d", strtotime($mydate));
$sql = "SELECT SUM(total_paying_amount) from receipt where school_id='$school_id' and session='$session'";
if (!empty($_POST["month"])) {
    $sql = "SELECT SUM(total_paying_amount) from receipt where month='$month' and where school_id='$school_id' and session='$session'";
}
if (!empty($_POST["date"])) {
    $sql = "SELECT SUM(total_paying_amount) from receipt where date='$date' and where school_id='$school_id' and session='$session'";
}
if (!empty($_POST["class"]) && empty($_POST["section"])) {
    $sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and admission.school_id = '$school_id' and admission.session = '$session'";
}
//start class with section
if (!empty($_POST["class"]) && !empty($_POST["section"])) {
    $sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and section_id='$section' and admission.school_id = '$school_id' and admission.session = '$session'";
}
//end class with section 
if (!empty($_POST["class"]) && !empty($_POST["date"])) {
    $sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and receipt.date='$date' and admission.school_id = '$school_id' and admission.session = '$session'";
}
if (!empty($_POST["class"]) && !empty($_POST["month"])) {
    $sql = "SELECT SUM(receipt.total_paying_amount) FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where class.id='$class' and receipt.month='$month' and admission.school_id = '$school_id'
and admission.session = '$session'";
}
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $total = $row['SUM(total_paying_amount)'];
    if (!empty($_POST["class"])) {
        $total = $row['SUM(receipt.total_paying_amount)'];
    }
}
echo $total;
