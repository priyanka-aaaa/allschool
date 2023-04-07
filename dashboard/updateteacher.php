<?php include 'teachercode.php'; ?>
<?php include 'header.php'; ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Update Teacher</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Update Teacher</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="cardx">
                    <div class="card-bodyx">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Update Teacher</h5>
                                <?php
                                if (isset($_GET['id'])) {
                                    $updateId = $_GET['id'];
                                    $thisquery = "SELECT * FROM teacher WHERE id = '$updateId'";
                                    $thisresult = mysqli_query($conn, $thisquery);
                                    if (mysqli_num_rows($thisresult) > 0) {
                                        while ($value = mysqli_fetch_assoc($thisresult)) {
                                ?>
                                            <form method="post" action="">
                                                <input type="hidden" name="valueid" value="<?php echo $value['id']; ?>" />
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Full Name <span class="red">*</span></label>
                                                            <div class="col-sm-8"> <input type="text" name="full-name" class="form-control" value="<?php echo $value['fullname']; ?>"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8"> <input type="email" name="email" class="form-control" value="<?php echo $value['email']; ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Phone Number <span class="red">*</span></label>
                                                            <div class="col-sm-8"> <input name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" class="form-control" value="<?php echo $value['phone']; ?>" required></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Qualification</label>
                                                            <div class="col-sm-8"> <input type="text" name="qualification" class="form-control" value="<?php echo $value['qualification']; ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Speciality <span class="red">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="speciality" class="form-control">
                                                                    <option value="" selected="selected" disabled>Select Speciality</option>
                                                                    <option value="PRT" <?php echo ($value['speciality'] == 'PRT' ? 'selected' : '') ?>>PRT</option>
                                                                    <option value="TGT" <?php echo ($value['speciality'] == 'TGT' ? 'selected' : '') ?>>TGT</option>
                                                                    <option value="PGT" <?php echo ($value['speciality'] == 'PGT' ? 'selected' : '') ?>>PGT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Description</label>
                                                            <div class="col-sm-8"> <input type="text" name="description" class="form-control" value="<?php echo $value['description']; ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">DOB<span class="red">*</span></label>
                                                            <div class="col-sm-8"> <input type="date" name="dob" class="form-control" value="<?php echo $value['dob']; ?>" max="<?= date('Y-m-d'); ?>" required></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Joining Date</label>
                                                            <div class="col-sm-8"> <input type="date" name="joining-date" class="form-control" value="<?php $date = $value['joining_date'];
                                                                                                                                                                                                                    $dt = new DateTime($date);
                                                                                                                                                                                                                    echo $dt->format('Y-m-d');
                                                                                                                                                                                                                    $interval = $dt->diff(new DateTime()); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Aadhar Card<span class="red">*</span></label>
                                                            <div class="col-sm-8"> <input name="aadhar" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" class="form-control" value="<?php echo $value['aadhar']; ?>" required></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Teaching Subject<span class="red">*</span></label>
                                                            <div class="col-sm-8"> <input type="text" name="subject" class="form-control" value="<?php echo $value['subject']; ?>" required></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3"> <label for="inputPassword" class="col-sm-2 col-form-label">Address<span class="red">*</span></label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="address" style="height: 100px" data-gramm="false" wt-ignore-input="true" value="<?php echo $value['address']; ?>"></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary" name="submit"> Update Teacher</button>
                                                        <a href="teacher.php" class="btn btn-info">Teacher List</a>
                                                    </div>
                                                </div>
                                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
                                        }
                                    }
                                } ?>
<?php include 'footer.php'; ?>