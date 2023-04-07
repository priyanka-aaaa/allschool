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
$sql = "SELECT admission.*, class.class_name FROM admission
INNER JOIN class ON admission.class_id=class.id
WHERE admission.school_id = '$school_id' and admission.session='$session'
";
$query = $conn->query($sql);
if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "Student_List " . date('Y-m-d') . ".csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w');
    // Set column headers 
    $fields = array(
        'ID',  'Class Id', 'Section', 'Name', 'Father Name', 'Mother Name', 'Date Of Birth',
        'Phone', 'Gender', 'Aadhar Card', 'Alt Phone', 'Whatsup', 'Email', 'Address', 'City', 'Dist', 'State', 'Annual Package',
        'Decided Fee', 'Roll No', 'Paid Amount', 'Balance Amount', 'Month', 'Data', 'Time', 'SRN', 'Admission Number', 'Remark'
    );
    fputcsv($f, $fields, $delimiter);
    $i = 1;
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        // $lineData = array($i, $row['class_name'], $row['section'], $row['incharge'], $row['student_allowed']);
        $lineData = array(
            $i, $row['class_name'], $row['section'], $row['name'], $row['father_name'], $row['mother_name'], $row['date_of_birth'], $row['phone'],
            $row['gender'], $row['aadhar_card'], $row['alt_phone'], $row['whatsup'], $row['email'], $row['address'], $row['city'], $row['dist'], $row['state'],   $row['annual_package'], $row['decided_fee'], $row['roll_no'],  $row['paid_amount'], $row['balance_amount'], $row['month'],  $row['date'], $row['time'], $row['sr_no'],  $row['admission_no'], $row['remark']
        );
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
