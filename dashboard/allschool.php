<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../login.php");
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
    <h1>All School</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Master</li>
        <li class="breadcrumb-item active">All School</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <h5 class="card-title">All School List</h5>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right ">
              </div>
            </div>

            <div class="classType-block">
              <div class="row">
                <?php
                include '../includes/connection.php';
                $schoolid  = $_SESSION['id'];
                $role = $_SESSION['role'];
                if ($role == 'superadmin') {
                  $getquery = "SELECT school_details.*, school.id FROM school_details LEFT JOIN school ON school_details.admin_id = school.id";
                  $resultquery = mysqli_query($conn, $getquery);
                } 
                while ($data = mysqli_fetch_assoc($resultquery)) {
             $aa="https://buyptevoucher.in/live/schoolmanagement/dashboard/index?schoolid=";
                  $urls=$aa.$data['tagline'];
                  

               
                  ?>
                  <div class="col-xl-3">
                    <a href="<?php echo $urls;?>">
                    <div class="card user-card">
                      <div class="card-body text-center">
                        <div class="mb-3"><span class="avatar avatar-xl avatar-rounded"><img src="upload/<?= $data['logo']; ?>" alt="logo"></span>
                        </div>
                        <div class="text-muted">
                          <?= $data['tagline']; ?>
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
                    </a>
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