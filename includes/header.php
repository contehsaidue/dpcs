<?php  session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Saidu E Conteh, Chasey Chase">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Department of Physics & Computer Science</title>

    <!-- Bootstrap core CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome icons (free version)-->
  <script src="../assets/js/all.js"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text">
<!--Custom Styles-->
	  <link href="../assets/css/index.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/carousel.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/features.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/headers.css" rel="stylesheet" type="text/css">
  </head>
  <body>


  <header class="p-1 bg-dark text-white fixed-top">
    <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center mb-3">
    <img src="../assets/images/nulogo.jpeg" alt="logo" width="38" height="33" class="rounded me-2">
   <h6 class="fw-bolder text-uppercase"> Njala University - Njala Campus</h6>
    </div>
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 fw-bold">
          <li><a href="#" class="nav-link px-2 text-secondary"><i class="fas fa-phone"></i> +23277028023</a></li>
          <li><a href="#" class="nav-link px-2 text-white"><i class="fas fa-envelope"></i>  Admissions@njala.edu.sl</a</li>
          <li><a href="#" class="nav-link px-2 text-white"></a></li>
          <div class="dropdown text-end">
            <button class="btn btn-success btn-sm dropdown-toggle fw-bold" type="button" id="dropdownMenuButtonSM" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-blog"></i> Login 
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSM">
              <li><h6 class="dropdown-header"> <i class="fas fa-blog"></i> Login Portal</h6></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#modaladminlogin">Admin Login</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#modalfacultylogin">Faculty Login</a></li>
            </ul>
            <button class="btn btn-light btn-sm dropdown-toggle fw-bold" type="button" id="dropdownMenuButtonSM" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-users"></i> Register
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSM">
              <li><h6 class="dropdown-header"> <i class="fas fa-users"></i> Registration Portal</h6></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#modalstudentreg">Student Registration</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-bold" data-bs-toggle="modal" data-bs-target="#modalfacultyreg">Faculty Registration</a></li>
            </ul>
          </div>
</ul> 
</div>

  </header>

<!--Main site image slider starts-->
<section class="main-section">
 <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/njala.JPG">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Njala University - Njala Campus.</h1>
            <p><a class="btn btn-lg btn-dark" href="student-register.php">Register</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/1.jpg">

        <div class="container">
          <div class="carousel-caption">
            <h1>Department of Physics & Computer Science</h1>
            <p><a class="btn btn-lg btn-dark" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/3.jpg">
 <div class="container">
          <div class="carousel-caption text-end">
            <h1>Ready to produce technocrats.</h1>
            <p><a class="btn btn-lg btn-dark" href="student-db-home.php">Student Gallery</a></p>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/nusl-njala-campus-02.jpg">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Research with us now</h1>
            <p><a class="btn btn-lg btn-primary" href="student-register.php">Academics</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/seminar.jpg">

        <div class="container">
          <div class="carousel-caption">
            <h1>Meet our faculty members</h1>
            <p><a class="btn btn-lg btn-primary" href="#">Faculty members</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="../assets/images/nu-overhead.jpeg">
 <div class="container">
          <div class="carousel-caption text-center">
            <p><a class="btn btn-lg btn-primary" href="#"><i class="fas fa-envelope"></i> Mail Admin</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </section>
<!--Main site image slider ends-->
 <!-- Navigation Menu Starts -->
 <header class="navigations">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand text-white fw-bold fst-italic" href="#top">
    <span class="dp-brand">
    <img src="../assets/images/PNG.png" alt="logo" width="38" height="33" class="rounded me-2">
    Department Of </span>Physics & Computer Science
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link live" aria-current="page" href="index.php">Home <i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#admissions">Admissions </a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="studentDB.php">Students
               <span class="badge rounded-pill bg-success"> <?php
                  require 'includes/connection.php';
                   echo $conn->query("SELECT * FROM tblstudents")->num_rows;
                    ?>
                    </span>
              </a>
          </li>
			 <li class="nav-item">
            <a class="nav-link" href="facultyDB.php">Faculty
            <span class="badge rounded-pill bg-light text-dark fw-bold"> <?php
                  require 'includes/connection.php';
                   echo $conn->query("SELECT * FROM tbltutor")->num_rows;
                    ?>
                    </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="news.php">News</a>
          </li>
       <li>
            <a class="nav-link btn btn-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#studentlogin">Student Portal <i class="fas fa-users"></i> </a>
          </li> 
        </ul>
      </div>
    </div>
  </nav>
</header>