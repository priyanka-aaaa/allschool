<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];

?>
<?php

include('../includes/connection.php');
$query = $conn->query("select * from teacher WHERE school_id='$school_id'");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "teacher_list " . date('Y-m-d') . ".csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w');
    // Set column headers 
    $fields = array('SR.', 'FULL NAME', 'EMAIL', 'PHONE', 'QUALIFICATION', 'SPECIALITY', 'DESCRIPTION', 'JOINING DATE', 'ADDRESS');
    fputcsv($f, $fields, $delimiter);
    $count = 1;
   
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        $date = $row['joining_date'];
        $dt = new DateTime($date);
        $dt->format('Y-m-d');
        $interval = $dt->diff(new DateTime());
        $lineData = array($count++, $row['fullname'], $row['email'], $row['phone'], $row['qualification'], $row['speciality'], $row['description'], $dt->format('Y-m-d'), $row['address'],);
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
