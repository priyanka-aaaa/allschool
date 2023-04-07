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

$sql7 = "";
$studentId = $_GET["studentId"];
$sql10 = "select * from admission where id='$studentId'";
$res10 = mysqli_query($conn, $sql10);
while ($row10 = mysqli_fetch_assoc($res10)) {
    $name = $row10["name"];
    $father_name = $row10["father_name"];
    $section_id = $row10["section_id"];
    $roll_no = $row10["roll_no"];
    $decided_fee = $row10["decided_fee"];
    $current_class = $row10["class_id"];
}
$sql5 = "select * from section WHERE id = '$section_id'";

$res5 = mysqli_query($conn, $sql5);
$countSection=mysqli_num_rows($res5);
if($countSection==1){
while ($data5 = mysqli_fetch_assoc($res5)) {
    $section = $data5["section"];
}
}else{
    $section ="";
}


$sql11 = "select * from class where id='$current_class'";
$res11 = mysqli_query($conn, $sql11);
while ($row11 = mysqli_fetch_assoc($res11)) {
    $class_name = $row11["class_name"];
}

$sql5 = "SELECT * from receipt where student_id='$studentId' ORDER BY id DESC";

$role = $_SESSION["role"];
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
                                <h5 class="card-title"> Receipt List Of Particular Student</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <div class="col-md-4 text-right ">
                                </div>
                            </div>
                        </div>
                  
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" style="overflow-x:auto;">
                            <table class="table table-hover" id="studentReceiptAllTable" >
                       
                            <thead>
                            <div class="row">
                            <div class="col-md-2">
                                <b> Name : </b> <?php echo $name; ?>
                            </div>
                            <div class="col-md-2">
                                <b>class:</b> <?php echo $class_name; ?>
                            </div>
                            <div class="col-md-2">
                                <b> section :</b><?php echo $section; ?>
                            </div>
                            <div class="col-md-2">
                                <b> Roll No: </b> <?php echo $roll_no; ?>
                            </div>
                            <div class="col-md-2">
                                <b> Father's name :</b> <?php echo $father_name; ?>
                            </div>
                            <div class="col-md-2">
                                <b> Decided Fee:</b> <?php echo $decided_fee; ?>
                            </div>
                        </div> 
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Remark</th>
                                        <th scope="col">Payment Mode</th>
                                        <th scope="col">Relation</th>
                                        <th scope="col">Fee Taken By</th>
                                        <th scope="col">Convenience Charge Amount</th>
                                        <th scope="col">Exam Fee Amount</th>
                                        <!-- <th scope="col">Discount Fee</th> -->
                                        <th scope="col">Total Paying Amount</th>
                                        <th scope="col">Pending Amount</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res5 = mysqli_query($conn, $sql5);
                                    $i = 0;
                                    while ($row5 = mysqli_fetch_assoc($res5)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?> </td>
                                            <td><?php echo $row5["datetime"]; ?></td>
                                            <td><?php echo $row5["remark"]; ?></td>
                                            <td><?php echo $row5["payment_mode"]; ?></td>
                                            <td><?php echo $row5["relation"]; ?></td>
                                            <td><?php echo $row5["feeTaken"]; ?></td>
                                            <td><?php echo $row5["convenience_charge_amount"]; ?></td>
                                            <td><?php echo $row5["exam_fee_amount"]; ?></td>
                                            <!-- <td><?php echo $row5["decided_fee"]; ?></td> -->
                                            <!-- <td><?php echo $row5["online_payment_amount"]; ?></td>
                                            <td><?php echo $row5["offline_payment_amount"]; ?></td> -->
                                            <td><?php echo $row5["total_paying_amount"]; ?></td>
                                            <td><?php echo $row5["balance_amount"]; ?></td>
                                            <td><a href="receipt.php?id=<?php echo $row5['id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
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

