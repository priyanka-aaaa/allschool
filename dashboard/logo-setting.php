<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
include '../includes/connection.php';
$id = $_SESSION['id'];
if (isset($_FILES['file'])) {
  
    $file_name = $_FILES['file']['name'];
  
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $name = $_POST['schoolname'];
    $tagline = $_POST['tagline'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $phone = $_POST['phone'];
    $schoolaffiliation = $_POST['schoolaffiliation'];
    $affiliation = $_POST['affiliation'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $extension = array("jpg", "png", "jpeg");
    $rand = rand(00000, 99999);
    $imgname = $rand . $file_name;
    if (!in_array($ext, $extension)) {
        $msg = '<div class="alert alert-danger" role="alert">
        Invalid file type
      </div>';
    }
    if ($file_size > 2097152) {
        $msg = '<div class="alert alert-danger" role="alert">
        File is too large
      </div>';
    } else {

        if($file_name==""){
            $sqlQuery = "update school set admin_id='$id',name='$name',tagline='$tagline',address='$address',school_email='$school_email',website='$website',phone='$phone',schoolaffiliation='$schoolaffiliation',affiliation_id='$affiliation' where id='$id'";
            
        }else{
            $sqlQuery = "update school set admin_id='$id',logo='$imgname',name='$name',tagline='$tagline',address='$address',school_email='$school_email',website='$website',phone='$phone',schoolaffiliation='$schoolaffiliation',affiliation_id='$affiliation' where id='$id'";
        }
     

       
    //    echo
        $resultQuery = mysqli_query($conn, $sqlQuery);
        move_uploaded_file($file_tmp_name, "upload/" . $imgname);
        $msg = '<div class="alert alert-success" role="alert">
        Details uploaded successfully
      </div>';
    }
}
$mydata = "SELECT * FROM school WHERE id = '$id'";
$myresult = mysqli_query($conn, $mydata);
?>
<?php include 'header.php'; ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Logo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Logo</li>
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
                        <form method="post" enctype="multipart/form-data">
                            <?php while ($row = mysqli_fetch_assoc($myresult)) {  ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-12 col-form-label">School logo</label>
                                            <div class="col-sm-12">
                                                <div class="dropify-wrapper">
                                                    <span><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                                    <p>Drag and drop or click to replace</p>
                                                    <input class="form-control file-input" type="file" name="file" id="input-file-now" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">School Name</label>
                                            <div class="col-sm-9"> <input type="text" name="schoolname" class="form-control" value="<?php echo strtoupper($row['name']); ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Tagline</label>
                                            <div class="col-sm-9"> <input type="text" name="tagline" class="form-control" value="<?php echo ucwords($row['tagline']); ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9"> <input type="text" name="address" class="form-control" value="<?php echo strtoupper($row['address']); ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">E-mail</label>
                                            <div class="col-sm-9"> <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Website</label>
                                            <div class="col-sm-9"> <input type="text" name="website" class="form-control" value=" <?php echo $row['website']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">Official Phone</label>
                                            <div class="col-sm-9"> <input type="text" name="phone" class="form-control" value=" <?php echo $row['phone']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">School Affiliation</label>
                                            <div class="col-sm-9"> <input type="text" name="schoolaffiliation" class="form-control" value="<?php echo $row['schoolaffiliation']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">School Affiliation ID</label>
                                            <div class="col-sm-9"> <input type="text" name="affiliation" class="form-control" value="<?php echo $row['affiliation_id']; ?>" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Submit</button>
                                    </div>
                                </div>
                            <?php } ?>
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
</script>