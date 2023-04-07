<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
include('../includes/connection.php');
$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"])) {
    $school_id = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
$allValues = $_POST["studentValue"];
$session = $_SESSION["session"];
//start for session 

$firstMonth = array("January", "February", "March");
$currentYear = date("Y");
$month = date('F');
if (in_array($month, $firstMonth)) {
    $secondYear =   $currentYear - 1;
    $totalSession = $secondYear . "-" . $currentYear;
    $nextSession = $secondYear + 1 . "-" . $currentYear + 1;
} else {
    $secondYear =   $currentYear + 1;
    $totalSession = $currentYear . "-" . $secondYear;
    $nextSession = $secondYear + 1 . "-" . $currentYear + 1;
}
//end for session 
$j = 0;
foreach ($allValues as $value) {
    $sql = "select * from admission where id='$value'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $class_id = $row['class_id'];
        $sql3 = "select * from class where id='$class_id'";   //1
        $res3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_assoc($res3)) {
            $current_class = $row3["class_name"];
        }
        switch ($current_class) {
            case "Pre-Nursery":
                $new_class = "Nursery";
                break;
            case "Nursery":
                $new_class = "LKG";
                break;
            case "LKG":
                $new_class = "1st Standard";
                break;
            case "1st Standard":
                $new_class = "2nd Standard";
                break;
            case "2nd Standard":
                $new_class = "3rd Standard";
                break;
            case "3rd Standard":
                $new_class = "4th Standard";
                break;
            case "4th Standard":
                $new_class = "5th Standard";
                break;
            case "5th Standard":
                $new_class = "6th Standard";
                break;
            case "6th Standard":
                $new_class = "7th Standard";
                break;
            case "7th Standard":
                $new_class = "8th Standard";
                break;
            case "8th Standard":
                $new_class = "9th Standard";
                break;
            case "9th Standard":
                $new_class = "10th Standard";
                break;
            case "10th Standard":
                $new_class = "11th Standard";
                break;
            case "11th Standard":
                $new_class = "12th Standard";
                break;
            case "12th Standard":
                $new_class = "nomore";
                break;
            default:
                echo "nomore";
        }
        $sql4 = "select * from class where class_name='$new_class' and school_id='$school_id' and session='$nextSession'";
        $res4 = mysqli_query($conn, $sql4);
        $countclass = mysqli_num_rows($res4);
        if ($countclass == 0) {
            $nowresult = "noclass" . "&&" . $new_class;
            echo $nowresult;
            die;
        }

        $numbers = mysqli_num_rows($res4);
        if ($numbers != 0) {
            while ($row4 = mysqli_fetch_assoc($res4)) {
                $totalId = $row4["id"];
            }
            $section = $row['section'];
            $name = $row["name"];
            $father_name = $row["father_name"];
            $mother_name = $row["mother_name"];
            $date_of_birth = $row["date_of_birth"];
            $phone = $row["phone"];
            $gender = $row["gender"];
            $aadhar_card = $row["aadhar_card"];
            $alt_phone = $row["alt_phone"];
            $whatsup = $row["whatsup"];
            $email = $row["email"];
            $address = $row["address"];
            $city = $row["city"];
            $dist = $row["dist"];
            $state = $row["state"];
            $annual_package = $row["annual_package"];
            $decided_fee = $row["decided_fee"];
            $roll_no = $row["roll_no"];
            $paid_amount = $row["paid_amount"];
            $balance_amount = $row["balance_amount"];
            $month = $row["month"];
            $date = $row["date"];
            $time = $row["time"];
            $sr_no = $row["sr_no"];
            $admission_no = $row["admission_no"];
            $remark = $row["remark"];
            $sql2 = "insert into admission(school_id, session,class_id,section_id,name,father_name,mother_name,date_of_birth,phone,gender,aadhar_card,alt_phone,whatsup,email,address,city,dist,state,annual_package,decided_fee,roll_no,balance_amount,date,sr_no,admission_no,remark)values(
                '$school_id','$nextSession','$totalId','$section','$name','$father_name','$mother_name','$date_of_birth','$phone','$gender','$aadhar_card','$alt_phone','$whatsup','$email','$address','$city','$dist','$state','$annual_package','$decided_fee','$roll_no','$decided_fee','$date','$sr_no','$admission_no','$remark')";


            if (mysqli_query($conn, $sql2)) {
             $j++;
            }
        }
    }
}
echo "success"."&&".$j;

