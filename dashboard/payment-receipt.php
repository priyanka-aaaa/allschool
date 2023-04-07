<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!class_exists('../PHPMailer\PHPMailer\Exception')) {
    include '../PHPMailer/config.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
}
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"])) {
    $school_id = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
$session = $_SESSION["session"];
include('../includes/connection.php');
$sql4 = "select * from class WHERE school_id = $school_id and session='$session'";
$res4 = mysqli_query($conn, $sql4);
if (isset($_POST["submit"])) {
    $balance_amount = $_POST["balance_amount"];
    $decided_fee = $_POST["decided_fee"];
    $student_id = $_POST["student_id"];
    $total_paying_amount = $_POST["total_paying_amount"];
    $convenience_charge_amount = $_POST["convenience_charge_amount"];
    $exam_fee_amount = $_POST["exam_fee_amount"];
    $remarkold = $_POST["remark"];
    $remark = ucfirst($remarkold);
    $session = $_POST["session"];
    $online_payment_amount = $_POST["online_payment_amount"];
    $offline_payment_amount = $_POST["offline_payment_amount"];
    $checkbox2 = $_POST['payment_mode'];
    $payment_mode = "";
    foreach ($checkbox2 as $chk2) {
        $payment_mode .= $chk2 . ",";
    }
    date_default_timezone_set('Asia/Kolkata');
    $datetime = date('Y-m-d H:i:s');
    $sql10 = "INSERT INTO receipt(session,school_id,student_id,total_paying_amount,payment_mode,remark,convenience_charge_amount,exam_fee_amount,datetime,online_payment_amount,offline_payment_amount)VALUES('$session','$school_id','$student_id','$total_paying_amount','$payment_mode','$remark','$convenience_charge_amount','$exam_fee_amount','$datetime','$online_payment_amount','$offline_payment_amount')";
    $res10 = mysqli_query($conn, $sql10);
    $paid_amount = $decided_fee - $balance_amount;
    $sql11 = "update admission set paid_amount='$paid_amount',balance_amount='$balance_amount' where id='$student_id'";
    $res11 = mysqli_query($conn, $sql11);
    ob_start();
    include("../template/feepayment.php");
    $content .= ob_get_clean();
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = "parveenk.calinfo@gmail.com";
    $mail->Password = "xkevtiqawkkvhwya";
    $mail->setFrom("parveenk.calinfo@gmail.com", 'School');
    $mail->addAddress("priyanka.calinfo500@gmail.com", 'School');
    $mail->Subject = "School Receipt";
    $mail->Body = $content;
    $mail->send();
}
?>
<?php include 'header.php'; ?>
<style>
    .notcomemonth {
        background-color: red !important;
    }

    .total_paying_amount {
        color: green;
    }

    input[readonly=readonly] {
        background-color: #e9ecef;
    }

    .newmonth {
        background-color: #00801d !important;
    }

    input#total_paying_amount {
        color: #16A085;
    }

    .current_school_id {
        display: none;
    }

    #checkDetail {
        display: none;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Fee Payment Receipt</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $datetime = date('Y-m-d H:i:s');
                        $month = date('F', strtotime($datetime));
                        ?>
                        <input type="hidden" class="form-control" id="receipt_month" name="student_id" value="<?php echo $month; ?>">
                        <h5 class="card-title">Payment Receipt</h5>
                        <!-- General Form Elements -->
                        <form method="post" id="receipt_form">
                            <input type="hidden" id="current_session" value='<?php echo $session; ?>' />
                            <input type="hidden" id="fee_month" name="fee_month[]" />

                            <div class="row bg-block gray">
                                <input type="hidden" id="session" name="session" value="<?php echo $session; ?>">
                                <div class="col-sm-4">
                                    <span id="current_school_id" class="current_school_id"><?php echo $school_id; ?></span>
                                    <div class="row mb-3"> <label class="col-sm-3 col-form-label">Class<span class="red">*</span></label>
                                        <div class="col-sm-9"> <select class="form-select admission_class" aria-label="Default select example" name="class" id="student_class" required>
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
                                        <label for="inputnumber" class="col-sm-4 col-form-label">Roll No.<span class="red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="roll_no" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="hidden" class="form-control" id="student_id" name="student_id">
                                    <input type="hidden" class="form-control" id="monthNo_last" name="monthNo_last">
                                    <input type="hidden" class="form-control" value="<?php echo $school_id; ?>" id="my_school_id" name="my_school_id">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9"> <input type="text" class="form-control" id="student_name" readonly="readonly"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputEmail" class="col-sm-5 col-form-label">Father Name
                                        </label>
                                        <div class="col-sm-7"> <input type="text" class="form-control" id="father_name" disabled></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Phone
                                            No.</label>
                                        <div class="col-sm-8"> <input type="number" class="form-control" id="phone_no" disabled></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-5 col-form-label">Decided
                                            Fee</label>
                                        <div class="col-sm-7"> <input type="number" class="form-control" id="decided_fee" name="decided_fee" readonly="readonly">
                                            <input type="hidden" class="form-control" id="decided_fee_last" name="decided_fee_last" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row mb-4"> <label for="inputText" class="col-sm-5 col-form-label">Balance Dues</label>
                                        <div class="col-sm-7"> <input type="text" class="form-control" id="balance_due" readonly="readonly">
                                            <input type="hidden" class="form-control" id="balance_due_last">
                                            <input type="hidden" class="form-control" id="paid_amount_last">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 d-flex">
                                    <div class="form-check">
                                        <input name="exam_fee_charge[]" value="Exam Fee" class="form-check-input" type="checkbox" id="student_exam_fee" onclick="myExamFee()">
                                        <label class="form-check-label" for="gridCheck1">
                                            Exam Fee</label>
                                    </div>
                                    <div class="form-check"> <input name="exam_fee_charge[]" value="Convenience Charges" class="form-check-input" type="checkbox" id="student_convenience_charge" onclick="myConvenienceCharge()" id="gridCheck2"> <label class="form-check-label" for="gridCheck2">
                                            Convenience Charges </label></div>
                                </div>
                                <!-- start exam fee -->
                                <div class="row" style="display:none" id="examfee">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">
                                                Paying Exam Fee Amount
                                            </label>
                                            <div class="col-sm-7"> <input type="number" class="form-control" id="exam_fee_amount" name="exam_fee_amount"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display:none" id="convenienceCharge">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">
                                                Paying Convenience Charges Amount
                                            </label>
                                            <div class="col-sm-6"> <input type="number" class="form-control" id="convenience_charge_amount" name="convenience_charge_amount"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <select class="form-select convenience_fee_month" id="convenience_fee_month" name="convenience_fee_month" aria-label="Default select example">
                                                    <option value="">Select Convenience Charges Month</option>
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
                                </div>
                                <!-- end exam fee -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">Paying Decided Amount </label>
                                            <div class="col-sm-6"> <input type="number" class="form-control" name="paying_decided_amount" id="paying_decided_amount"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-6 col-form-label">Pending Decided Amount</label>
                                            <div class="col-sm-6"> <input type="number" class="form-control" id="balance_amount" name="balance_amount" readonly="readonly"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="monthlyblock">
                                            <div class="form-check">
                                                <input name="month[]" value="April" class="form-check-input feemonth" type="checkbox" disabled id="apr">
                                                <label class="form-check-label" for="apr"> Apr</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="May" class="form-check-input feemonth" type="checkbox" disabled id="May">
                                                <label class="form-check-label" for="may"> May</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="June" class="form-check-input feemonth" type="checkbox" disabled id="jun">
                                                <label class="form-check-label" for="jun"> Jun</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="July" class="form-check-input feemonth" type="checkbox" disabled id="jul">
                                                <label class="form-check-label" for="jul"> Jul</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="August" class="form-check-input feemonth" type="checkbox" disabled id="Aug">
                                                <label class="form-check-label" for="aug"> Aug</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="September" class="form-check-input feemonth" type="checkbox" disabled id="Sep">
                                                <label class="form-check-label" for="sep"> Sep</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="October" class="form-check-input feemonth" type="checkbox" disabled id="oct">
                                                <label class="form-check-label" for="oct"> Oct</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="November" class="form-check-input feemonth" type="checkbox" disabled id="nov">
                                                <label class="form-check-label" for="nov"> Nov</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="December" class="form-check-input feemonth" type="checkbox" disabled id="dec">
                                                <label class="form-check-label" for="dec"> Dec</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="January" class="form-check-input feemonth" type="checkbox" disabled id="jan">
                                                <label class="form-check-label" for="jan"> Jan</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="February" class="form-check-input feemonth" type="checkbox" disabled id="feb">
                                                <label class="form-check-label" for="Feb"> Feb</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="month[]" value="March" class="form-check-input feemonth" type="checkbox" disabled id="mar">
                                                <label class="form-check-label" for="mar"> Mar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- start fo -->
                                <div class="row total_paying_amount">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label"> Total Paying Amount</label>
                                        <div class="col-sm-8"> <input type="number" class="form-control" id="total_paying_amount" name="total_paying_amount" readonly="readonly"></div>
                                    </div>
                                </div>
                                <div class="payment mt-5 green-light">
                                    <h6>Payment Mode</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check"> <input name="payment_mode_method[]" onclick="myOnlinePayment()" value="Online Payment" class="form-check-input" type="checkbox" id="online_payment"> <label class="form-check-label" for="gridCheck1"> Online Payment</label></div>
                                            <div class="online-mode-opation">
                                                <div class="col-sm-10 d-flex">
                                                    <div class="form-check"> <input name="payment_mode[]" value="Google pay" class="form-check-input" type="radio" id="googlepay"> <label class="form-check-label" for="googlepay">
                                                            Google pay </label></div>
                                                    <div class="form-check"> <input name="payment_mode[]" value="Phonepe" class="form-check-input" type="radio" id="phonepe"> <label class="form-check-label" for="phonepe">
                                                            Phonepe </label></div>
                                                    <div class="form-check"> <input name="payment_mode[]" value="QR code" class="form-check-input" type="radio" id="qrcode"> <label class="form-check-label" for="qrcode"> QR
                                                            code </label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input name="payment_mode_method[]" onclick="myOfflinePayment()" id="offline_payment" class="form-check-input" value="Offline Payment" type="checkbox"> <label class="form-check-label" for="gridCheck2">
                                                    Offline Payment</label>
                                            </div>
                                            <div class="online-mode-opation">
                                                <div class="col-sm-10 d-flex">
                                                    <div class="form-check"> <input name="payment_mode[]" value="cash" class="form-check-input" type="checkbox" id="cash"> <label class="form-check-label" for="googlepay">
                                                            Cash</label></div>
                                                    <div class="form-check"> <input name="payment_mode[]" value="cheque" class="form-check-input" type="checkbox" id="cheque" onchange="getRadio(this)"> <label class="form-check-label" for="phonepe">
                                                            Cheque </label></div>
                                                </div>
                                            </div>
                                            <!-- start for check number -->
                                            <div class="" id="checkDetail">
                                                <div class="col-sm-8">
                                                    <label for="inputText" class="col-sm-4 col-form-label">
                                                        Cheque Number
                                                    </label>
                                                    <input type="text" class="form-control" id="checkNumber" name="checkNumber">
                                                    <label for="inputText" class="col-sm-4 col-form-label">
                                                        Cheque Date
                                                    </label>
                                                    <input type="date" name="checkDate" class="form-control" id="checkDate">
                                                </div>
                                            </div>
                                            <!-- end for check number -->
                                        </div>
                                    </div>
                                    <p class="note">(Payment through cheque is subject to Clearance)</p>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3" style="display:none" id="student_online_amount"> <label for="inputText" class="col-sm-4 col-form-label">
                                                Online Payment Amount
                                            </label>
                                            <div class="col-sm-8"> <input type="number" class="form-control" id="online_payment_amount" name="online_payment_amount"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3" style="display:none" id="student_offline_amount"> <label for="inputText" class="col-sm-4 col-form-label">
                                                Offline Payment Amount
                                            </label>
                                            <div class="col-sm-8"> <input type="number" class="form-control" id="offline_payment_amount" name="offline_payment_amount"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="text" class="col-sm-4 col-form-label"> Remark<span class="red">*</span>
                                            </label>
                                            <div class="col-sm-8"> <input type="text" class="form-control" name="remark" id="remark" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Student's Relation </label>
                                            <div class="col-sm-7"> <input type="text" class="form-control" name="relation" id="relation" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-5 col-form-label">Fee Taken by</label>
                                            <div class="col-sm-7"> <input type="text" class="form-control" id="feeTaken" name="feeTaken" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary" name="submit" id="form_submit" onclick="functionToExecute()"><span><i class="bi bi-printer"></i></span>Email & Receipt</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">Payment History</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <div class="search-bar mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="paymentreceiptTable">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Sr. No.</th>
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
        </div>
    </section>
</main><!-- End #main -->
<?php include 'footer.php'; ?>

<script src="dash.js"></script>

