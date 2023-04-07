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
    $destination = $_POST["destination"];
    $cost = $_POST["cost"];
    $main_route = $_POST["main_route"];
    $distance = $_POST["distance"];
    $sql = "insert into route(destination,cost,main_route,distance,session,school_id)values('$destination','$cost','$main_route','$distance','$session','$id')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = '<div class="alert alert-success" role="alert">
          Route added successfully!
        </div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
          Failed to add route!
        </div>';
    }
}
$sql2="select * from route where school_id='$id' and session='$session'";
$res2=mysqli_query($conn,$sql2);

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
        <h1>Add Route</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Route</li>
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
                        <h5 class="card-title">Add Route</h5>
                        <!-- General Form Elements -->
                        <form class="add-expense" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Destination<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="destination" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4"> <label for="inputText" class="col-sm-4 col-form-label">Cost<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="cost" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Main Route<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="main_route" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Distance<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="distance" class="form-control" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Save Route</button>
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
                                <h5 class="card-title">All Class List</h5>
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
                                        <th scope="col">Destination</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Main Route</th>
                                        <th scope="col">Distance</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["destination"]; ?></td>
                                            <td><?php echo $data["cost"]; ?></td>
                                            <td><?php echo $data["main_route"]; ?></td>
                                            <td><?php echo $data["distance"]; ?></td>
                                           

                                            <td><a href="routeEdit.php?id=<?php echo $data["id"]; ?>" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                                                <a href="routeDelete.php?id=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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