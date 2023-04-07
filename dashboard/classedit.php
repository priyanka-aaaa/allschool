<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
?>
<?php
include('../includes/connection.php');
$id = $_GET["id"];
if (isset($_POST["submit"])) {

    $session = $_POST["session"];
    $class_name = $_POST["class"];

    $annual_fee = $_POST["annual_fee"];


    $sqlIns = "update class set class_name='$class_name',annual_fee='$annual_fee' where id='$id'";
    $resIns = mysqli_query($conn, $sqlIns);
    if ($resIns) {
        $msg = '<div class="alert alert-success" role="alert">
        Class edit successfully!
        </div>';
    } else {
        $resIns = '<div class="alert alert-danger" role="alert">
        Failed to add class!
        </div>';
    }
}
$sqlclass = "select * from class where id='$id'";
$resclass = mysqli_query($conn, $sqlclass);
$sql2 = "select * from class";
$res2 = mysqli_query($conn, $sql2);
$sql3 = "select * from teacher";
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
        <h1>Edit Class<span></span></h1>
     
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Class
                        <span><a href="class.php" class="btn btn-primary backall">See All Class</a></span>

                        </h5>

                        <!-- General Form Elements -->
                        <form method="post">
                            <?php while ($rowclass = mysqli_fetch_array($resclass)) { ?>
                                <div class="row">
                                
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label for="inputText" class="col-sm-4 col-form-label">Class<span class="red">*</span></label>
                                            <div class="col-sm-8"> <select class="form-select" aria-label="Default select example" required name="class">

                                                    <?php while ($data = mysqli_fetch_assoc($res4)) { ?>
                                                        <?php if ($data["class"] == $rowclass['class_name']) { ?>

                                                            <option value='<?php echo $data["class"]; ?>' selected><?php echo $data["class"]; ?></option>
                                                        <?php } else { ?>
                                                            <option value='<?php echo $data["class"]; ?>'><?php echo $data["class"]; ?></option>
                                                    <?php }
                                                    } ?>
                                                    <!-- <option value="Pre-Nursery">Pre-Nursery</option> -->


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row  mt-3">

                                    <div class="col-sm-10">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-5 col-form-label">Annual fee
                                                package</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="Optional" name="annual_fee" value="<?php echo $rowclass['annual_fee']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save Class</button>
                                    </div>
                                </div>
                            <?php }  ?>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>

    </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>