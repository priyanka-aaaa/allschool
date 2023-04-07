<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
if (isset($_GET["schoolid"]))  {
  $_SESSION["id"] = $_GET['schoolid'];
}

?>

<?php include 'header.php'; ?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Admissions</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-user-follow-line"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php
                      include('../includes/connection.php');
                      $schoolId = $_SESSION['id'];
                      $role = $_SESSION['role'];


                      $sql = "SELECT * FROM admission WHERE school_id = '$schoolId'";
                      $query = $conn->query($sql);
                      echo $query->num_rows;

                      ?>
                    </h6>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Classes</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-book-open-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php

                      $sql = "SELECT * FROM class WHERE school_id = '$schoolId'";
                      $query = $conn->query($sql);
                      echo $query->num_rows;

                      ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-xxl-3 col-xl-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Teachers</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php

                      $sql = "SELECT * FROM teacher WHERE school_id = '$schoolId'";
                      $query = $conn->query($sql);
                      echo $query->num_rows;

                      ?>
                    </h6> 
                    
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-xxl-3 col-xl-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Sections</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-flag-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php

                      $sql = "SELECT * FROM section WHERE school_id = '$schoolId'";
                      $query = $conn->query($sql);
                      echo $query->num_rows;

                      ?>
                    </h6>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>