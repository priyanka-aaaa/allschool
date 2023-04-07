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
$session = $_SESSION["session"];
$role = $_SESSION["role"];
$currentClass = $_GET["class"];
$currentSection = $_GET["section"];
$sql9 = "select * from class where id='$currentClass'";
$res9 = mysqli_query($conn, $sql9);

while ($data9 = mysqli_fetch_assoc($res9)) {
    $currentClassName = $data9["class_name"];
}

$sql7 = "select * from section where class_id='$currentClass'";
$res7 = mysqli_query($conn, $sql7);


$sql4 = "select * from class WHERE school_id = $school_id and session='$session'";
$res4 = mysqli_query($conn, $sql4);
if (isset($_POST["submit"])) {
    $schoolid = $_SESSION['id'];
    $session = $_SESSION["session"];
    $class = $_POST["class"];
    $section = $_POST["section"];
    $nameold = $_POST["name"];
    $name = ucfirst($nameold);
    $father_nameold = $_POST["father_name"];
    $father_name = ucfirst($father_nameold);
    $mother_nameold = $_POST["mother_name"];
    $mother_name = ucfirst($mother_nameold);
    $date_of_birth = $_POST["date_of_birth"];
    $phone = $_POST["phone"];
    $genderold = $_POST["gender"];
    $gender = ucfirst($genderold);
    $aadhar_card = $_POST["aadhar_card"];
    $alt_phone = $_POST["alt_phone"];
    $whatsup = $_POST["whatsup"];
    $email = $_POST["email"];
    $addressold = $_POST["address"];
    $address = ucfirst($addressold);
    $cityold = $_POST["city"];
    $city = ucfirst($cityold);
    $distold = $_POST["dist"];
    $dist = ucfirst($distold);
    $stateold = $_POST["state"];
    $state = ucfirst($stateold);
    $roll_no = $_POST["roll_no"];
    $annual_package = $_POST["annual_package"];
    $decided_fee = $_POST["decided_fee"];
    if ($roll_no != "") {
        date_default_timezone_set('Asia/Kolkata');
        $sr_no = $_POST["sr_no"];
        $admission_no = $_POST["admission_no"];
        $adm_date = date("Y-m-d");
        $remark = $_POST["remark"];
        $sql6 = "insert into admission(school_id, session,class_id,section,name,father_name,mother_name,date_of_birth,phone,gender,aadhar_card,alt_phone,whatsup,email,address,city,dist,state,annual_package,decided_fee,roll_no,balance_amount,date,sr_no,admission_no,remark)values(
    '$schoolid','$session','$class','$section','$name','$father_name','$mother_name','$date_of_birth','$phone','$gender','$aadhar_card','$alt_phone','$whatsup','$email','$address','$city','$dist','$state','$annual_package','$decided_fee','$roll_no','$decided_fee','$adm_date','$sr_no','$admission_no','$remark')";
        $res6 = mysqli_query($conn, $sql6);
        if ($res6) {
            $msg = '<div class="alert alert-success" role="alert">
          Admission successfull!
        </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
          Failed to add Admission!
        </div>';
        }
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
    Failed to add Admission because this section is full!
  </div>';
    }
}
?>
<?php include 'header.php'; ?>
<style>
    .dropdown.class-dropdown {
        margin-bottom: 10px;
    }

    span.stu_current_class {
        color: green;
        font-family: "Poppins", sans-serif;
        padding: 20px 0 15px 0;
        font-size: 18px;
        font-weight: 600;
    }

    #studentAge {
        display: none;
    }

    .current_school_id {
        display: none;
    }

    button.dt-button.buttons-pdf.buttons-html5,
    button.dt-button.buttons-csv.buttons-html5 {
        border: #0dcaf0;
        background-color: #0dcaf0;
        /* color: black; */
        padding: 10px 20px;
        border-radius: 0.35rem;
        font-weight: bold;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <!-- <h1>All Student</h1> -->
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <span id="school_id" class="current_school_id"><?php echo $school_id; ?></span>
        <input type="hidden" id="current_session" value='<?php echo $session; ?>' />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title"> Students List of class
                                    <span class="stu_current_class">
                                        <?php echo $currentClassName; ?>
                                    </span>
                                    and section
                                    <span class="stu_current_class">
                                        <?php echo $currentSection; ?>

                                    </span>


                                </h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <div class="col-md-4 text-right ">

                                </div>
                                <!-- <a href="exportadmission.php" class="btn btn-success mt-3"><span><i class="bi bi-save2-fill"></i></span> Export Data</a> -->
                            </div>
                        </div>
                        <!-- start for select class -->





                        <div class="row">
                            <div class="col-md-3">
                                <div class="dropdown class-dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Select Class
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php
                                        $sql88 = "select * from class WHERE school_id = $school_id and session='$session'";
                                        $res88 = mysqli_query($conn, $sql88);
                                        while ($data88 = mysqli_fetch_assoc($res88)) { ?>
                                            <li><a class="dropdown-item" href="studentClass.php?class=<?php echo $data88["id"]; ?>"><?php echo $data88["class_name"]; ?></a></li>

                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Select Section
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php

                                        while ($data7 = mysqli_fetch_assoc($res7)) {


                                        ?>
                                            <li><a class="dropdown-item" href="studentSection.php?class=<?php echo $currentClass ?>&section=<?php echo $data7["section"]; ?>"><?php echo $data7["section"]; ?></a></li>

                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <!-- end for select class -->



                        <table class="table table-hover" id="studentList">
                            <thead>
                                <tr>
                                    <th scope="col"> <input type="checkbox" id="allStudentCheck" value="Bike"> Sr.No</th>

                                    <th scope="col">Class Name</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Father Name</th>
                                    <th scope="col">Annual Fee</th>
                                    <th scope="col">Discount Fee</th>
                                    <th scope="col">Admission No.</th>
                                    <th scope="col">Action</th>
                                    <th scope="col" style="display:none">Mother Name</th>
                                    <th scope="col" style="display:none">Date Of Birth</th>
                                    <th scope="col" style="display:none">Phone</th>
                                    <th scope="col" style="display:none">Gender</th>
                                    <th scope="col" style="display:none">Aadhar Card</th>
                                    <th scope="col" style="display:none">Alt Phone</th>
                                    <th scope="col" style="display:none">Whatsup</th>
                                    <th scope="col" style="display:none">Email</th>
                                    <th scope="col" style="display:none">Address</th>
                                    <th scope="col" style="display:none">City</th>
                                    <th scope="col" style="display:none">Dist</th>
                                    <th scope="col" style="display:none">State</th>
                                    <th scope="col" style="display:none">Annual Package</th>
                                    <th scope="col" style="display:none">Decided Fee</th>
                                    <th scope="col" style="display:none">Roll No</th>
                                    <th scope="col" style="display:none">Paid Amount</th>
                                    <th scope="col" style="display:none">Balance Amount</th>

                                    <th scope="col" style="display:none">Date</th>

                                    <th scope="col" style="display:none">SRN</th>
                                    <th scope="col" style="display:none">Admission No.</th>
                                    <th scope="col" style="display:none">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql5 = "SELECT class.id, class.class_name, admission.* from admission left JOIN class on class.id = admission.class_id WHERE admission.school_id = '$school_id' and admission.session='$session' and class_id='$currentClass' and section='$currentSection'
                                  order by admission.id desc";
                                $res5 = mysqli_query($conn, $sql5);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($res5)) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="myCheckboxes[]" id="vehicle1" name="vehicle1" class="vehicle1" value="<?php echo $row["id"]; ?>">

                                            <?php echo $i ?>
                                        </td>
                                        <td><?php echo $row["class_name"]; ?></td>
                                        <td><?php echo $row["section"]; ?></td>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["father_name"]; ?></td>
                                        <td><?php echo $row["annual_package"]; ?></td>
                                        <td><?php echo $row["decided_fee"]; ?></td>
                                        <td><?php echo $row["admission_no"]; ?></td>
                                        <td>
                                            <a target="_blank" href="studentView.php?studentId=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i></a>
                                            <a target="_blank" href="studentEdit.php?studentId=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i></a>
                                            <a class="listStudentDelete" attr-value=<?php echo $row["id"]; ?>><i class="fa fa-trash"></i></a>
                                            <a target="_blank" href="studentReceiptAll.php?studentId=<?php echo $row["id"]; ?>"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td style="display:none"><?php echo $row["mother_name"]; ?></td>
                                        <td style="display:none"><?php echo $row["date_of_birth"]; ?></td>
                                        <td style="display:none"><?php echo $row["phone"]; ?></td>
                                        <td style="display:none"><?php echo $row["gender"]; ?></td>
                                        <td style="display:none"><?php echo $row["aadhar_card"]; ?></td>
                                        <td style="display:none"><?php echo $row["alt_phone"]; ?></td>
                                        <td style="display:none"><?php echo $row["whatsup"]; ?></td>
                                        <td style="display:none"><?php echo $row["email"]; ?></td>
                                        <td style="display:none"><?php echo $row["address"]; ?></td>
                                        <td style="display:none"><?php echo $row["city"]; ?></td>
                                        <td style="display:none"><?php echo $row["dist"]; ?></td>
                                        <td style="display:none"><?php echo $row["state"]; ?></td>
                                        <td style="display:none"><?php echo $row["annual_package"]; ?></td>
                                        <td style="display:none"><?php echo $row["decided_fee"]; ?></td>
                                        <td style="display:none"><?php echo $row["roll_no"]; ?></td>
                                        <td style="display:none"><?php echo $row["paid_amount"]; ?></td>
                                        <td style="display:none"><?php echo $row["balance_amount"]; ?></td>

                                        <td style="display:none"><?php echo $row["date"]; ?></td>

                                        <td style="display:none"><?php echo $row["sr_no"]; ?></td>
                                        <td style="display:none"><?php echo $row["admission_no"]; ?></td>
                                        <td style="display:none"><?php echo $row["remark"]; ?></td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary promotNextClass">Promote Next Class</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
<link rel=' stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="dash.js"></script>
