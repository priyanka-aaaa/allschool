<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
include('../includes/connection.php');
$school_id =$_POST["school_id"];
$session=$_POST["session"];
$class = $_POST["class"];
$roll_no = $_POST["roll_no"];
$section = $_POST["section"];
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = "id";
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = mysqli_real_escape_string($conn, $_POST['search']['value']);
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and (name like '%" . $searchValue . "%' 
         ) ";
}
$sel = mysqli_query($conn, "SELECT  count(`receipt`.`id`) AS allcount from receipt INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where admission.school_id = '$school_id' and admission.session = '$session' and class.id='$class'
and admission.section_id='$section' and admission.roll_no='$roll_no'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
$sel = mysqli_query($conn, "SELECT  count(`receipt`.`id`) AS allcount from receipt INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id where admission.school_id = '$school_id' and admission.session = '$session' and class.id='$class'
and admission.section_id='$section' and admission.roll_no='$roll_no'" . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
$sql5 = "SELECT receipt.id, receipt.date, admission.name, section.section as sectionname,receipt.total_paying_amount,receipt.balance_amount,receipt.remark,class.class_name FROM receipt
INNER JOIN admission ON receipt.student_id=admission.id
INNER JOIN class ON admission.class_id=class.id 
INNER JOIN section ON section.id=admission.section_id

where class.id='$class' and admission.section_id='$section'
and admission.roll_no='$roll_no' and admission.school_id = '$school_id' and admission.session = '$session'" . $searchQuery . " ORDER BY " . $columnName . " desc  limit " . $row . "," . $rowperpage;
$res5 = mysqli_query($conn, $sql5);
$data = array();
while ($row = mysqli_fetch_assoc($res5)) {
    $data[] = array(
        "id" => $row['id'],
        "datetime" => $row['date'],
        "name" => $row['name'],
        "class_name" => $row['class_name'],
        "section" => $row['sectionname'],


        "total_paying_amount" => $row['total_paying_amount'],
        "balance_amount" => $row['balance_amount'],
        "remark" => $row['remark'],
        "view" =>  '<a href="receipt.php?id=' . $row["id"] . '">view</a>',
    );
}
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
echo json_encode($response);
