<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$id = $_SESSION['id'];
$role = $_SESSION['role'];
$session = $_SESSION["session"];

include('../includes/connection.php');
if (isset($_POST["expense"])) {


    //start for payment mode
    $checkbox2 = $_POST['payment_mode'];
    $payment_mode = "";
    foreach ($checkbox2 as $chk2) {
        $payment_mode .= $chk2 . ",";
    }
    //end for  payment mode

    // if (isset($_FILES["file"])) {
    $schoolid = $_SESSION['id'];
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];

    $expense_type = $_POST["expense-type"];
    $purpose = ucfirst($_POST["purpose"]);
    $date = $_POST["date"];
    $amount = $_POST["amount"];
    $description = ucwords($_POST["description"]);
    // $onlinepayment = $_POST["onlinepayment"];
    $status = $_POST["status"];
    $remark = ucfirst($_POST["remark"]);
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $extension = array("pdf", "doc", "docx", "csv", "xlsx");
    // $rand = rand(00000, 99999);
    // $imgname = $rand . $file_name;
    if ($expense_type == "" || $purpose == "" || $date == "" || $amount == "" || $description == "" || $status == "" || $remark == "") {
        $msg = '<div class="alert alert-danger" role="alert">
        Mandatory fields are missing
      </div>';
    }
    if (!in_array($ext, $extension)) {
        $msg = '<div class="alert alert-danger" role="alert">
        Invalid file type(pdf, doc, docx, csv, xlsx allowed)
      </div>';
    }
    if ($file_size > 2097152) {
        $msg = '<div class="alert alert-danger" role="alert">
        File is too large
      </div>';
    } else {

        $sqlQuery = "INSERT INTO expense(school_id,session,expense_type,purpose,expense_date,amount,description,file,payment_mode,payment_status, remark) VALUES ('$schoolid','$session','$expense_type', '$purpose', '$date', '$amount', '$description','$file_name', '$payment_mode', '$status','$remark')";
        $resultQuery = mysqli_query($conn, $sqlQuery);
        move_uploaded_file($file_tmp_name, "expenses/" . $file_name);
        $msg = '<div class="alert alert-success" role="alert">
        Expenses add successfully
      </div>';
    }
}
$sql2 = "select * from expense_type WHERE school_id=" . $_SESSION['id'];
$res2 = mysqli_query($conn, $sql2);
$sql3 = "select * from expense_type WHERE school_id=" . $_SESSION['id'];
$res3 = mysqli_query($conn, $sql3);
?>
<?php include 'header.php'; ?>
<style>
    .buttons {
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
        <h1>Add Expense</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Expense</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Expense</h5>
                        <!-- General Form Elements -->
                        <form class="add-expense" method="post" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="row mb-4"> <label class="col-sm-4 col-form-label">Expense Type<span class="red">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="expense-type" aria-label="Default select example" required>
                                                <option selected="" disabled> select Expense Type </option>
                                                <?php
                                                while ($data = mysqli_fetch_assoc($res2)) { ?>
                                                    <option value="<?php echo $data['expense_type']; ?>"><?php echo $data['expense_type']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4"> <label for="inputText" class="col-sm-4 col-form-label">Purpose<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="purpose" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Expense Date<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="date" name="date" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Amount<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="number" name="amount" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3"> <label for="inputPassword" class="col-sm-2 col-form-label">Description<span class="red">*</span></label>
                                <div class="col-sm-10"><textarea class="form-control" name="description" style="height: 100px" data-gramm="false" wt-ignore-input="true" required></textarea></div>
                            </div>
                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-2 col-form-label">Attachment</label>
                                <div class="col-sm-10">
                                    <div class="dropify-wrapper">
                                        <span><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                        <p>Drag and drop or click to replace</p>
                                        <input class="form-control file-input" type="file" name="file" id="input-file-now">
                                    </div>
                                </div>
                            </div>
                            <div class="payment mt-5 green-light">
                                <h6>Payment Mode<span class="red">*</span></h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="payment_mode[]" value="1">
                                            <label class="form-check-label"> Online Payment</label>
                                        </div>
                                        <!-- <div class="online-mode-opation buttons">
                                            <div class="col-sm-10 d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="onlinepayment[]" value="Google pay" onclick="setcheckbox()">
                                                    <label class="form-check-label" for="gridRadios1"> Google pay</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="onlinepayment" value="PhonePe" onclick="setcheckbox()">
                                                    <label class="form-check-label" for="gridRadios2"> PhonePe </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_mode" value="QR Code" onclick="setcheckbox()">
                                                    <label class="form-check-label" for="gridRadios3"> QR Code </label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="payment_mode[]" value="Offline Payment">
                                            <label class="form-check-label" for="gridCheck2">Offline Payment</label>
                                        </div>
                                    </div>
                                </div>
                                <p class="note">(Payment through cheque is subject to Clearance)</p>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Payment Status<span class="red">*</span></legend>
                                <div class="col-sm-6 d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="Paid">
                                        <label class="form-check-label" for="gridRadios1"> Paid</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="Due">
                                        <label class="form-check-label" for="gridRadios2"> Due </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="Others">
                                        <label class="form-check-label" for="gridRadios3"> Others </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Remark<span class="red">*</span></legend>
                                <div class="col-sm-10 d-flex">
                                    <input type="text" class="form-control" name="remark">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="expense"><span><i class="bi bi-save2-fill"></i></span> Save Expense</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">Expense List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <a href="expensereport.php" class="btn btn-success mt-3"><span><i class="bi bi-save2-fill"></i></span> Export Result</a>
                            </div>
                        </div>

                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="tableDataValue">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.no</th>
                                            <th scope="col">Expense Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Mode</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $mydata = "SELECT * FROM expense WHERE school_id = '$id' and session='$session' ORDER BY expense_id DESC";
                                        $myresult = mysqli_query($conn, $mydata);
                                        $count = 1;
                                        if (mysqli_num_rows($myresult) > 0) {
                                            while ($row = mysqli_fetch_assoc($myresult)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['expense_type']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo $row['payment_mode']; ?></td>
                                                    <td><?php echo $row['payment_status']; ?></td>
                                                    <td><?php echo $row['expense_date']; ?></td>
                                                    <td><?php echo $row['remark']; ?></td>
                                                    <td>
                                                        <?php if ($row['file']) { ?>
                                                            <a href="download.php?file=<?php echo urlencode($row['file']); ?>" target="_new" title="Download File" class="btn btn-info"><i class="bi bi-download"></i></a>
                                                        <?php } ?>
                                                        <a href="expense-delete.php?expenseid=<?php echo $row["expense_id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
    </section>
</main>
<?php include 'footer.php'; ?>
<script>
    $(document).on('change', '.file-input', function() {
        var filesCount = $(this)[0].files.length;
        var textbox = $(this).prev();
        if (filesCount === 1) {
            var fileName = $(this).val().split('\\').pop();
            textbox.text(fileName);
        } else {
            textbox.text(filesCount + ' files selected');
        }
    });
    $(document).ready(function() {
        $("input[name='onlinepaymentmode']").on("change", function() {
            var isChecked = $(this).prop("checked");
            if (isChecked) {
                $(".buttons").show();
            } else {
                $(".buttons").hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#expenseDate").on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "fetchexpense",
                type: "POST",
                data: 'daterequest=' + value,
                beforeSend: function() {
                    $(".tableDataValue").html();
                },
                success: function(data) {
                    $(".tableDataValue").html(data);
                }
            });
        });
        $("#expenseType").on('change', function() {
            var value = $(this).val();
            // alert(value);
            $.ajax({
                url: "typeexpense",
                type: "POST",
                data: 'typerequest=' + value,
                beforeSend: function() {
                    $(".tableDataValue").html();
                },
                success: function(data) {
                    $(".tableDataValue").html(data);
                }
            });
        });
        $("#mode").on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "modeexpense",
                type: "POST",
                data: 'moderequest=' + value,
                beforeSend: function() {
                    $(".tableDataValue").html();
                },
                success: function(data) {
                    $(".tableDataValue").html(data);
                }
            });
        });
        $("#status").on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "statusexpense",
                type: "POST",
                data: 'statusrequest=' + value,
                beforeSend: function() {
                    $(".tableDataValue").html();
                },
                success: function(data) {
                    $(".tableDataValue").html(data);
                }
            });
        });
    });
</script>