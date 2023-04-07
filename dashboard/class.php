<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION["id"];
if (isset($_GET["schoolid"])) {
    $_SESSION["id"] = $_GET['schoolid'];
    $school_id = $_GET['schoolid'];
}
$session = $_SESSION["session"];
?>
<?php
include('../includes/connection.php');
$sql4 = "select * from class_name";
$res4 = mysqli_query($conn, $sql4);
if (isset($_POST["submit"])) {
    // $session = $_POST["session"];
    $class_name = $_POST["class"];
    $annual_fee = $_POST["annual_fee"];
    $sql5 = "select * from class where class_name='$class_name' and session='$session' and school_id = '$school_id'";
    $res5 = mysqli_query($conn, $sql5);
    $count5 = mysqli_num_rows($res5);
    if ($count5 < 1) {
        $sql = "insert into class(school_id,session,class_name,annual_fee) values('$school_id','$session','$class_name','$annual_fee')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $msg = '<div class="alert alert-success" role="alert">
              Class added successfully!
            </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
              Failed to add class!
            </div>';
        }
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
        This class already exist!
      </div>';
    }
}
$sql2 = "select * from class WHERE  session='$session' and school_id='$school_id'";
$res2 = mysqli_query($conn, $sql2);
?>
<?php include 'header.php'; ?>
<script>
    function checkdelete() {
        return confirm('Are you sure to delete?');
    }
    if (confirm == 'yes') {
        window.location.href = "#";
    } 
</script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Class</h1>
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
                        <h5 class="card-title">Add New Class</h5>
                        <!-- General Form Elements -->
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="inputText" class="col-sm-4 col-form-label">Class<span class="red">*</span></label>
                                        <div class="col-sm-4"> <select class="form-select" aria-label="Default select example" required name="class">
                                                <option value="">Select class</option>
                                                <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                    <option value='<?php echo $data["class"]; ?>'><?php echo $data["class"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="row">
                                            <label for="inputText" class="col-sm-4 col-form-label">Annual fee package<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" placeholder="Annual fee package" name="annual_fee" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8">
                                            <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save Class</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
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
                                        <th scope="col">Class Name</th>
                                        <th scope="col">Annual fee package</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["class_name"]; ?></td>
                                            <td><?php echo $data["annual_fee"]; ?></td>
                                            <td><a href="classedit.php?id=<?php echo $data["id"]; ?>" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                                                <a href="classdelete.php?id=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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