<?php session_start ();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Faculty Dashboard  · Department of Physics & Comp Sci</title>

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<!--custom css-->
<link href="../assets/css/dashboard.css" rel="stylesheet">
 <!-- Font Awesome icons (free version)-->
 <script src="../assets/js/all.js"></script>
<style>
.account-section{
  padding:.8rem;
  color:#fff;
}
</style>
  </head>
  <body>
   
  <header class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand py-3" href="#top">
<span class="fw-bold text-success">       
 <img src="../assets/images/nulogo.jpeg" alt="logo" width="35" height="32" class="rounded-circle me-2">Department Of</span> <span class="dp-brand-1">Physics & Computer Science</span></a>
  <button class="navbar-toggler position-absolute d-md-none mt-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="input-group">
    <input type="text" class="form-control rounded fst-italic d-md-block d-none" name="search" placeholder="Search...">
    <button class="btn btn-success btn-md d-md-block d-none" type="submit"><i class="fa fa-search"></i>
                            </button>
                            </div>
                            <div class="dropdown account-section">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong class="h2-profile"> - My Account
           </strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
      <div class="bg-success account-section py-2 mt-3">
        <img src="../assets/<?php echo $_SESSION['photo']; ?>" alt="<?php echo $_SESSION['firstname']; ?>" width="32" height="32" class="rounded-circle me-2 ml-2">
           <small class="fst-italic">tutor</small>
      </div>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="faculty-profile.php">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item"  href="../logout.php" onclick="return confirm('Do you want to log out?')";>Log out</a></li>
      </ul>
    </div>
  </div>

</div>
</header>