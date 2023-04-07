<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
?>
<?php
include('../includes/connection.php');
$schoolid = $_SESSION['id'];
$num = "SELECT * from school where id = '$schoolid'";
$newres = mysqli_query($conn, $num);
while ($row = mysqli_fetch_assoc($newres)) {
    $address = ucwords($row['address']);
}
if (isset($_POST["submit"])) {
    $block = ucfirst($_POST["block"]);
    $district = ucfirst($_POST["district"]);
    $udisecode = $_POST["udisecode"];
    $schoolcode = $_POST["schoolcode"];
    $fileno = $_POST["fileno"];
    $admission = $_POST["admission"];
    $issue = $_POST["issue"];
    $studentname = ucwords($_POST["studentname"]);
    $dob = $_POST["dob"];
    $studentregi = $_POST["studentregi"];
    $admissionregi = $_POST["admissionregi"];
    $class = ucfirst($_POST["class"]);
    $father = ucwords($_POST["father"]);
    $mother = ucwords($_POST["mother"]);
    $attendence = $_POST["attendence"];
    $current_class = $_POST["current-class"];
    $marks = $_POST["marks-obtained"];
    $percentage = $_POST["percentage"];
    $promotion = $_POST["promotion"];
    $reason = $_POST["reason"];
    $conduct = $_POST["conduct"];
    $dues = $_POST["dues"];
    $received = ucwords($_POST["received"]);
    $sql5 = "INSERT INTO leaving_certificate (school_id, school_address, block, district, udise, department, file, admission_date, issue_date, student_name, dob, registration_no, in_admission_register, class, father, mother, attendence, current_class, marks_obtained, percentage,promotion,reason,conduct,dues,received) VALUES('$schoolid','$address','$block','$district','$udisecode','$schoolcode','$fileno','$admission','$issue','$studentname','$dob','$studentregi','$admissionregi','$class','$father','$mother','$attendence','$current_class','$marks','$percentage','$promotion','$reason','$conduct','$dues','$received')";
    $res5 = mysqli_query($conn, $sql5);
    if ($res5) {
        header("Location: leaving-certificate.php");
    }
}
?>
<?php include 'header.php'; ?>
<style>
    .current_school_id {
        display: none;
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
        <h1>School Leaving Certificate</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">School Leaving Certificate</li>
            </ol>
        </nav>
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
                        <div class="row">
                            <div class="col-md-3"></div>
                            <input type="hidden" id="schoolId" value="<?php echo $schoolid; ?>">
                            <div class="col-md-6 text-center">
                                <div class="cert-title">
                                    <h3>School Leaving Certificate<span>(Acedmic Year <?= date("Y") - 1; ?>-<?= date("Y"); ?>)</span></h3>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <!-- General Form Elements -->
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Block<span class="red">*</span></label>
                                        <div class="col-sm-9"> <input type="text" name="block" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputDistrict" class="col-sm-3 col-form-label">District<span class="red">*</span></label>
                                        <div class="col-sm-9"> <input type="text" name="district" class="form-control" id="district" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">UDISE Code<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="number" name="udisecode" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-8 col-form-label">Department School Code<span class="red">*</span></label>
                                        <div class="col-sm-4"> <input type="number" name="schoolcode" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">File No<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="number" name="fileno" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Date of admission<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="date" name="admission" class="form-control" id="admissionDate" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Date of isssue<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="date" name="issue" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Student Name<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="text" name="studentname" class="form-control" id="studentName" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Date of Birth<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="date" name="dob" class="form-control" id="dob" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">SRN<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="number" name="studentregi" id="sr_no" class="form-control" required="" onkeyup="mysrn()"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">No. in Admission Register<span class="red">*</span></label>
                                        <div class="col-sm-6"> <input type="number" name="admissionregi" class="form-control" id="admissionNo" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label"> Devision<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="class" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">Name of Father/ Guardian<span class="red">*</span></label>
                                        <div class="col-sm-6"> <input type="text" name="father" class="form-control" id="father_name" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Name of Mother<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="text" name="mother" class="form-control" id="mother_name" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Total Attendance<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="number" name="attendence" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-7 col-form-label">Class in which studying<span class="red">*</span></label>
                                        <div class="col-sm-5"> <input type="text" name="current-class" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Marks Obtained<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="number" name="marks-obtained" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">% of Marks<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="number" name="percentage" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-7 col-form-label">Promotion has granted to class<span class="red">*</span></label>
                                        <div class="col-sm-5"> <input type="text" name="promotion" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Reason for leaving<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="text" name="reason" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">General Conduct<span class="red">*</span></label>
                                        <div class="col-sm-7"> <input type="text" name="conduct" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">Dues to the school paid<span class="red">*</span></label>
                                        <div class="col-sm-6"> <input type="text" name="dues" class="form-control" required=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Received by<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="received" class="form-control" required=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">Certificates List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <!-- <a href="expensereport.php" class="btn btn-info"><span><i class="bi bi-save2-fill"></i></span> Export Result</a> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                    <div class="tableDataValue" style="overflow-x:auto;">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sr.no</th>
                                                    <th scope="col">Student Name</th>
                                                    <th scope="col">Father</th>
                                                    <th scope="col">Mother</th>
                                                    <th scope="col">UDISE Code</th>
                                                    <th scope="col">Department Code</th>
                                                    <th scope="col">File No</th>
                                                    <th scope="col">Issue Date</th>
                                                    <th scope="col">Registration No</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $mydata = "SELECT * FROM leaving_certificate WHERE school_id = '$schoolid' ORDER BY leave_id DESC";
                                                $myresult = mysqli_query($conn, $mydata);
                                                $count = 1;
                                                if (mysqli_num_rows($myresult) > 0) {
                                                    while ($row = mysqli_fetch_assoc($myresult)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo $row['student_name']; ?></td>
                                                            <td><?php echo $row['father']; ?></td>
                                                            <td><?php echo $row['mother']; ?></td>
                                                            <td><?php echo $row['udise']; ?></td>
                                                            <td><?php echo $row['department']; ?></td>
                                                            <td><?php echo $row['file']; ?></td>
                                                            <td><?php echo $row['issue_date']; ?></td>
                                                            <td><?php echo $row['registration_no']; ?></td>
                                                            <td>
                                                                <a href="view-leaving-certificate.php?certificateid=<?= $row['leave_id']; ?>" target="_blank" title="View Certificate" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                                                <a href="certidelete.php?certificateid=<?= $row["leave_id"]; ?>" onclick="return checkdelete()" title="Delete Certificate" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

   

<?php include 'footer.php'; ?>
<script src="dash.js"></script>