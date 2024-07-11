
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="bg-success account-section py-2 mt-3">
        <img src="../assets/<?php echo $_SESSION['photo']; ?>" alt="<?php echo $_SESSION['firstname']; ?>" width="32" height="32" class="rounded-circle me-2 ml-2">
        <strong class="h2-profile"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
           </strong>
           <small class="fst-italic">tutor</small>
      </div> 
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="../tutor/faculty-dashboard.php">
              <i class="fa fa-tachometer-alt" arai-hidden="true"></i>  Dashboard
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-view-student.php">
              <i class="fas fa-users"></i> My Students
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-add-program.php">
              <i class="fas fa-university"></i> Programs
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-add-course.php">
              <i class="fas fa-th-list"></i> Courses
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-timetable.php">
              <i class="fas fa-calendar-check"></i> Set Timetable
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-attendance.php">
              <i class="fas fa-marker"></i> Attendance
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-attendance-report.php">
              <i class="fas fa-question"></i> Attendance Report
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="faculty-add-material.php">
              <i class="fas fa-file"></i> E - Library
            </a>
          </li>
    </ul>

        <h6 class="sidebar-heading d-flex justify-content-between fw-bold align-items-center text-success px-3 mt-4 mb-1">
          <span><i class="fa fa-plus-circle"></i> ADD GRADES</span>
        </h6>
        <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link"  href="faculty-add-grades.php">
              <i class="fas fa-users text-primary"></i> Student Grades
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link"  href="#">
              <i class="fas fa-print text-primary"></i> Print Grade Sheet
            </a>
          </li>
        </ul>
      </div>
    </nav>