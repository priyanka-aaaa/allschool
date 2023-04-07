<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$id = $_SESSION['id'];
$role = $_SESSION['role'];
$session = $_SESSION["session"];
include('../includes/connection.php');
$currentId = $_GET["id"];

if (isset($_POST["submit"])) {
    $vehicle_no = $_POST["vehicle_no"];
    $route = $_POST["route"];
    $no_of_seat = $_POST["no_of_seat"];
    $available_seat = $_POST["available_seat"];
    $vehicle_type = $_POST["vehicle_type"];
    $status = $_POST["status"];
    $sql = "update vehicle set vehicle_no='$vehicle_no',route='$route',no_of_seat='$no_of_seat',
    available_seat='$available_seat',vehicle_type='$vehicle_type',status='$status' where id='$currentId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = '<div class="alert alert-success" role="alert">
          Vehicle Edit successfully!
        </div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
          Failed to edit vehicle!
        </div>';
    }
}
$sql2 = "select * from vehicle where school_id='$id' and session='$session'";
$res2 = mysqli_query($conn, $sql2);
$sql3 = "select * from vehicle where id='$currentId'";
$res3 = mysqli_query($conn, $sql3);
?>
<?php include 'header.php'; ?>
<style>
    .buttons {
        display: none;
    }

    a.paginate_button.current {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    div#myTable_paginate {
        color: #fff;
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
        <h1>Edit Vehicle</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Vehicle</li>
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
                        <h5 class="card-title">Edit Vehicle</h5>
                        <!-- General Form Elements -->
                        <form class="add-expense" method="post" enctype="multipart/form-data">
                            <?php
                            while ($row3 = mysqli_fetch_assoc($res3)) {
                            ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Vehicle No.<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input type="text" name="vehicle_no" class="form-control" value="<?php echo $row3['vehicle_no']; ?>" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-4"> <label for="inputText" class="col-sm-4 col-form-label">Route<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input type="text" name="route" class="form-control" value="<?php echo $row3['route']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">No. of seat<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input type="number" name="no_of_seat" class="form-control" value="<?php echo $row3['no_of_seat']; ?>" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Available Seat<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input type="text" name="available_seat" class="form-control" value="<?php echo $row3['available_seat']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Vehicle Type<span class="red">*</span></label>
                                            <div class="col-sm-8"> <input type="text" name="vehicle_type" class="form-control" value="<?php echo $row3['vehicle_type']; ?>" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Status<span class="red">*</span></label>
                                            <div class="col-sm-8"> <select class="form-select" aria-label="Default select example" required="" name="status"  ?>required>
                                                    <?php if ($row3['status'] == "active") {

                                                    ?>
                                                        <option value="active" selected>Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="active">Active</option>
                                                        <option value="inactive" selected>Inactive</option>
                                                    <?php

                                                    }
                                                    ?>

                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Edit Vehicle</button>
                                    </div>
                                </div>
                            <?php  } ?>
                        </form>
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