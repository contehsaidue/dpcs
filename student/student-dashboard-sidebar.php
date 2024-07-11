
<div class="container-fluid">
  <div class="row" id="sidebar-wrapper">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="bg-success account-section py-2 mt-3">
        <img src="../assets/<?php echo $_SESSION['photo'];?>" alt="<?php echo $_SESSION['firstname']; ?>" width="32" height="32" class="rounded-circle me-2 ml-2">
        <strong class="h2-profile"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
           </strong>
           <small class="fst-italic">student</small>
      </div> 
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active text-success" aria-current="page" href="student-dashboard.php">
              <i class="fas fa-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-courses.php">
              <i class="fas fa-university text-danger"></i> My Courses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-peer-review.php">
              <i class="fas fa-podcast"></i> Peer Review
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-tutor.php">
              <i class="fas fa-users"></i> My Tutors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-timetable.php">
              <i class="fas fa-calendar"></i> My Timetable
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-learning-material.php">
              <i class="fas fa-file"></i> Notes
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between fst-italic align-items-center px-3 mt-4 mb-1 text-white">
        Progress report
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="student-grades.php">
              <i class="fas fa-check"></i> Semester Grades
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-progressresult.php">
              <i class="fas fa-print text-success"></i> Progress Result
            </a>
          </li>
        </ul>
        
      </div>
    </nav>