<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
?>

<?php
include '../includes/connection.php';
if (isset($_POST['submit'])) {
  $adminid = $_SESSION['id'];
  $newpass = md5($_POST['newpassword']);
  $renewpass = md5($_POST['renewpassword']);
  if ($newpass != $renewpass) {
    echo "<script>alert('Renew password does not match with New password');</script>";
  } else if ($newpass === $renewpass) {
    $query6 = "UPDATE school SET password='$renewpass' WHERE id='$adminid'";
    $result6 = mysqli_query($conn, $query6);
    if ($result6) {
      echo "<script>alert('Password updated successfully!!');</script>";
    } else {
      echo "<script>alert('Failed to update password!!');</script>";
    }
  }
}

?>

<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <?php
            $adminid = $_SESSION['id'];
            $query3 = "SELECT * FROM school WHERE id='$adminid'";
            $result3 = mysqli_query($conn, $query3);
            while ($val = mysqli_fetch_assoc($result3)) { ?>
              <img src="upload/<?php echo $val['logo']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo ucwords($val['name']); ?></h2>

              <h3>Recognized</h3>
              <div class="social-links mt-2">
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

              <li class="nav-item">
                <a href="logo-setting.php" class="nav-link">Logo Setting</a>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?php echo ucwords($val['name']); ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?php echo $val['email']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Country</div>
                  <div class="col-lg-9 col-md-8">INDIA</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8"><?php echo $val['address']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?php echo $val['phone']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Website</div>
                  <div class="col-lg-9 col-md-8"><?php echo $val['website']; ?></div>
                </div>

              </div>
            <?php } ?>
            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form method="post" action="">

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php include 'footer.php'; ?>