<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../super/login.php");
}
?>
<?php
include '../includes/connection.php';
if (isset($_FILES['file'])) {
    $id = $_SESSION['id'];
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
    $rand = rand(00000,99999);
    $imgname = $rand.$file_name;
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
        $sqlQuery = "INSERT INTO school_details(admin_id,logo,name,tagline,address,email,website,phone,schoolaffiliation,affiliation_id) VALUES ('$id','$imgname', '$name', '$tagline', '$address', '$email', '$website', '$phone','$schoolaffiliation', '$affiliation')";
        $resultQuery = mysqli_query($conn, $sqlQuery);
        move_uploaded_file($file_tmp_name, "upload/" .$imgname);
        $msg = '<div class="alert alert-success" role="alert">
        Details uploaded successfully
      </div>';
    }
}
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

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-12 col-form-label">School logo</label>
                                        <div class="col-sm-12">
                                            <div class="dropify-wrapper">
                                                <span><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                                <p>Drag and drop or click to replace</p>
                                                <input class="form-control" type="file" name="file" id="formFile" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">School Name</label>
                                        <div class="col-sm-9"> <input type="text" name="schoolname" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Tagline</label>
                                        <div class="col-sm-9"> <input type="text" name="tagline" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9"> <input type="text" name="address" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">E-mail</label>
                                        <div class="col-sm-9"> <input type="text" name="email" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputEmail" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9"> <input type="text" name="website" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">Official Phone</label>
                                        <div class="col-sm-9"> <input type="text" name="phone" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">School Affiliation</label>
                                        <div class="col-sm-9"> <input type="text" name="schoolaffiliation" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">School Affiliation ID</label>
                                        <div class="col-sm-9"> <input type="text" name="affiliation" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit"><span><i class="bi bi-save2-fill"></i></span> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                $id = $_SESSION['id'];
                                $mydata = "SELECT * FROM school_details WHERE admin_id = '$id'";
                                $myresult = mysqli_query($conn, $mydata);
                                if (mysqli_num_rows($myresult) > 0) {
                                    while ($row = mysqli_fetch_assoc($myresult)) {
                                ?>
                                    <div class="print-page">
                                        <div class="main-block">
                                            <div class="logo-left">
                                            <div class="logo-icon"><img src="upload/<?php echo $row['logo']; ?>" class="img-responsive"></div>
                                            </div>
                                            <div class="logo-content">
                                            <div class="logo-title"><h1><?php echo strtoupper($row['name']); ?></h1></div>
                                            <div class="tagline"><?php echo ucwords($row['tagline']); ?></div>
                                            </div>
                                        </div>                                      
                                       
                                        <div class="address"><h3><?php echo strtoupper($row['address']); ?></h3></div>
                                       <div class="email-id"><p>Email: <?php echo $row['email']; ?></p></div>
                                        <div class="website"><p>Website: <?php echo $row['website']; ?></p></div>
                                        <div class="phone"><p>Phone: <?php echo $row['phone']; ?></p></div> 
                                        <div class="aff"><h5>School Affiliation: <?php echo $row['schoolaffiliation']; ?></h5></div>                                      
                                        <div class="aff-id"><h5>Affiliation ID: <?php echo $row['affiliation_id']; ?></h5></div>
                                       
                                    </div>

                                <?php
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>No Records Found</div>";
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>