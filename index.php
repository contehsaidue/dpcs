<?php
include 'includes/header.php';?>

  <div class="container mt-3">
     <!-- Feedback Message -->
<?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong>Hey there!</strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                    <strong>Hey there!</strong>  <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
    <div class="row">
    <div class="col-md-3 d-md-block d-none">
    <?php require 'includes/sidebar.php';?>
    </div>
    <div class="col-md-9">
      <div class="border rounded shadow-md bg-dark py-2">
        <h4 class="fst-italic fw-bold text-center text-light bg-success py-2">Statement from the Head of department</h4>
        <?php 
require 'includes/connection.php';

$sql = "SELECT * FROM tblstudentmessage";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){ ?>

<div class="text-center">
<img src="../<?php echo $row['hodimage'];?>" class="rounded-circle" width="190" height="180">
</div>
  <!-- Message -->
  <div class="text-center text-light">
  <p class="lead fst-italic container"><?php echo $row['hodmessage'];?></p>
  <h6 class="fw-bold bg-success py-3"> -- <?php echo $row['hodname'];?></h6>
</div>
      </div>
      <?php } 
     
    }
         ?>
</div>
</div>

<!-- Department of Physics & Computer Science starts -->
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-6 fw-bold fst-italic lh-1">Department of Physics & Computer Science</h1>
        <p class="lead">The department of Physics and Computer Science is currently running programmes in Four (4) main broad disciplines:
Physics; Renewable Energy; Computer Science; and Electronics and Telecommunication.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
          <button type="button" class="btn btn-primary btn-md px-4 me-md-2 fw-bold">Learn More</button>
          <button type="button" class="btn btn-success btn-md px-4 fw-bold">Our Students <i class="fas fa-users"></i></button>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 position-relative overflow-hidden shadow-lg">
        <div class="position-lg-absolute top-0 left-0 overflow-hidden">
          <img class="d-block rounded-lg-3" src="../assets/images/seminar.jpg" alt="" width="720">
        </div>
      </div>
    </div>
  </div>

<!-- Department of Physics & Computer Science ends -->

<!-- Department of Physics & Computer Science programs starts -->
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
<h6 class="text-center display-4 mb-3">Programs</h6>
      <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="feature bg-success text-white rounded-3 mb-3">
              <i class="fas fa-laptop"></i>
            </div>
            <h6 class="fw-bold">BSC Computer Science</h6>
                       </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3">
                          <i class="fas fa-users"></i></i>
                        </div>
                        <h6 class="fw-bold">BSC Business & Info Tech</h6>
                       </div>
                       
                    <div class="col-lg-4">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i class="fas fa-building"></i></div>
                        <h6 class="fw-bold">BSC Energy Studies</h6>
                    </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="feature bg-success text-white rounded-3 mb-3">
              <i class="fas fa-laptop"></i>
            </div>
            <h6 class="fw-bold">BSC Computer Science</h6>
                       </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3">
                          <i class="fas fa-users"></i></i>
                        </div>
                        <h6 class="fw-bold">BSC Business & Info Tech</h6>
                       </div>
                       
                    <div class="col-lg-4">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i class="fas fa-building"></i></div>
                        <h6 class="fw-bold">BSC Energy Studies</h6>
                    </div>

                </div>
            </div>

</div>
</div>

 <!-- Department of Physics & Computer Science programs ends -->

      <!-- Admissions -->
 <div class="container col-xxl-8 px-4 py-5 shadow-lg" id="admissions">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="../assets/images/PNG.png" class="d-block mx-lg-auto img-fluid" alt="Admissions" width="700" height="500">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Admission Guide</h1>
        <p class="lead">The minimum admission requirement for entry into the Department are Five Credits in not more than Two Sittings in WASSCE or GCE “O”-Level.
</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a class="btn btn-primary btn-md px-4 me-md-2 fw-bold" href="www.njala.edu.sl" target="_blank">Visit NU-Site</a>
          <a href="assets/dpcsdocs/NURequirement.pdf" class="btn btn-success btn-md px-4 fw-bold text-decoration-none" download>Download Admission Requirement <i class="fas fa-download"></i></a>
        </div>
      </div>
    </div>
  </div>


  <!-- upcoming events -->
  
  <div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom fst-italic">Upcoming <span style="color:#dc3545;">Events</span></h2>

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
      <div class="col">
        <div class="card card-cover h-70 overflow-hidden text-white bg-transparent rounded-5 shadow-lg" style="background-image: url('../assets/images/unsplash-photo-1.jpg');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Exams</h6>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-70 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('../assets/images/unsplash-photo-2.jpg');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h6 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
         NUAITS week</h6>
           
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-70 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('../assets/images/unsplash-photo-3.jpg');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
            <h5 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Alumni</h5>
          
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php';?>

