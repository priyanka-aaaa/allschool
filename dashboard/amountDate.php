<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$session = $_POST["session"];
$mydate = $_POST["date"];
$date = date("Y-m-d", strtotime($mydate));
$sql = "SELECT SUM(total_paying_amount) from receipt where date='$date' and school_id='$school_id' and session='$session'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $total = $row['SUM(total_paying_amount)'];
}
echo $total;
?>
