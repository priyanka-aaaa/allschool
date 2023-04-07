<?php
include('../includes/connection.php');
$class_name = $_POST["class"];
$session = $_POST["session"];
$school_id = $_POST["school_id"];
$sql2 = "select * from section where class_id='$class_name' and school_id='$school_id' and session='$session'";
$res2 = mysqli_query($conn, $sql2);
$count2 = mysqli_num_rows($res2);
$sql1 = "select * from class where id='$class_name' and school_id='$school_id' and session='$session'";
$res1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($res1);
if ($count2 == 0) {
    //start for giving roll no. to student
    $sql7 = "select * from admission where class_id='$class_name' and session_id='$session'";
    $res7 = mysqli_query($conn, $sql7);
    $count7 = mysqli_num_rows($res7);
    if ($count7 == 0) {
        $roll_no = 1;
    } else {
        $sql8 = "select MAX(roll_no) AS Higheststudent_no from admission where class_id='$class_name' and session_id='$session'";
      
        $res8 = mysqli_query($conn, $sql8);
        while ($data8 = mysqli_fetch_array($res8)) {
            $currentroll_no = $data8["Higheststudent_no"];
            $roll_no = $currentroll_no + 1;
        }
    }
    //end for giving roll no. to student
    echo $data1["annual_fee"] . "&&" . "no" . "&&" . $roll_no;
} else {
    echo $data1["annual_fee"] . "&&";
    $allclass = array();
?>
    <option value="">Select Section</option>
    <?php
    while ($data = mysqli_fetch_array($res2)) {
    ?>
        <option value="<?php echo $data["id"]; ?>"><?php echo $data["section"]; ?></option>
<?php
    }
}
?>