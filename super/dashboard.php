<?php
  session_start();
  if (!isset($_SESSION['id']) && !isset($_SESSION['role'])) {
    header("Location: ../super/login.php");
  }
?>
<?php
include('../includes/connection.php');
if (isset($_POST["submit"])) {

    $schoolnameOld = mysqli_real_escape_string($conn, $_POST["schoolname"]);
    $schoolemail = mysqli_real_escape_string($conn, $_POST["schoolemail"]);
    $password = md5($_POST["password"]);
    $role = 'admin';
    $schoolname = ucfirst($schoolnameOld);
    $sql2 = "select * from school where email='$schoolemail'";

    $res2 = mysqli_query($conn, $sql2);
  
    if (mysqli_num_rows($res2) === 1) {
      $msg = '<div class="alert alert-danger" role="alert">
             Email is already exist!
            </div>';
          
    }
   else{
    $sql = "insert into school(name,email,password,role) values ('$schoolname','$schoolemail','$password','$role')";
   
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = '<div class="alert alert-success" role="alert">
              School added successfully!
            </div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
              Failed to add School!
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
        <h1>Add School</h1>
     
    </div>
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
                        <!-- <h5 class="card-title">Add New User</h5> -->

                        <form method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3"> 
                                        <label for="text" class="col-sm-4 col-form-label">School Name<span class="red">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="schoolname" class="form-control" placeholder="Enter school name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Email<span class="red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="email" name="schoolemail" class="form-control" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Password<span class="red">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" required name="password" placeholder="Enter password">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">User Role<span class="red">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select" aria-label="Default select example" name="role" required>
                                                <option value="">Select Role</option>
                                                <option value="superadmin">Super Admin</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save School</button>
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
                                <h5 class="card-title">All Users List</h5>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-right ">
                            </div>
                        </div>

                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">School Name</th>
                                        <th scope="col">User Email</th>
                                        <th scope="col">User Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getquery = "SELECT * FROM school where role = 'admin' ORDER BY id DESC";
                                    $res2 = mysqli_query($conn, $getquery);
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["name"]; ?></td>
                                            <td><?php echo $data["email"]; ?></td>
                                            <td><?php echo $data["role"]; ?></td>
                                            <td>
                                                <a href="deleteSchool.php?id=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delete User" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                                <a href="deleteSchool.php?id=<?php echo $data["id"]; ?>" onclick="return checkdelete()" title="Delete User" class="btn btn-danger"><i class="bi bi-eye"></i></a>
                                            
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
    </section>

</main>
<?php include 'footer.php'; ?>
