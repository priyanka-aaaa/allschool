<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
if (isset($_GET["schoolid"]))  {
  $_SESSION["id"] = $_GET['schoolid'];
  
}
?>
<?php
include('../includes/connection.php');
if (isset($_POST['save-session'])) {
  $schoolid  = $_SESSION['id'];
  $year  = $_POST['session-year'];
  $note  = mysqli_real_escape_string($conn, $_POST['note']);
  $sessionNote = ucwords($note);
  if ($year == "" || $sessionNote == "") {
    $msg = '<div class="alert alert-danger" role="alert">
   Mandatory fields are required
  </div>';
  } else {
    $thequery = "INSERT INTO session(school_id, session_year, note) VALUES ('$schoolid', '$year', '$sessionNote')";
    $theresult = mysqli_query($conn, $thequery);
    if ($theresult == true) {
      $msg = '<div class="alert alert-success" role="alert">
   session saved successfully
  </div>';
    } else {
      $msg = '<div class="alert alert-danger" role="alert">
    session could not be saved
  </div>';
    }
  }
}

?>
<?php include 'header.php'; ?>
<script>
  function checkdelete() {
    return confirm('Are you sure to delete?');
  }
  if (confirm == 'yes') {
    window.location.href = "#";
  } else {

  }
</script>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Class Session</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Master</li>
        <li class="breadcrumb-item active">Class Session</li>
      </ol>
    </nav>
  </div>
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
            <h5 class="card-title">Add New Session</h5>

            <!-- General Form Elements -->
            <form method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="row mb-3">
                    <label for="text" class="col-sm-3 col-form-label">Session Year<span class="red">*</span> </label>
                    <div class="col-sm-9">
                      <input type="text" name="session-year" class="form-control" placeholder="Session year" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <label for="inputText" class="col-sm-2 col-form-label">Note<span class="red">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="note" class="form-control" placeholder="Add note for this session" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-10 ml-3">
                  <button type="submit" name="save-session" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save Session</button>
                </div>
              </div>
            </form>
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
                <h5 class="card-title">All Session List</h5>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right ">
              </div>
            </div>

            <div class="classType-block">
              <div class="row">
                <?php
                $schoolid  = $_SESSION['id'];
                $role = $_SESSION['role'];
            
                  $getquery = "SELECT session.*, school_details.admin_id, school_details.logo 
                  FROM session LEFT JOIN school_details ON session.school_id = school_details.admin_id 
                  WHERE session.school_id = " . $schoolid;
                  $resultquery = mysqli_query($conn, $getquery);
              
                while ($data = mysqli_fetch_assoc($resultquery)) { ?>
                  <div class="col-xl-3">
                    <div class="card user-card">
                      <div class="card-body text-center">
                        <div class="mb-3"><span class="avatar avatar-xl avatar-rounded"><img src="upload/<?= $data['logo']; ?>" alt="logo"></span>
                        </div>
                        <div class="card-title mb-1">
                          <b>Year <?= $data['session_year']; ?></b>
                        </div>
                        <div class="text-muted">
                          <?= $data['note']; ?>
                        </div>
                        <div data-v-63e01808="" class="dots dropdown"><a data-v-63e01808="" href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false" class="link-secondary"><svg data-v-63e01808="" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon">
                              <path data-v-63e01808="" stroke="none" d="M0 0h24v24H0z" fill="none">
                              </path>
                              <circle data-v-63e01808="" cx="5" cy="12" r="1"></circle>
                              <circle data-v-63e01808="" cx="12" cy="12" r="1"></circle>
                              <circle data-v-63e01808="" cx="19" cy="12" r="1"></circle>
                            </svg></a>
                          <div data-v-63e01808="" class="dropdown-menu dropdown-menu-end right-100">
                            <a href="sessiondel.php?sessionid=<?= $data['session_id']; ?> " class="dropdown-item" onclick="return checkdelete()">
                              Delete
                            </a>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>