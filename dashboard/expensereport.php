<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];

?>
<?php

include('../includes/connection.php');
$query = $conn->query("select * from expense WHERE school_id='$school_id'");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "expense_list " . date('Y-m-d') . ".csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w');
    // Set column headers 
    $fields = array('SR.', 'EXPENSE TYPE', 'PURPOSE', 'AMOUNT', 'DESCRIPTION', 'PAYMENT MODE', 'PAYMENT STATUS', 'EXPENSE DATE');
    fputcsv($f, $fields, $delimiter);
    $count = 1;
   
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($count++, $row['expense_type'], $row['purpose'], $row['amount'], $row['description'], $row['payment_method'],  $row['payment_status'], $row['expense_date']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file 
    fseek($f, 0);

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer 
    fpassthru($f);
}
exit;
