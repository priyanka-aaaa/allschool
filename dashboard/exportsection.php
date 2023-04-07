<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"])) {
    $school_id = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
$session = $_SESSION["session"];

?>
<?php

include('../includes/connection.php');
$query = $conn->query("SELECT section.*, class.class_name
FROM section
INNER JOIN class ON section.class_id=.class.id 
WHERE section.school_id = '$school_id' and section.session='$session'");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "section_list " . date('Y-m-d') . ".csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w');
    // Set column headers 
    $fields = array('ID',  'CLASS NAME', 'SECTION', 'INCHARGE', 'STUDENT ALLOWED');
    fputcsv($f, $fields, $delimiter);
    $i=1;
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
       
        $lineData = array( $i, $row['class_name'], $row['section'], $row['incharge'], $row['student_allowed']);
        fputcsv($f, $lineData, $delimiter);
        $i++;
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
