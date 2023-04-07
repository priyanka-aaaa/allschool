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
$role = $_SESSION['role'];
$session = $_SESSION["session"];
?>
<?php
include('../includes/connection.php');
    $query = $conn->query("select * from class WHERE school_id='$school_id' and session='$session'");
if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "class_list " . date('Y-m-d') . ".csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w');
    // Set column headers 
    if ($role == 'superadmin') {
    $fields = array('ID', 'SCHOOL', 'SESSION', 'CLASS NAME', 'ANUAL FEE');
    } else {
        $fields = array('ID', 'CLASS NAME', 'ANUAL FEE'); 
    }
    fputcsv($f, $fields, $delimiter);
$i=1;
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
            $lineData = array($i, $row['class_name'], $row['annual_fee']); 
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
