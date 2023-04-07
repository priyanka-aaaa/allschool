<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../login.php");
}

$role = $_SESSION['role'];
$scid = $_SESSION['id'];
if (isset($_GET["schoolid"]))  {
    $scid = $_GET['schoolid'];
    $_SESSION['id'] =  $_GET['schoolid'];
}
?>
<?php
include '../includes/connection.php';

if (isset($_POST['submit'])) {
  
  $full_name = $_POST['full-name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $qualification = $_POST['qualification'];
  $speciality = $_POST['speciality'];
  $description = $_POST['description'];
  $joining_date = $_POST['joining-date'];
  $dob = $_POST['dob'];
  $aadhar = $_POST['aadhar'];
  $subject = $_POST['subject'];
  $address = $_POST['address'];
  if ($full_name == "" || $phone == "" || $speciality == "" || $dob == "" || $aadhar == "" || $subject == "") {
    $msg = '<div class="alert alert-danger" role="alert">
      Please fill the mandatory fields
    </div>';
  } else {
    $full_nameNew = ucfirst($full_name);
    $qualification = ucfirst($qualification);
    $description = ucfirst($description);
    $address = ucfirst($address);
    $subject = ucfirst($subject);


    $query = "INSERT INTO teacher(school_id, fullname, email, phone, qualification, speciality, description, joining_date, dob, aadhar, subject, address) VALUES ('$scid','$full_nameNew', '$email', '$phone', '$qualification', '$speciality','$description','$joining_date','$dob','$aadhar','$subject', '$address')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $msg = '<div class="alert alert-success" role="alert">
      Teacher added successfully!
    </div>';
    } else {
      $msg = '<div class="alert alert-danger" role="alert">
      Failed to add teacher!
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
    <h1>Teacher</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Master</li>
        <li class="breadcrumb-item active">Teacher</li>
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
        <div class="cardx">
          <div class="card-bodyx">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add Teacher</h5>

                <!-- General Form Elements -->
                <form method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Full Name <span class="red">*</span></label>
                        <div class="col-sm-8"> <input type="text" name="full-name" class="form-control" required></div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8"> <input type="email" name="email" class="form-control" placeholder="optional"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Phone Number <span class="red">*</span></label>
                        <div class="col-sm-8"> <input name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" class="form-control" required></div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Qualification</label>
                        <div class="col-sm-8"> <input type="text" name="qualification" class="form-control" placeholder="optional"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Speciality <span class="red">*</span></label>
                        <div class="col-sm-8">
                          <select name="speciality" class="form-control" required>
                            <option value="" selected="selected" disabled>Select Speciality</option>
                            <option value="PRT">PRT</option>
                            <option value="TGT">TGT</option>
                            <option value="PGT">PGT</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8"> <input type="text" name="description" class="form-control" placeholder="optional"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">DOB<span class="red">*</span></label>
                        <div class="col-sm-8"> <input type="date" name="dob" max="<?= date('Y-m-d'); ?>" class="form-control" required></div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Joining Date<span class="red">*</span></label>
                        <div class="col-sm-8"> <input type="date" name="joining-date" min="<?= date('Y-m-d'); ?>" class="form-control" required></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Aadhar Card<span class="red">*</span></label>
                        <div class="col-sm-8"> <input name="aadhar" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" class="form-control" required></div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Teaching Subject<span class="red">*</span></label>
                        <div class="col-sm-8"> <input type="text" name="subject" class="form-control" required></div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3"> <label for="inputPassword" class="col-sm-2 col-form-label">Address<span class="red">*</span></label>
                    <div class="col-sm-10"><textarea class="form-control" name="address" style="height: 100px" data-gramm="false" wt-ignore-input="true" placeholder="optional"></textarea></div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" name="submit"> Add Teacher</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="cardx">
          <div class="card-bodyx">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title">All Teachers List</h5>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 text-right ">
                    <a href="exportteacher.php" class="btn btn-success mt-3"><span><i class="bi bi-save2-fill"></i></span> Export Result</a>
                  </div>
                </div>

                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                  <table class="table table-hover" id="myTable">
                    <thead>
                      <tr>
                        <th scope="col">Sr. No.</th>
                      
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Speciality</th>
                        <th scope="col">Joining</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      
                        $resultQuery = "SELECT * FROM teacher WHERE school_id = '$scid' ORDER BY id DESC";
                        $response = mysqli_query($conn, $resultQuery);
                   
                      $count = 1;
                      if (mysqli_num_rows($response) > 0) {
                        while ($data = mysqli_fetch_assoc($response)) {
                      ?>
                          <tr>
                            <td><?php echo $count++; ?></td>
                         
                            <td><?php echo $data['fullname']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['speciality']; ?></td>
                            <td><?php $date = $data['joining_date'];
                                $dt = new DateTime($date);
                                echo $dt->format('Y-m-d');
                                $interval = $dt->diff(new DateTime()); ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td>
                              <!-- <button type="button" class="btn btn-success editbtn" title="Edit teacher"><i class="bi bi-pen"></i></button> -->
                              <a href="updateteacher.php?id=<?php echo $data['id']; ?>" class="btn btn-success" title="Edit teacher"><i class="bi bi-pen"></i></a>
                              <a href="teacherdelete.php?id=<?php echo $data['id']; ?>" onclick="return checkdelete()" title="Delete teacher" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                          </tr>

                      <?php
                        }
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include '../includes/editteacher.php'; ?>
<?php include 'footer.php'; ?>