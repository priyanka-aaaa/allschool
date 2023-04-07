<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
?>
<?php

include('../includes/connection.php');
$school_id = $_SESSION['id'];
$sql4 = "SELECT leaving_certificate.*,school.name as school_name 
FROM `leaving_certificate`
left JOIN school on leaving_certificate.school_id = school.id 
WHERE leaving_certificate.school_id = '$school_id' ORDER BY leave_id DESC LIMIT 1";
$res4 = mysqli_query($conn, $sql4);
while ($data = mysqli_fetch_assoc($res4)) {
?>
    <?php include 'header.php'; ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>School Leaving Certificate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item active">School Leaving Certificate</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="printpage" id="printpage">
                            <div class="card-body">
                                <h5 class="card-title">Primary School</h5>

                                <div class="school-detail">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>School Name</strong><?= ucwords($data['school_name']); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Address</strong><?= ucwords(strtolower($data['school_address'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Block</strong><?= $data['block']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>District</strong><?= $data['district']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="cert-title">
                                    <h3>School Leaving Certificate<span>(Acedmic Year 2022-2023)</span></h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>File No </strong><?= $data['file']; ?></p>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Date of issue </strong><?= $data['issue_date']; ?></p>
                                    </div>
                                </div>

                                <div class="student-detail">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Student Name</strong><?= strtoupper($data['student_name']); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Date of Birth</strong><?= $data['dob']; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>SRN</strong><?= $data['registration_no']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <p><strong>No. in Admission Register</strong><?= $data['in_admission_register']; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>School Code </strong><?= $data['department']; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Current Class </strong><?= $data['current_class']; ?></p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Marks Obtained</strong><?= $data['marks_obtained']; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>% of Marks </strong><?= $data['percentage']; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Promotion has granted to class </strong><?= $data['promotion']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Reason for leaving</strong><?= $data['reason']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Father / Guardian</strong><?= strtoupper($data['father']); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Mother Name</strong><?= strtoupper($data['mother']); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>General Conduct</strong><?= $data['conduct']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Dues to the school paid</strong><?= $data['dues']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Received By</strong><?= $data['received']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="description">
                                    <p>Certified that <strong><?= strtoupper($data['student_name']); ?></strong> attended this school up-to <strong><?= $data['issue_date']; ?></strong>.
                                        He/She has paid all
                                        sums due ti the school, and was allowed on the above date to withdraw his/her name. He/She was
                                        reading in class Second in this school.</p>
                                </div>
                                <div class="selectedbox">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>1.</strong> He/She was examined in <?= $data['class']; ?> and</p>
                                            <ul>
                                                <li><input type="checkbox">a. Was allowed/promised promotion to Class</li>
                                                <li><input type="checkbox">b. Passed the examination in the highest class available in the school, OR</li>
                                                <li><input type="checkbox">c. Left the school mid-session to join a different school,OR</li>
                                                <li><input type="checkbox">d. Failed in-------------------------------------- subject(s)</li>
                                            </ul>
                                            <p class="note">Note: (please tick and fill whichever is applicable)</p>
                                        </div>
                                    </div>
                                </div>

                                <p>The following particulars are certified to be correct according to the registers of the school and the
                                    certificate,s produced from previous school attended during the school year:</p>


                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>School</th>
                                                <th>Date of admission</th>
                                                <th>Date of withdrawal</th>
                                                <th>Date of attendance during the current school</th>
                                                <th>Date of attendance during the current Year</th>
                                                <th>Student attendance during the current school Year</th>
                                                <th>Leaves taken during the current school Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><?= ucwords($data['school_name']); ?></td>
                                                <td><?= $data['admission_date']; ?></td>
                                                <td><?= $data['issue_date']; ?></td>
                                                <td><?= $data['admission_date']; ?> To <?= $data['issue_date']; ?></td>
                                                <td><?= $data['attendence']; ?></td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="student-detail">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Checked By</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Clerical Office</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Principal</p>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <p>Name....................</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Name....................</p>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <p>Signature</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Signature</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <input type="button" class="btn btn-primary" onclick="printDiv('printpage')" value="Print Certificate" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php } ?>

    </main><!-- End #main -->

    <?php include 'footer.php'; ?>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>