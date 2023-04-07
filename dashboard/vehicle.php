<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$id = $_SESSION['id'];
$role = $_SESSION['role'];
$session = $_SESSION["session"];
include('../includes/connection.php');
if (isset($_POST["submit"])) {
    $vehicle_no = $_POST["vehicle_no"];
    $route = $_POST["route"];
    $no_of_seat = $_POST["no_of_seat"];
    $available_seat = $_POST["available_seat"];
    $vehicle_type = $_POST["vehicle_type"];
    $status = $_POST["status"];
    $sql = "insert into vehicle(vehicle_no,route,no_of_seat,available_seat,vehicle_type,status,session,school_id)values('$vehicle_no','$route','$no_of_seat','$available_seat','$vehicle_type','$status','$session','$id')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = '<div class="alert alert-success" role="alert">
          Vehicle added successfully!
        </div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
          Failed to add vehicle!
        </div>';
    }
}
$sql2 = "select * from vehicle where school_id='$id' and session='$session'";
$res2 = mysqli_query($conn, $sql2);
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
        <h1>Add Vehicle</h1>
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
                        <h5 class="card-title">Add Vehicle</h5>
                        <!-- General Form Elements -->
                        <form class="add-expense" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Vehicle No.<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="vehicle_no" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4"> <label for="inputText" class="col-sm-4 col-form-label">Route<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="route" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">No. of seat<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="number" name="no_of_seat" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Available Seat<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="available_seat" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Vehicle Type<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="vehicle_type" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Status<span class="red">*</span></label>
                                        <div class="col-sm-8"> <select class="form-select" aria-label="Default select example" required="" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Save Vehicle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">All Vehicle List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right">
                                <a href="exportclass.php" class="btn btn-success mt-3"><span><i class="bi bi-save2-fill text-white"></i></span> Export Data</a>
                            </div>
                        </div>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Vehicle No.</th>
                                        <th scope="col">Route</th>
                                        <th scope="col">Number of seat</th>
                                        <th scope="col">Available Seat</th>
                                        <th scope="col">Vehicle Type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["vehicle_no"]; ?></td>
                                            <td><?php echo $data["route"]; ?></td>
                                            <td><?php echo $data["no_of_seat"]; ?></td>
                                            <td><?php echo $data["available_seat"]; ?></td>
                                            <td><?php echo $data["vehicle_type"]; ?></td>
                                            <td><?php echo $data["status"]; ?></td>
                                            <td><a href="vehicleEdit.php?id=<?php echo $data["id"]; ?>" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                                                <a href="vehicleDelete.php?id=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php }  ?>
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