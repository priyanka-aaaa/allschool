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
    $current_age = $_POST["current_age"];
    $age_april = $_POST["age_april"];

    if ($roll_no != "") {
        date_default_timezone_set('Asia/Kolkata');
        $sr_no = $_POST["sr_no"];
        $admission_no = $_POST["admission_no"];
        $adm_date = date("Y-m-d");
        $remark = $_POST["remark"];
        $sql6 = "insert into admission(school_id, session,class_id,name,father_name,mother_name,date_of_birth,phone,gender,aadhar_card,alt_phone,whatsup,email,address,city,dist,state,annual_package,decided_fee,roll_no,balance_amount,date,sr_no,admission_no,remark,current_age,age_april,section_id)values(
    '$schoolid','$session','$class','$name','$father_name','$mother_name','$date_of_birth','$phone','$gender','$aadhar_card','$alt_phone','$whatsup','$email','$address','$city','$dist','$state','$annual_package','$decided_fee','$roll_no','$decided_fee','$adm_date','$sr_no','$admission_no','$remark',
    '$current_age','$age_april','$section')";
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
    #studentAge,
    #ageDetail {
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
                        <form method="post" autocomplete="false" class="studentAdmission">
                            <div class="bg-block gray">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span id="school_id" class="current_school_id"><?php echo $school_id; ?></span>
                                        <input type="hidden" id="current_session" value='<?php echo $session; ?>' />
                                        <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Class<span class="red">*</span></label>
                                            <div class="col-sm-9"> <select class="form-select student_admission_class" name="class" id="student_class" aria-label="Default select example" required>
                                                    <option selected="">Select class</option>
                                                    <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                        <option value='<?php echo $data["id"]; ?>'><?php echo $data["class_name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Section</label>
                                            <div class="col-sm-9">
                                                <select class="form-select student_admission_section" name="section" id="section_dropdown" aria-label="Default select example" >
                                                    <option value="">Select Section </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Roll No.<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="roll_no" id="roll_no" readonly="readonly" required></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">SRN<span class="red">*</span></label>
                                            <div class="col-sm-9"> <input autocomplete="false" type="number" class="form-control" name="sr_no" id="sr_no" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Admission No.<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input autocomplete="false" type="number" class="form-control" name="admission_no" id="admission_no" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Student Name<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="name" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Father's Name<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="father_name" required></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Mother's Name<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="mother_name" placeholder="Mother's Name" required></div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputDate" class="col-sm-5 col-form-label">Date
                                                of Birth<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="date" class="form-control" name="date_of_birth" id="dateOfBirth" max="<?= date('Y-m-d'); ?>" onchange="studentBirthDate()" required></div>
                                            <div id="ageDetail">
                                                <b>Current age</b> <span id="stuCurrentAge"> </span><br>
                                                <b>Age till 1 April </b><span id="stuAgeTillApril"></span>
                                            </div>
                                        </div>
                                    </div>                      
                                </div>
                                <div class="row">
                                   
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Phone No<span class="red">*</span></label>
                                            <div class="col-sm-7">
                                                <input autocomplete="false" name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row "> <label for="inputText" class="col-sm-5 col-form-label">Gender<span class="red">*</span></label>
                                            <div class="col-sm-7 first_col">
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
                                            <div class="col-sm-7"> <input autocomplete="false" type="hidden" class="form-control" name="current_age" id="currentAge" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Age Till April<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="hidden" class="form-control" name="age_april" id="ageTillApril" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Aadhar Card No.<span class="red">*</span></label>
                                            <div class="col-sm-7"> <input autocomplete="false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" class="form-control" placeholder="Aadhar Card No." name="aadhar_card" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Alt.
                                                Ph .no.</label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="number" name="alt_phone" class="form-control" placeholder="Optional"></div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">WhatsApp No.</label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="number" class="form-control" name="whatsup" placeholder="Optional"></div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Email
                                                id</label>
                                            <div class="col-sm-9"> <input autocomplete="false" type="email" class="form-control" placeholder="Optional" name="email"></div>
                                        </div>
                                    </div>                   
                                </div>
                                <div class="row">                                    
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputPassword" class="col-sm-3 col-form-label">Complete
                                                Address</label>
                                            <div class="col-sm-9"><input autocomplete="false" type="text" class="form-control" name="address" placeholder="Optional">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputtext" class="col-sm-5 col-form-label" placeholder="Optional">Village/Sect/Colony</label>
                                            <div class="col-sm-7"> <input autocomplete="false" type="text" class="form-control" name="city" placeholder="Optional"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputtext" class="col-sm-4 col-form-label">Tehsil/Dist
                                            </label>
                                            <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="dist" placeholder="Optional"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="text" class="col-sm-5 col-form-label">State
                                            </label>
                                            <div class="col-sm-7">
                                                <select class="form-control" placeholder="Optional" name="state">
                                                    <option>Haryana</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <div class="row mb-3"> <label for="text" class="col-sm-4 col-form-label">Remark
                                                </label>
                                                <div class="col-sm-8"> <input autocomplete="false" type="text" class="form-control" name="remark" placeholder="Optional"></div>
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
                                            <div class="col-sm-7"> <input autocomplete="false" type="number" class="form-control" name="annual_package" id="annual_Fee" readonly="readonly" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Discount Fee<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input required autocomplete="false" type="number" class="form-control" name="decided_fee" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Submit New Admission</button>
                                </div>
                            </div>
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
<script src="dash.js"></script>

