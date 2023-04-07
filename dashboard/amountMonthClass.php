<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$month = $_POST["month"];
$session = $_POST["session"];

$class = $_POST["class"];

    $sql = "SELECT SUM(total_paying_amount) from receipt where month='$month' and school_id='$school_id' and session='$session'";

$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $total = $row['SUM(total_paying_amount)'];
}
echo $total;
?>
