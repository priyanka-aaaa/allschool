<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$id = $_SESSION['id'];
$role = $_SESSION['role'];
$session = $_SESSION["session"];
$currentId=$_GET["id"];
include('../includes/connection.php');
if (isset($_POST["submit"])) {
    $destination = $_POST["destination"];
    $cost = $_POST["cost"];
    $main_route = $_POST["main_route"];
    $distance = $_POST["distance"];
    $sql = "update route set destination='$destination',cost='$cost',main_route='$main_route',distance='$distance' where id='$currentId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = '<div class="alert alert-success" role="alert">
          Route edit successfully!
        </div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
          Failed to edit route!
        </div>';
    }
}
$sql2="select * from route where id='$currentId'";

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
        <h1>Edit Route</h1>
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
                        <h5 class="card-title">Edit Route</h5>
                        <!-- General Form Elements -->
                        <form class="add-expense" method="post" enctype="multipart/form-data">
                            <?php 
                            while($row2=mysqli_fetch_assoc($res2)){

                           ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Destination<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="destination" class="form-control" value="<?php echo $row2['destination'];?>" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4"> <label for="inputText" class="col-sm-4 col-form-label">Cost<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="cost" class="form-control"  value="<?php echo $row2['cost'];?>" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputDate" class="col-sm-4 col-form-label">Main Route<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="main_route" class="form-control" value="<?php echo $row2['main_route'];?>" required></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Distance<span class="red">*</span></label>
                                        <div class="col-sm-8"> <input type="text" name="distance" class="form-control" value="<?php echo $row2['distance'];?>" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Save Route</button>
                                </div>
                            </div>
                            <?php  }  ?>
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