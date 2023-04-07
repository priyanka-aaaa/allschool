<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!class_exists('../PHPMailer\PHPMailer\Exception')) {
    include '../PHPMailer/config.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
}
include('../includes/connection.php');
$content = "";
$usertemp = "";
$balance_amount = $_POST["balance_amount"];
$decided_fee = $_POST["decided_fee"];
$student_id = $_POST["student_id"];
$total_paying_amount = $_POST["total_paying_amount"];
$school_id = $_POST["my_school_id"];
$convenience_charge_amount = $_POST["convenience_charge_amount"];
$exam_fee_amount = $_POST["paying_decided_amount"];
$names_arr = $_POST["fee_month"];
$fee_month = implode("  ,  ", $names_arr);
$remark = $_POST["remark"];
$session = $_POST["session"];
$online_payment_amount = $_POST["online_payment_amount"];
$offline_payment_amount = $_POST["offline_payment_amount"];
$checkbox2 = $_POST['payment_mode'];
$checkNumber = $_POST["checkNumber"];
$checkDate = $_POST["checkDate"];
$relation = $_POST["relation"];
$feeTaken = $_POST["feeTaken"];
$convenience_fee_month = $_POST["convenience_fee_month"];
$payment_mode = "";
foreach ($checkbox2 as $chk2) {
    $payment_mode .= $chk2 . ",";
}
date_default_timezone_set('Asia/Kolkata');
$datetime = date('Y-m-d H:i:s');
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$month = date('F', strtotime($datetime));
$paid_amount = $decided_fee - $balance_amount;
$sql10 = "INSERT INTO receipt(session,school_id,student_id,total_paying_amount,payment_mode,remark,convenience_charge_amount,exam_fee_amount,datetime,online_payment_amount,offline_payment_amount,month,date,checkNumber,checkDate,relation,feeTaken,convenience_fee_month,balance_amount,fee_month)VALUES('$session','$school_id','$student_id','$total_paying_amount','$payment_mode','$remark','$convenience_charge_amount','$exam_fee_amount','$datetime','$online_payment_amount','$offline_payment_amount','$month','$date','$checkNumber','$checkDate','$relation','$feeTaken','$convenience_fee_month','$balance_amount','$fee_month')";
$res10 = mysqli_query($conn, $sql10);
$lastid = mysqli_insert_id($conn);
$sql11 = "update admission set paid_amount='$paid_amount',balance_amount='$balance_amount' where id='$student_id'";

$sql13 = "select * from admission where id='$student_id'";
$res13 = mysqli_query($conn, $sql13);
while ($row13 = mysqli_fetch_assoc($res13)) {


    $name = $row13["name"];
    $father_name = $row13["father_name"];
    $section_id = $row13["section_id"];
    if ($section_id == 0) {
        $sectionName = "";
    } else {
        $sql15 = "select * from section where id='$section_id'";
        $res15 = mysqli_query($conn, $sql15);
        while ($row15 = mysqli_fetch_assoc($res15)) {

            $sectionName = $row15["section"];
        }
    }
    $roll_no = $row13["roll_no"];
    $classId = $row13["class_id"];
    $studentEmail = $row13["email"];
}

$res11 = mysqli_query($conn, $sql11);
echo $lastid;
$sql14 = "select * from class where id='$classId'";
$res14 = mysqli_query($conn, $sql14);
while ($row14 = mysqli_fetch_assoc($res14)) {
    $className = $row14["class_name"];
}
$sql12 = "select * from school where id='$school_id'";
$res12 = mysqli_query($conn, $sql12);
while ($row12 = mysqli_fetch_assoc($res12)) {
    $schoolLogo = $row12["logo"];
    $schoolName = $row12["name"];
    $schoolTagline = $row12["tagline"];
    $schoolAddress = $row12["address"];
    $schoolEmail = $row12["email"];
    $schoolWebsite = $row12["website"];
    $schoolPhone = $row12["phone"];
    $schoolaffiliation = $row12["schoolaffiliation"];
    $schoolAffiliation_id = $row12["affiliation_id"];
}
if ($studentEmail != "") {
    ob_start();
    include("../template/feepayment.php");
    $content .= ob_get_clean();
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = "parveenk.calinfo@gmail.com";
    $mail->Password = "xkevtiqawkkvhwya";
    $mail->setFrom("parveenk.calinfo@gmail.com", 'School');


    // $mail->Username = "priyanka.calinfo500@gmail.com";
    // $mail->Password = "aevpfxchwoxssndx";
    // $mail->setFrom("priyanka.calinfo500@gmail.com", 'School');


    $mail->addAddress("priyanka.calinfo500@gmail.com", 'School');
    // $mail->addAddress("alexios.maddex@moabuild.com", 'School');
    $mail->Subject = "Fee Receipt";
    $mail->Body = $content;
    $mail->send();
} else {
    ob_start();
    include("../template/feepayment.php");
    $content .= ob_get_clean();
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = "parveenk.calinfo@gmail.com";
    $mail->Password = "xkevtiqawkkvhwya";
    $mail->setFrom("parveenk.calinfo@gmail.com", 'School');
    $mail->addAddress("priyanka.calinfo500@gmail.com", 'School');
    $mail->Subject = "Fee Receipt";
    $mail->Body = $content;
    $mail->send();
}
//start for send mail to student
//end for send mail to student
