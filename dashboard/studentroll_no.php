<?php
session_start();
include('../includes/connection.php');
$class = $_POST["class"];
$section = $_POST["section"];
$school_id = $_POST["school_id"];
$session = $_SESSION["session"];
$sql7 = "select * from admission where class_id='$class' and section_id='$section' and session='$session'";
$res7 = mysqli_query($conn, $sql7);
$sql11 = "select student_allowed from section where class_id='$class' and id='$section' and school_id='$school_id' and session='$session'";

$res11 = mysqli_query($conn, $sql11);

while ($row11 = mysqli_fetch_assoc($res11)) {
    $total_allowed = $row11["student_allowed"];
}

//start 
if ($total_allowed == "") {





    $sql8 = "select MAX(roll_no) AS Higheststudent_no from admission where class_id='$class' and section_id='$section' and session='$session'";
    $res8 = mysqli_query($conn, $sql8);
    while ($data8 = mysqli_fetch_array($res8)) {
        $roll_no = $data8["Higheststudent_no"];
        if ($roll_no == "") {
            echo 1;
        } else {

            echo $roll_no + 1;
        }
    }
  
}
//end
else {




    $count7 = mysqli_num_rows($res7);

    if ($count7 == 0) {
        echo  $roll_no = 1;
    } else {
        $sql8 = "select MAX(roll_no) AS Higheststudent_no from admission where class_id='$class' and section_id='$section' and session='$session'";
        $res8 = mysqli_query($conn, $sql8);
        while ($data8 = mysqli_fetch_array($res8)) {
            $roll_no = $data8["Higheststudent_no"];
            if ($roll_no == "") {
                echo 1;
            } else {
                if ($roll_no < $total_allowed) {
                    echo $roll_no + 1;
                } else {
                    echo "session is full";
                }
            }
        }
    }
}
