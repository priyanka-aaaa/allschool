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
if (isset($_POST['save-expense'])) {
  $schoolid  = $_SESSION['id'];
  $expense_type  = mysqli_real_escape_string($conn, $_POST['expense-type']);
  $expense = ucwords($expense_type);
  if ($expense == "") {
    $msg = '<div class="alert alert-danger" role="alert">
   Mandatory fields are required
  </div>';
  } else {
    $thequery = "INSERT INTO expense_type(school_id, expense_type) VALUES ('$schoolid', '$expense')";
    $theresult = mysqli_query($conn, $thequery);
    if ($theresult == true) {
      $msg = '<div class="alert alert-success" role="alert">
   Expense type saved successfully
  </div>';
    } else {
      $msg = '<div class="alert alert-danger" role="alert">
      Expense type could not be saved
  </div>';
    }
  }
}
$sql2 = "select * from expense_type WHERE school_id=". $_SESSION['id'];
$res2 = mysqli_query($conn, $sql2);
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
    <h1>Expense Type</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Master</li>
        <li class="breadcrumb-item active">Expense Type</li>
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
            <h5 class="card-title">Add type of expense</h5>

            <!-- General Form Elements -->
            <form method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="row mb-3">
                    <label for="text" class="col-sm-4 col-form-label">Expense Type<span class="red">*</span> </label>
                    <div class="col-sm-8">
                      <input type="text" name="expense-type" class="form-control" placeholder="Expense Type" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                  <button type="submit" name="save-expense" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save Expense</button>
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
                                <h5 class="card-title">All Expense List</h5>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Expense Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($data = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $data["expense_type"]; ?></td>
                                            <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                                                <a href="expensetypedel.php?expenseid=<?php echo $data["expense_id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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