<?php
  session_start();
  if (!isset($_SESSION['id'])) {
      header("Location: ../login.php");
  }
?>
<?php include 'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Fee Collection</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Master</li>
          <li class="breadcrumb-item active">Fee Collection</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fee Collection</h5>

              <!-- General Form Elements -->
              <form>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="row mb-3">
                      <div class="col-sm-12">
                        <select class="form-select" aria-label="Default select example">
                          <option selected="">Select class</option>
                          <option value="1">Pre-Nursery</option>
                          <option value="2">Nursery</option>
                          <option value="3">LKG</option>
                          <option value="3">UKG</option>
                          <option value="1st Standard">1st Standard</option>
                          <option value="2nd Standard">2nd Standard</option>
                          <option value="3rd Standard">3rd Standard</option>
                          <option value="4th Standard">4th Standard</option>
                          <option value="5th Standard">5th Standard</option>
                          <option value="6th Standard">6th Standard</option>
                          <option value="7th Standard">7th Standard</option>
                          <option value="8th Standard">8th Standard</option>
                          <option value="9th Standard">9th Standard</option>
                          <option value="10th Standard">10th Standard</option>
                          <option value="11th Standard">11th Standard</option>
                          <option value="12th Standard">12th Standard</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="row mb-3">
                      <div class="col-sm-12">
                        <select class="form-select" aria-label="Default select example">
                          <option selected="">Section</option>
                          <option value="1">A</option>
                          <option value="2">B</option>
                          <option value="3">C</option>
                          <option value="3">D</option>

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Search By
                        Keyword</label>
                      <div class="col-sm-9"> <input type="text" class="form-control"
                          placeholder="Search By Student Name, Roll Number, Serial No,  Etc."></div>
                    </div>
                  </div>
                  <div class="col-sm-2 ">
                    <button type="submit" class="btn btn-primary"><i
                        class="bi bi-search"></i>&nbsp;&nbsp;Search</button>
                  </div>
                </div>


              </form><!-- End General Form Elements -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"> <h5 class="card-title">Student List</h5></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-right ">
                  
                </div>
               
              </div>
             
             <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
              <table class="table table-hover" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Class</th>
                    <th scope="col">Section</th>
                    <th scope="col">Admission No</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">Action</th>                 
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nursery</td>
                    <td>B</td>
                    <td>445638</td>
                    <td>Preet</td>
                    <td>Ankit</td>
                    <td>20-12-2015</td>
                    <td>98925-82359</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Nursery</td>
                    <td>B</td>
                    <td>445638</td>
                    <td>Preet</td>
                    <td>Ankit</td>
                    <td>20-12-2015</td>
                    <td>98925-82359</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Nursery</td>
                    <td>B</td>
                    <td>445638</td>
                    <td>Preet</td>
                    <td>Ankit</td>
                    <td>20-12-2015</td>
                    <td>98925-82359</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Nursery</td>
                    <td>B</td>
                    <td>445638</td>
                    <td>Preet</td>
                    <td>Ankit</td>
                    <td>20-12-2015</td>
                    <td>98925-82359</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Nursery</td>
                    <td>B</td>
                    <td>445638</td>
                    <td>Preet</td>
                    <td>Ankit</td>
                    <td>20-12-2015</td>
                    <td>98925-82359</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                  </tr>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>


      </div>


    </section>

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>