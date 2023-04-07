<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo ucwords($_SESSION['name']); ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <!-- <link rel="stylesheet" href="../css/style.css" /> -->
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  <!-- Template Main CSS File -->
  <link href="../assets/font/stylesheet.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .select-session {
      margin-left: 15px;
    }

    span.current_session {
      font-weight: bold;
      color: green;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"><?php echo ucwords($_SESSION['name']); ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <span class="current_session">
      <?php
      $firstMonth = array("January", "February", "March");
      $currentYear = date("Y");
      $month = date('F');
      if (in_array($month, $firstMonth)) {
        $secondYear =   $currentYear - 1;
        $totalSession = $secondYear . "-" . $currentYear;
        $nextSession = $secondYear + 1 . "-" . $currentYear + 1;
      } else {
        $secondYear =   $currentYear + 1;
        $totalSession = $currentYear . "-" . $secondYear;
        $nextSession = $secondYear + 1 . "-" . $currentYear + 1;
      }
      echo $_SESSION["session"];
      ?>
    </span>
    <div class="dropdown select-session">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Switch Other Session
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="changeSession.php?session=<?php echo $totalSession; ?>"><?php echo $totalSession; ?></a></li>
        <li><a class="dropdown-item" href="changeSession.php?session=<?php echo $nextSession; ?>"><?php echo $nextSession; ?></a></li>
      </ul>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <div class="panel">
          <h4>
            <?php
            // if ($_SESSION['role'] == 'superadmin') {
            //   echo 'Super Admin Panel';
            // } else if ($_SESSION['role'] == 'admin') {
            echo 'Principal Panel';
            // } else {
            //   echo 'Clerk Panel';
            // }
            ?>
          </h4>
        </div>
        <li class="nav-item d-block d-lg-none">
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/profile-img.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo ucwords($_SESSION['name']); ?></span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo ucwords($_SESSION['name']); ?></h6>
              <span>Recognized</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <?php if (isset($_GET["schoolid"])) {
                $schoolid = $_GET["schoolid"];
                echo '<a class="dropdown-item d-flex align-items-center" href="logo-setting.php?schoolid=' . $schoolid . '"> <i class="bi bi-gear"></i><span>Logo Settings</span></a>';
              ?>
              <?php
              } else {
              ?>
                <a class="dropdown-item d-flex align-items-center" href="logo-setting.php">
                  <i class="bi bi-gear"></i>
                  <span>Logo Settings</span>
                </a>
              <?php } ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <?php if (isset($_GET["schoolid"])) {
                $schoolid = $_GET["schoolid"];
                echo '<a class="dropdown-item d-flex align-items-center" href="users-profile.php?schoolid=' . $schoolid . '"> <i class="bi bi-person"></i><span>My Profile</span></a>';
              ?>
              <?php
              } else {
              ?>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              <?php } ?>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <!-- <li>
              <?php if (isset($_GET["schoolid"])) {
                $schoolid = $_GET["schoolid"];
                echo '<a class="dropdown-item d-flex align-items-center" href="class.php?schoolid=' . $schoolid . '"> <i class="fa-solid fa-school"></i><span>Class</span></a>';
              ?>
              <?php
              } else {
              ?>
                <a class="dropdown-item d-flex align-items-center" href="class.php">
                  <i class="fa-solid fa-school"></i>
                  <span>Class</span>
                </a>
              <?php } ?>
            </li> -->
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="ri-home-3-line"></i><span>Home</span>
        </a>
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-columns"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li class="dropdown">
            <?php
            if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="class.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Class</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="class.php">
                <i class="bi bi-circle"></i><span>Class</span>
              </a>
            <?php } ?>
          </li>

          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="teacher.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Teacher</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="teacher.php">
                <i class="bi bi-circle"></i><span>Teacher</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="section.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Section</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="section.php">
                <i class="bi bi-circle"></i><span>Section</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="admission.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Admission</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="admission.php">
                <i class="bi bi-circle"></i><span>Admission</span>
              </a>
            <?php } ?>
          </li>

          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="studentList.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Student List</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="studentList.php">
                <i class="bi bi-circle"></i><span>Student List</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="school-leaving-certificate.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Certificates</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="school-leaving-certificate.php">
                <i class="bi bi-circle"></i><span>Certificates</span>
              </a>
            <?php } ?>
          </li>
        </ul>
      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-stack"></i><span>Fee Collection</span></i><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="payment-receipt.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Payment Receipt</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="payment-receipt.php">
                <i class="bi bi-circle"></i><span> Payment Receipt</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="allreceipt.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>All Receipt</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="allreceipt.php">
                <i class="bi bi-circle"></i><span> All Receipt</span>
              </a>
            <?php } ?>
          </li>
          <!-- <li>
            <a href="fee-collection.php">
              <i class="bi bi-circle"></i><span> Collect / Search / Due Fees</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-credit-card-2-front"></i><span>Expenses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="expense.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Add /Search Expenses</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="expense.php">
                <i class="bi bi-circle"></i><span>Add /Search Expenses</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="expense_type.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Expense Type</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="expense_type.php">
                <i class="bi bi-circle"></i><span>Expense Type</span>
              </a>
            <?php } ?>
          </li>
        </ul>
      </li>

      <!-- start for transport management -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-credit-card-2-front"></i><span>Transport</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="expense.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Routes</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="route.php">
                <i class="bi bi-circle"></i><span>Routes</span>
              </a>
            <?php } ?>
          </li>
          <li class="dropdown">
            <?php if (isset($_GET["schoolid"])) {
              $schoolid = $_GET["schoolid"];
              echo '<a href="expense_type.php?schoolid=' . $schoolid . '"> <i class="bi bi-circle"></i><span>Vehicle</span></a>';
            ?>
            <?php
            } else {
            ?>
              <a href="vehicle.php">
                <i class="bi bi-circle"></i><span>Vehicle</span>
              </a>
            <?php } ?>
          </li>
        </ul>
      </li>
      <!-- end for transport management -->
      <!-- End Tables Nav -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Master Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="fee-report.php">
              <i class="bi bi-circle"></i><span>Fee Report</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.php">
              <i class="bi bi-circle"></i><span>Class Report</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.php">
              <i class="bi bi-circle"></i><span>Expenses Report</span>
            </a>
          </li>
        </ul>
      </li> -->
    </ul>
  </aside><!-- End Sidebar-->