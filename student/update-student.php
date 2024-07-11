<?php
  include 'includes/login-inc.php'; 
        
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Admin Dashboard  · Department of Physics & Comp Sci</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--custom css-->
<link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand" href="#top">
<span class="dp-brand">Department Of</span><br> <span class="dp-brand-1">Physics & Computer Science</span></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="textarea" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="includes/logout.php">Sign out</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active text-secondary" aria-current="page" href="admin-dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-student.php">
              <span data-feather="file"></span>
              Add Student
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-course.php">
              <span data-feather="shopping-cart"></span>
              Add Course
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-learning-material.php">
              <span data-feather="users"></span>
             Add Learning Material
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Update Records
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
          <span>Progress report</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Semester 1
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Semester 2
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Progress Report
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
      <!-- Admin: Update Student Record Section --->
      <form action="includes/register-inc.php" method="post" enctype="multipart/form-data">
     
    <h1 class="h3 mb-3 fw-normal">Update Student Record</h1>
    <div class="row"> <!-- row starts -->
    <div class="col-md-6"> <!-- column 1 starts -->
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name10892">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="studentyr" placeholder="Level">
      <label for="floatingInput">Level</label>
    </div> 
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="phone" placeholder="Phone Number">
      <label for="floatingInput">Phone Number</label>
    </div>
    </div> <!-- column 1 ends -->
    <div class="col-md-6"> <!-- column 2 starts -->
   
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="file" class="form-control" id="floatingPassword" name="photo" placeholder="Photo">
      <label for="floatingPassword">Photo</label>
    </div>
    </div> <!-- column 2 ends -->
</div> <!--row ends --->
<div>
    <button class="btn btn-md btn-primary mt-4" type="submit" name="submit">Update Student Record</button>
    </div>
  </form>
   
</main>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.3.0.min.js"></script>
<script src="js/dashboard.js"></script>
     
  </body>
</html>
