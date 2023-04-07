<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
?>
<?php
include('../includes/connection.php');
$id = $_GET["id"];
$school_id = $_SESSION["id"];
if (isset($_POST["submit"])) {

    $class_name = $_POST["class"];
    $section = $_POST["section"];
    $incharge = $_POST["incharge"];
    $student_allowed = $_POST["student_allowed"];
    $sqlIns = "update section set class_id='$class_name',section='$section',incharge='$incharge',student_allowed='$student_allowed' where id='$id'";
    $resIns = mysqli_query($conn, $sqlIns);
    if ($resIns) {
        $msg = '<div class="alert alert-success" role="alert">
        Section edit successfully!
        </div>';
    } else {
        $resIns = '<div class="alert alert-danger" role="alert">
        Failed to Edit Section!
        </div>';
    }
}
$sqlclass = "select * from section where id='$id'";
$resclass = mysqli_query($conn, $sqlclass);

$sql2 = "select * from class WHERE school_id = '$school_id'";
$res2 = mysqli_query($conn, $sql2);
$sql3 = "select * from teacher WHERE school_id = '$school_id'";
$res3 = mysqli_query($conn, $sql3);
$sql4 = "select * from class_name";
$res4 = mysqli_query($conn, $sql4);

?>
<?php include 'header.php'; ?>
<style>
    a.btn.btn-primary.backall {
        float: right;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Section </span></h1>
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Section <span><a href="section.php" class="btn btn-primary backall">See All Section</a></h5>
                        <!-- General Form Elements -->
                        <form method="post">
                            <?php while ($rowclass = mysqli_fetch_array($resclass)) { ?>
                                <div class="row my-3">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label for="inputText" class="col-sm-4 col-form-label">Class<span class="red">*</span></label>
                                            <div class="col-sm-8"> <select class="form-select" aria-label="Default select example" required name="class">
                                                    <option value="">Select class</option>
                                                    <?php while ($data = mysqli_fetch_assoc($res2)) { ?>
                                                        <?php if ($data["id"] == $rowclass['class_id']) { ?>
                                                            <option value='<?php echo $data["id"]; ?>' selected><?php echo $data["class_name"]; ?></option>

                                                        <?php } else { ?>

                                                            <option value='<?php echo $data["id"]; ?>'><?php echo $data["class_name"]; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row ">
                                            <label for="inputText" class="col-sm-4 col-form-label">Section Name<span class="red">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" required name="section" value="<?php echo $rowclass['section']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-6">
                                        <div class="row ">
                                            <label for="inputText" class="col-sm-4 col-form-label">Incharge Name<span class="red">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <select class="form-select" aria-label="Default select example" name="incharge" required>
                                                    <option value="">Select Incharge</option>
                                                    <?php while ($data = mysqli_fetch_assoc($res3)) { ?>

                                                        <?php if ($data["fullname"] == $rowclass['incharge']) { ?>
                                                            <option value='<?php echo $data["fullname"]; ?>' selected><?php echo $data["fullname"]; ?></option>

                                                        <?php } else { ?>
                                                            <option value='<?php echo $data["fullname"]; ?>'><?php echo $data["fullname"]; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Student allowed per
                                                section</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" placeholder="Optional" name="student_allowed" value="<?php echo $rowclass['student_allowed']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span>Edit Section</button>
                                    </div>
                                </div>
                            <?php }  ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>