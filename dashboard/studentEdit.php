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
        $sql6 = "update admission set school_id='$schoolid',session='$session',class_id='$class',class_id='$class',name='$name',father_name='$father_name',
        mother_name='$mother_name',date_of_birth='$date_of_birth',phone='$phone',gender='$gender',aadhar_card=
        '$aadhar_card',alt_phone='$alt_phone',whatsup='$whatsup',email='$email',address='$address',city='
        $city',dist='$dist',state='$state',annual_package='$annual_package',decided_fee='$decided_fee',roll_no=
        '$roll_no',sr_no='$sr_no',admission_no='$admission_no',remark='$remark',section_id='$section' where id='$studentId'";



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

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Admission Form</h1>
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Admission</h5>
                        <input type="hidden" id="admin_session" value="<?php echo $session; ?>">
                        <!-- General Form Elements -->
                        <form method="post" autocomplete="false">
                            <?php while ($row10 = mysqli_fetch_assoc($res10)) {
                            ?>
                                <div class="bg-block gray">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span id="school_id" class="current_school_id"><?php echo $school_id; ?></span>
                                            <input type="hidden" id="current_session" value='<?php echo $session; ?>' />
                                            <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Class<span class="red">*</span></label>
                                                <div class="col-sm-9"> <select class="form-select admission_class" name="class" id="student_class" aria-label="Default select example" required>
                                                        <option selected="">Select class</option>
                                                        <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                            <?php
                                                            if ($data["id"] == $row10["class_id"]) {
                                                            ?>
                                                                <option value='<?php echo $data["id"]; ?>' selected><?php echo $data["class_name"]; ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value='<?php echo $data["id"]; ?>'><?php echo $data["class_name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Section</label>






                                                <div class="col-sm-9">
                                                    <select class="form-select admission_section" name="section" id="section_dropdown" aria-label="Default select example">
                                                        <option value="">Select Section </option>
                                                        <?php
                                                        $section_id = $row10['section_id'];
                                                        $sql5 = "select * from section WHERE id = '$section_id' ";
                                                        $res5 = mysqli_query($conn, $sql5);
                                                        while ($data5 = mysqli_fetch_assoc($res5)) {
                                                        ?>
                                                            <option value="<?php echo $data5["section"]; ?>" selected><?php echo $data5["section"]; ?> </option>

                                                        <?php

                                                        } ?>




                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Roll No.<span class="red">*</span></label>
                                                <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="roll_no" id="roll_no" readonly="readonly" value=<?php echo $row10["roll_no"]; ?> required></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-block">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">SRN<span class="red">*</span></label>
                                                <div class="col-sm-9"> <input autocomplete="false" type="number" class="form-control" name="sr_no" id="sr_no" value=<?php echo $row10["sr_no"]; ?> required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Admission No.<span class="red">*</span></label>
                                                <div class="col-sm-8"> <input autocomplete="false" type="number" class="form-control" name="admission_no" id="admission_no" value=<?php echo $row10["admission_no"];  ?> required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-block">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Student Name<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="name" value="<?php echo $row10["name"];  ?>" required></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Father's Name<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="father_name" value="<?php echo $row10["father_name"];  ?>" required></div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                       <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Mother's Name<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="mother_name" placeholder="Mother's Name" value="<?php echo $row10["mother_name"];  ?>" required></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputDate" class="col-sm-5 col-form-label">Date
                                                    of Birth<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="date" class="form-control" name="date_of_birth" id="dateOfBirth" max="<?= date('Y-m-d'); ?>" onchange="studentBirthDate()" value="<?php echo $row10["date_of_birth"];  ?>" required></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Phone No<span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <input autocomplete="false" value="<?php echo $row10["phone"];  ?>" name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row "> <label for="inputText" class="col-sm-4 col-form-label">Gender<span class="red">*</span></label>
                                                <div class="col-sm-8 first_col">
                                                    <div style="display: flex">
                                                        <div class="form-check-inline" style="margin-right: 25px; margin-left:6px;">
                                                            <label class="form-check-label" for="radio1">
                                                                <input autocomplete="false" type="radio" class="form-check-input" id="male" name="gender" value="Male" checked=""> Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline" style="margin-left:6px;">
                                                            <label class="form-check-label" for="radio2">
                                                                <input autocomplete="false" type="radio" class="form-check-input" id="male" name="gender" value="Female"> Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="studentAge">
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputDate" class="col-sm-5 col-form-label">Current Age<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="currentAge" id="currentAge" required readonly="readonly"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Age Till April<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="ageTillApril" id="ageTillApril" readonly="readonly" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Aadhar Card No.</label>
                                                <div class="col-sm-7"> <input autocomplete="false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" class="form-control" placeholder="Aadhar Card No." name="aadhar_card" value="<?php echo $row10["aadhar_card"];  ?>" required></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Alt.
                                                    Ph .no.</label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="number" name="alt_phone" class="form-control" placeholder="Optional" value="<?php echo $row10["alt_phone"];  ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">WhatsApp No.</label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="number" class="form-control" name="whatsup" placeholder="Optional" value="<?php echo $row10["whatsup"];  ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Email
                                                    id</label>
                                                <div class="col-sm-9"> <input autocomplete="false" type="email" class="form-control" placeholder="Optional" name="email" value="<?php echo $row10["email"];  ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="row mb-3"> <label for="inputPassword" class="col-sm-4 col-form-label">Complete
                                                    Address</label>
                                                <div class="col-sm-8"><input autocomplete="false" type="text" class="form-control" name="address" placeholder="Optional" value="<?php echo $row10["address"];  ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="row mb-3"> <label for="inputtext" class="col-sm-5 col-form-label" placeholder="Optional">Village/Sect/Colony</label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="city" placeholder="Optional" value="<?php echo $row10["city"];  ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="row mb-3"> <label for="inputtext" class="col-sm-4 col-form-label">Tehsil/Dist
                                                </label>
                                                <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="dist" placeholder="Optional" value="<?php echo $row10["dist"];  ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="row mb-3"> <label for="text" class="col-sm-3 col-form-label">State
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" placeholder="Optional" name="state" value="<?php echo $row10["state"];  ?>">
                                                        <option>Haryana</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-3">
                                                <div class="row mb-3"> <label for="inputtext" class="col-sm-4 col-form-label">Remark
                                                    </label>
                                                    <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="remark" placeholder="Optional" value="<?php echo $row10["remark"];  ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- start for admission no -->
                                <!-- end for admission no -->
                                <div class="bg-block green-light">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Annual fee package<span class="red">*</span></label>
                                                <div class="col-sm-7"> <input autocomplete="false" type="number" class="form-control" name="annual_package" id="annual_Fee" readonly="readonly" required value="<?php echo $row10["annual_package"];  ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Discount Fee<span class="red">*</span></label>
                                                <div class="col-sm-8"> <input autocomplete="false" type="number" class="form-control" name="decided_fee" value="<?php echo $row10["decided_fee"];  ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Edit Admission</button>
                                    </div>
                                </div>
                            <?php  }  ?>
                        </form>
                    </div>
                </div>
            </div>
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