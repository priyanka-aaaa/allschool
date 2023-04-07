<?php
  session_start();
  if (!isset($_SESSION['id'])) {
      header("Location: ../login.php");
  }
?>
<?php include 'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Expense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Master</li>
          <li class="breadcrumb-item active">Add Expense</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Expense</h5>

              <!-- General Form Elements -->
              <form>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="row mb-3"> <label class="col-sm-4 col-form-label">Expense Head</label>
                      <div class="col-sm-8"> <select class="form-select" aria-label="Default select example">
                          <option selected=""> Select </option>
                          <option value="1">Stationery Purchase</option>
                          <option value="2">Electricity Bill</option>
                          <option value="3">Telephone Bill</option>
                          <option value="4">Miscellaneous</option>
                          <option value="5">Flower</option>
                        </select></div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="row mb-3"> <label for="inputText" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9"> <input type="text" class="form-control"></div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="row mb-3"> <label for="inputDate" class="col-sm-3 col-form-label">Date</label>
                      <div class="col-sm-9"> <input type="date" class="form-control"></div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">Amount</label>
                      <div class="col-sm-9"> <input type="number" class="form-control"></div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-3 col-form-label">Invoice
                        Number</label>
                      <div class="col-sm-9"> <input type="number" class="form-control"></div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row mb-3"> <label for="inputNumber" class="col-sm-2 col-form-label">Attachment</label>
                      <div class="col-sm-10"> <input class="form-control" type="file" id="formFile"></div>
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="row mb-3"> 
                    <div class="col-sm-12"><textarea class="form-control" placeholder="Description" style="height: 100px" data-gramm="false"
                        wt-ignore-input="true"></textarea></div>
                  </div>
                </div>
                <div class="col-sm-12">
                <button type="submit" class="btn btn-primary"><span><i class="bi bi-save2-fill"></i></span> Save</button>
                </div>
              </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"> <h5 class="card-title">Expense List</h5></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-right ">
                  <div class="search-bar mt-3">
                    <form class="search-form d-flex align-items-center" method="POST" action="#">
                      <input type="text" name="query" placeholder="Search By Student Name, Roll Number, Serial No,  Etc." title="Enter search keyword">
                      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                  </div>
                </div>
               
              </div>
             
             <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Invoice Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Expense Head</th>
                    <th scope="col">Amount</th>                
                    <th scope="col">Action</th>                 
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">BSNL Broad Band Center</th>
                    <td>Broadband is high speed internet connection enabled through different mediums.</td>
                    <td>65982</td>
                    <td>31/01/2023</td>
                    <td>Telephone Bill</td>
                    <td>₹250.00	</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>                   
                  </tr>
                  <tr>
                  <th scope="row">HV Power Centre Bill House</th>
                    <td>The new billing solution is faster and more accurate than its existing systems</td>
                    <td>65582</td>
                    <td>30/01/2023</td>
                    <td>Electricity Bill	</td>
                    <td>₹1500.00</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>            
                  </tr>
                  
                  <tr>
                  <th scope="row">Stock Flower</th>
                    <td>Stock is an odd name for a flower. It seems to be a reference to the “stocky”.</td>
                    <td>546132</td>
                    <td>20/01/2023</td>
                    <td>Flower</td>
                    <td>₹150.00</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>     
                  </tr>
                  
                  <tr>
                    <th scope="row">BSNL Broad Band Center</th>
                    <td>Broadband is high speed internet connection enabled through different mediums.</td>
                    <td>65982</td>
                    <td>31/01/2023</td>
                    <td>Telephone Bill</td>
                    <td>₹250.00	</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>                   
                  </tr>
                  <tr>
                  <th scope="row">HV Power Centre Bill House</th>
                    <td>The new billing solution is faster and more accurate than its existing systems</td>
                    <td>65582</td>
                    <td>30/01/2023</td>
                    <td>Electricity Bill	</td>
                    <td>₹1500.00</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>            
                  </tr>
                  
                  <tr>
                  <th scope="row">Stock Flower</th>
                    <td>Stock is an odd name for a flower. It seems to be a reference to the “stocky”.</td>
                    <td>546132</td>
                    <td>20/01/2023</td>
                    <td>Flower</td>
                    <td>₹150.00</td>
                    <td><a href="#" title="Edit" class="btn btn-success"><i class="bi bi-pen"></i></a>
                    <a href="#" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>     
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>

        </div>

        </div>


      </div>
    </section>

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>