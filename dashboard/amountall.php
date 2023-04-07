<?php
include('../includes/connection.php');
$school_id = $_POST["school_id"];
$session = $_POST["session"];
$sql90 = "SELECT SUM(total_paying_amount) from receipt where school_id='$school_id' and session='$session'";
$res90 = mysqli_query($conn, $sql90);
while ($row90 = mysqli_fetch_array($res90)) {
    $total = $row90['SUM(total_paying_amount)'];
    if (!empty($_POST["class"])) {
        $total = $row90['SUM(receipt.total_paying_amount)'];
    }
}
echo $total;
?>
