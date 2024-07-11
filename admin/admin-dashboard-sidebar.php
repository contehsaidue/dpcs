 
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar collapse">
    <div class="bg-success account-section py-2 mt-3">
        <img src="../assets/images/2.jpg" alt="<?php echo $_SESSION['firstname']; ?>" width="32" height="32" class="rounded-circle me-2 ml-2">
        <strong class="h2-profile"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
           </strong>
           <small class="fst-italic">admin</small>
      </div> 
   <div class="position-sticky pt-3 text-white">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin-dashboard.php">
              <span data-feather="home"></span>
              <i class="fa fa-tachometer-alt text-success" arai-hidden="true"></i>  Dashboard
            </a>
          </li>
          <li class="nav-item text-white">
            <a class="nav-link"  href="admin-add-faculty.php">
            <i class="fa fa-user text-success"></i>
              Lecturers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="admin-add-student.php">
              <i class="fa fa-users text-success"></i> Students
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="admin-add-program.php">
              <i class="fa fa-book text-success"></i> Programs
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="admin-add-course.php">
              <i class="fas fa-th-list text-success"></i> Courses
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="admin-add-material.php">
              <i class="fas fa-scroll text-success"></i> E - Library
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="admin-add-news.php">
              <i class="fas fa-envelope text-success"></i> Post News
            </a>
          </li>

 <li class="nav-item">
            <a class="nav-link" href="javascript:;" class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#utility">
            <i class="fas fa-tools text-success"></i> Utility <i class="fa fa-fw fa-caret-down"></i></a>
       <ul id="utility" class="collapse list-unstyled">
            <li>
            <a href="admin-add-quote.php" class="nav-link"><i class="fas fa-plus-circle text-primary"></i> HOD Message</a>
            </li>
            <li>
            <a href="#" class="nav-link"><i class="fas fa-image text-primary"></i> Slider Images</a>
            </li>
                          
                </ul>
                </li>
                </li>
                    </ul>

        <h6 class="sidebar-heading d-flex fst-italics justify-content-between align-items-center px-3 mt-4 mb-1 bg-success py-3">
          <span class="text-uppercase"><i class="fa fa-users"></i> Student Grades Panel</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
          <a class="nav-link" href="javascript:;" class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#addstudentgrades">
            <i class="fas fa-plus-circle text-success"></i> Add Student Grades <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="addstudentgrades" class="collapse list-unstyled">
            <li>
            <a class="nav-link" href="admin-add-firstgrades.php">
              <i class="fa fa-check-square text-primary" aria-hidden="true"></i> First Semester Grades
            </a>
          </li>
          <li>
            <a class="nav-link" href="admin-add-secondgrades.php">
              <i class="fa fa-check-square text-primary" aria-hidden="true"></i> Second Semester Grades
            </a>
          </li>
          </ul>
          </li>
          <div class="divider"></div>
          <li class="nav-item">
            <a class="nav-link" href="admin-add-cummulative.php">
              <i class="fa fa-print text-danger"></i> Print Progress Report
            </a>
          </li>
        </ul>
      </div>
    </nav>