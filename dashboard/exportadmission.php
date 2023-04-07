<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}

$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"]))  {
    $school_id = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
?>
<?php

include('../includes/connection.php');

$query = $conn->query("SELECT admission.*, class.id, class.class_name
FROM admission
LEFT JOIN class on admission.class_id = class.id
WHERE admission.school_id = '$school_id'");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "admission_list " . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');
  
    $fields = array('#','SESSION', 'CLASS NAME', 'SECTION', 'ROLL NO', 'STUDENT NAME', 'FATHER NAME', 'ANNUAL FEE', 'DECIDED FEE','PAID FEE', 'PENDING FEE');
    fputcsv($f, $fields, $delimiter);
    $count = 1;
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($count++, $row['session'], $row['class_name'], $row['section'], $row['roll_no'], $row['name'], $row['father_name'], $row['annual_package'], $row['decided_fee'], $row['paid_amount'], $row['balance_amount'],);
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
