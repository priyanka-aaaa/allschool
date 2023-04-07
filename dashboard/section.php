<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
$school_id = $_SESSION['id'];
if (isset($_GET["schoolid"])) {
    $_SESSION["id"] = $_GET['schoolid'];
    $school_id = $_GET['schoolid'];
}
$session = $_SESSION["session"];
?>
<?php
include('../includes/connection.php');
$sql2 = "select * from class WHERE school_id='$school_id' and session='$session'";
$res2 = mysqli_query($conn, $sql2);
$role = $_SESSION['role'];

$sql3 = "select * from teacher WHERE school_id='$school_id'";
$res3 = mysqli_query($conn, $sql3);
$sql4 = "select * from class_name";
$res4 = mysqli_query($conn, $sql4);
if (isset($_POST["submit"])) {
    $session = $_SESSION["session"];
    $class_name = $_POST["class"];
    $sectionold = $_POST["section"];
    $section = ucfirst($sectionold);
    $incharge = $_POST["incharge"];
    $student_allowed = $_POST["student_allowed"];

    $sql5 = "select * from section where class_id='$class_name' and section='$section' and school_id='$school_id' and session='$session'";
    $res5 = mysqli_query($conn, $sql5);
    $count5 = mysqli_num_rows($res5);
    if ($count5 < 1) {

        $sql = "insert into section(session,class_id,section,incharge,student_allowed,school_id) values('$session','$class_name','$section','$incharge','$student_allowed','$school_id')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $msg = '<div class="alert alert-success" role="alert">
              Section added successfully!
            </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
              Failed to add Section!
            </div>';
        }
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
        Already exist this Section !
      </div>';
    }
}
$sql8 = "SELECT section.*, class.class_name
FROM section
INNER JOIN class ON section.class_id=.class.id 
WHERE section.school_id = '$school_id' and section.session = '$session'";
$res8 = mysqli_query($conn, $sql8);
?>

<?php include 'header.php'; ?>
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
        <h1>Add New Section</h1>
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
                        <h5 class="card-title">Add New Section</h5>
                        <!-- General Form Elements -->
                        <form method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4"> <label for="inputText" class=" col-form-label">Class<span class="red">*</span></label></div>
                                        <div class="col-sm-8"> <select class="form-select" aria-label="Default select example" required name="class">
                                                <option value="">Select class</option>
                                                <?php while ($data = mysqli_fetch_assoc($res2)) { ?>
                                                    <option value='<?php echo $data["id"]; ?>'><?php echo $data["class_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Section Name<span class="red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required name="section">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Incharge Name<span class="red">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select" aria-label="Default select example" name="incharge" required>
                                                <option value="">Select Incharge</option>
                                                <?php while ($data = mysqli_fetch_assoc($res3)) { ?>
                                                    <option value='<?php echo $data["fullname"]; ?>'><?php echo $data["fullname"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Student allowed per
                                            section</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" placeholder="Optional" name="student_allowed">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8">
                                            <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save Section</button>
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
                                <h5 class="card-title">All Section List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                                <a href="exportsection.php" class="btn btn-success mt-3 text-white"><span><i class="bi bi-save2-fill"></i></span> Export Result</a>
                            </div>
                        </div>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Class Name</th>
                                        <th scope="col">Section Name</th>
                                        <th scope="col">Incharge Name</th>
                                        <th scope="col">Student Allowed</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res8)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["class_name"]; ?></td>
                                            <td><?php echo $data["section"]; ?></td>
                                            <td><?php echo $data["incharge"]; ?></td>
                                            <td><?php echo $data["student_allowed"]; ?></td>
                                            <td><a href="sectionedit.php?id=<?php echo $data["id"]; ?>" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                                                <a href="sectiondel.php?secid=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
        </div>
    </section>
</main><!-- End #main -->
<?php include 'footer.php'; ?>