<?php session_start();
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
$studentId = $_GET["studentId"];
$sql10 = "select * from admission WHERE id = $studentId and session='$session'";
$res10 = mysqli_query($conn, $sql10);
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
        $sql6 = "update admission set school_id='$schoolid',session='$session',class_id='$class',section='$section',class_id='$class',section='$section',name='$name',father_name='$father_name',
        mother_name='$mother_name',date_of_birth='$date_of_birth',phone='$phone',gender='$gender',aadhar_card=
        '$aadhar_card',alt_phone='$alt_phone',whatsup='$whatsup',email='$email',address='$address',city='
        $city',dist='$dist',state='$state',annual_package='$annual_package',decided_fee='$decided_fee',roll_no=
        '$roll_no',sr_no='$sr_no',admission_no='$admission_no',remark='$remark' where id='$studentId'";
        $res6 = mysqli_query($conn, $sql6);
        if ($res6) {
            $msg = '<div class="alert alert-success" role="alert">
          Admission Edit successfull!
        </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
          Failed to Edit Admission!
        </div>';
        }
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
    Failed to Edit Admission because this section is full!
  </div>';
    }
}
?>
<?php include 'header.php'; ?>
<style>
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
<script>
    function checkdelete() {
        return confirm('Are you sure to delete?');
    }
    if (confirm == 'yes') {
        window.location.href = "#";
    } else {}
</script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Student Admission Detail</h1>
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section profile">
        <div class="row printpage" id="printpage">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <h5 class="card-title"></h5>
                            </li>
                        </ul>
                        <?php while ($row10 = mysqli_fetch_assoc($res10)) {
                        ?>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Student Name</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["name"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label ">SRN No.</div>
                                        <div class="col-lg-3 col-md-8"> <?php echo $row10["sr_no"]; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Father Name</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["father_name"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label ">Admission No.</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["admission_no"]; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Mother Name</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["mother_name"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Gender</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["gender"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Class</div>
                                        <div class="col-lg-3 col-md-8">
                                            <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                <?php
                                                if ($data["id"] == $row10["class_id"]) {
                                                ?>
                                                    <?php echo $data["class_name"]; ?>
                                            <?php
                                                }
                                            } ?>
                                        </div>
                                        <div class="col-lg-3 col-md-4 label">Email Id</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["email"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Section</div>
                                        <div class="col-lg-3 col-md-8">
                                        <?php
                                        $section_id = $row10['section_id'];
                                        $sql5 = "select * from section WHERE id = '$section_id' ";

                                        $res5 = mysqli_query($conn, $sql5);
                                        while ($data5 = mysqli_fetch_assoc($res5)) { ?>
                                           <?php echo $data5["section"];  ?>

                                        <?php

                                        } ?>
</div>


                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["address"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Roll No.</div>
                                        <div class="col-lg-3 col-md-8"> <?php echo $row10["roll_no"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Village/Sect/Colony</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["city"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dob</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["date_of_birth"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Tehsil/Dist</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["dist"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Aadhar No.</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["aadhar_card"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">State</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["state"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone No.</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["phone"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Annual fee package</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["annual_package"];  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alt Ph. No.</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["alt_phone"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Decided Fee</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["decided_fee"];  ?> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Current age</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["current_age"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Age till 1 April</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["age_april"];  ?> </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Whatsapp No.</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["whatsup"];  ?></div>
                                        <div class="col-lg-3 col-md-4 label">Remark</div>
                                        <div class="col-lg-3 col-md-8"><?php echo $row10["remark"];  ?> </div>
                                    </div>


                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="print_admission">
            <input type="button" class="btn btn-primary" onclick="printDiv('printpage')" value="Print Detail" />
        </div>

    </section>
</main>
<?php include 'footer.php'; ?>
<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script>
    function studentBirthDate() {
        var aa = document.getElementById("dateOfBirth").value;
        const stuDate = new Date(aa);
        const birth_year = stuDate.getFullYear();
        const birth_month = stuDate.getMonth();
        const birth_day = stuDate.getDate();
        const studentAge = document.getElementById("studentAge");
        studentAge.style.display = "block";
        //start for get age
        // 1994-11-09
        today_date = new Date();
        today_year = today_date.getFullYear();
        today_month = today_date.getMonth();
        today_day = today_date.getDate();
        age = today_year - birth_year;
        if (today_month < (birth_month - 1)) {
            age--;
        }
        if (((birth_month - 1) == today_month) && (today_day < birth_day)) {
            age--;
        }
        document.getElementById("currentAge").value = age;
        //end for get age
        //start for age till april
        age2 = today_year - birth_year;
        if ("04" < (birth_month - 1)) {
            age2--;
        }
        if (((birth_month - 1) == "04") && ("01" < birth_day)) {
            age2--;
        }
        document.getElementById("ageTillApril").value = age2;
        //end for age till april
    }
    $(document).ready(function() {
        var a = $(".current_school_id").html();
        var session = $("#current_session").val();
        $(".admission_class").on("change", function(s) {
            $("option:selected", this);
            var e = this.value;
            $.ajax({
                type: "POST",
                url: "sectionlist.php",
                data: {
                    school_id: a,
                    class: e,
                    session: session
                },
                success: function(a) {
                    var s = a.split("&&");
                    $("#annual_Fee").val(s[0]), $("#section_dropdown").html(s[1]);
                }
            })
        })
    })
</script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>