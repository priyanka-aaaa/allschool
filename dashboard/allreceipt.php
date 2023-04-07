<?php
session_start();
include('../includes/connection.php');
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"])) {
    $school_id = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
$session = $_SESSION["session"];
$sql4 = "select * from class WHERE school_id = '$school_id' and session='$session'";
$res4 = mysqli_query($conn, $sql4);
?>
<?php include 'header.php'; ?>
<style>
    .student_date,
    .student_month,
    .student_class,
    .student_section {
        display: none;
    }

    span.total_amount_pay {
        color: green;
        font-weight: bold;
        font-size: 18px;
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
    <span id="current_school_id" class="current_school_id"><?php echo $school_id; ?></span>
    <div class="pagetitle">
        <input type="hidden" id="current_session" value='<?php echo $session; ?>' />
        <h1>Fee Collection</h1>
        <div class="show-all-no">
            Total amount get <span class="total_amount_pay">

                <?php
                $sql90 = "SELECT SUM(total_paying_amount) from receipt where school_id='$school_id' and session='$session'";
                $res90 = mysqli_query($conn, $sql90);
                while ($row90 = mysqli_fetch_array($res90)) {
                    $total = $row90['SUM(total_paying_amount)'];
                    if (!empty($_POST["class"])) {
                        $total = $row90['SUM(receipt.total_paying_amount)'];
                    }
                }
                echo $total;

                ?>
            </span>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Fee Collection</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Fee Collection</h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control receiptDate" name="receiptDate" id="receiptDate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <select class="form-select receipt_month" aria-label="Default select example">
                                            <option value="">Select Month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Class<span class="red">*</span></label>
                                    <div class="col-sm-9"> <select class="form-select admission_class" name="class" id="student_class" aria-label="Default select example" required>
                                            <option value="">Select class</option>
                                            <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                <option value='<?php echo $data["id"]; ?>'><?php echo $data["class_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Section</label>
                                    <div class="col-sm-9"> <select class="form-select" id="section_dropdown" aria-label="Default select example">
                                            <option value="">Select Section</option>
                                        </select></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row mb-3">
                                    <label for="inputnumber" class="col-sm-3 col-form-label">Roll No.<span class="red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="roll_no" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <!-- <div class="row mb-3">
                                        <button>Fee pending</button>
                                    </div> -->
                            </div>
                        </div>
                        <span class="student_date"></span>
                        <span class="student_month"></span>
                        <span class="student_class"></span>
                        <span class="student_section"></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">Student List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                            </div>
                        </div>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="allreceiptTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No.</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Pending Amount</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main><!-- End #main -->
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
