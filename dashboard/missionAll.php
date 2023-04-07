<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
include('../includes/connection.php');
$school_id = $_SESSION['id'];
$session = $_POST['session'];
$school_id = $_POST["school_id"];
$draw = $_POST['draw'];
$row = $_POST['start'];


$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = "id";
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = mysqli_real_escape_string($conn, $_POST['search']['value']);
$searchQuery = " ";
if ($searchValue != '') {
    $searchValue = trim($searchValue);
    $searchQuery = " and (
    class_name like '%" . $searchValue . "%' or 
    section like '%" . $searchValue . "%' or 
    name like '%" . $searchValue . "%' or
    father_name like '%" . $searchValue . "%' or 
    annual_package like '%" . $searchValue . "%' or 
    decided_Fee like '%" . $searchValue . "%' 
         ) ";
}
$sel = mysqli_query($conn, "SELECT  count(`admission`.`id`) AS allcount from admission left JOIN class on class.id = admission.class_id WHERE admission.school_id = '$school_id' and admission.session='$session'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
$sel = mysqli_query($conn, "SELECT  count(`admission`.`id`) AS allcount from admission left JOIN class on class.id = admission.class_id WHERE admission.school_id = '$school_id'  and admission.session='$session'" . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
$sql5 = "SELECT class.id, class.class_name, admission.* from admission left JOIN class on class.id = admission.class_id WHERE admission.school_id = '$school_id' and admission.session='$session'" . $searchQuery . " ORDER BY admission." . $columnName . " desc  limit " . $row . "," . $rowperpage;

$res5 = mysqli_query($conn, $sql5);
$data = array();
while ($row = mysqli_fetch_assoc($res5)) {
    $data[] = array(
        // "sr" => "",

        "id" => $row['id'],
        "class_name" => $row['class_name'],
        "section" => $row['section'],
        "name" => $row['name'],
        "father_name" => $row['father_name'],
        "annual_package" => $row['annual_package'],
        "decided_fee" => $row['decided_fee'],
        "sr_no" => $row['sr_no'],
        "admission_no" => $row['admission_no']
    );
}
echo  "sdfsdfsdfdfd";
echo "<pre>";
print_r($data);
die;
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
echo json_encode($response);
