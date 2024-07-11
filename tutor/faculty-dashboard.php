<?php
 require 'faculty-dashboard-header.php';
 require 'faculty-dashboard-sidebar.php';
?>
 
 <style type="text/css">
	.panel-body{
		min-height: 15px;
		text-align: center;
   		font-size: 20px; 
	}
</style>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom mt-3">
      </div>
            <!-- Feedback Message -->
<?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?> </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
<img class="card-image" src="../assets/<?php echo $_SESSION['photo']; ?>" alt="<?php echo $_SESSION['firstname']; ?>">
    <span class="h2 fst-italic"><?php echo $_SESSION['designation']." ".$_SESSION['firstname']; ?></span>

<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
      <h6 class="display-6 fw-bold lh-2">Dashboard </h6>
    <div class="row row-cols-1 align-items-stretch g-4 py-5">
  <div class="row">
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
    <div class="well well-sm text-center fst-italic bg-dark" style="color:#fff;padding:8px;font-weight:bold;">
			My Students
		</div>
    </div>
		<div class="panel-body fw-bold" style="color:darkblue">
    <span class="content-box-icon text-center text-dark"> <i class="fas fa-users"></i></span>
    <?php
                  require '../includes/connection.php';
                  $tut_id = $_SESSION['id'];
                   echo $conn->query(  
                   
                  // selection all students from database matching credentials
                  $sql = "SELECT * FROM tblstudentcourses 
                  JOIN tblstudents ON tblstudents.id = tblstudentcourses.student_ID
                  JOIN tblprograms ON tblprograms.prog_ID = tblstudentcourses.prog_ID
                  JOIN tbllevel ON tbllevel.level_ID = tblstudentcourses.level_ID
                  JOIN tblcourses ON tblcourses.course_ID = tblstudentcourses.course_ID
                  WHERE tblstudentcourses.tut_ID = '$tut_id'")->num_rows;
              ?>
		</div>
<div class="panel-footer py-3 bg-dark" style="color:#fff;padding:10px;font-weight:bold;"></div>
	</div>
</div>
 
<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center fst-italic bg-dark" style="color:#fff;padding:8px;font-weight:bold;">
			My Classes
		</div>
		<div class="panel-body fw-bold" style="color:darkblue">
    <span class="content-box-icon text-dark"> <i class="fas fa-university"></i></span>
    <?php 
                   require '../includes/connection.php';
                   $tut_id = $_SESSION['id'];
                   echo $conn->query(  
                   $sql ="SELECT * FROM tbltutorprogram 
                   JOIN tbllevel ON tbllevel.level_ID = tbltutorprogram.level_ID 
                   JOIN tbltutor ON tbltutor.id = tbltutorprogram.tut_ID
                    WHERE tbltutorprogram.tut_ID = '$tut_id'")->num_rows;?>
				   </div>
		<div class="panel-footer py-3 bg-dark" style="color:#fff;padding:10px;font-weight:bold;"></div>
		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center fst-italic bg-dark" style="color:#fff;padding:8px;font-weight:bold;">
			My Courses
		</div>
		<div class="panel-body fw-bold" style="color:darkblue">
    <span class="content-box-icon text-dark"> <i class="fas fa-th-list"></i></span>
    <?php 
                   require '../includes/connection.php';
                   $tut_id = $_SESSION['id'];  
                   echo $conn->query(
                    $sql = "SELECT * FROM `tbltutorcourses` 
                    JOIN tblprograms ON tblprograms.prog_ID  = tbltutorcourses.prog_ID 
                    JOIN tblcourses ON tblcourses.Course_ID = tbltutorcourses.course_ID 
                    JOIN tbllevel ON tbllevel.level_ID = tbltutorcourses.level_ID 
                    JOIN tblsemester ON tblsemester.sem_ID = tbltutorcourses.sem_ID
                    JOIN tbltutor ON tbltutor.id = tbltutorcourses.tut_ID
                    WHERE tbltutorcourses.tut_ID = '$tut_id'"
                   )->num_rows; ?>
				   </div>
		<div class="panel-footer py-3 bg-dark" style="color:#fff;padding:10px;font-weight:bold;"></div>
		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center fst-italic bg-dark" style="color:#fff;padding:8px;font-weight:bold;">
			My Materials
		</div>
		<div class="panel-body fw-bold" style="color:darkblue">
    <span class="content-box-icon text-dark"> <i class="fas fa-scroll"></i> </span>
    <?php 
                   require '../includes/connection.php';
                   $tut_id = $_SESSION['id'];  
                   echo $conn->query( $sql = "SELECT * FROM tblcoursematerial 
                   JOIN tbltutor ON tbltutor.id = tblcoursematerial.tut_ID 
                   JOIN tblprograms ON tblprograms.prog_ID = tblcoursematerial.prog_ID 
                   JOIN tbllevel ON tbllevel.level_ID = tblcoursematerial.level_ID 
                   JOIN tblsemester ON tblsemester.sem_ID = tblcoursematerial.sem_ID 
                   WHERE tblcoursematerial.tut_ID = '$tut_id'")->num_rows; ?>
				   </div>
		<div class="panel-footer py-3 bg-dark" style="color:#fff;padding:10px;font-weight:bold;"></div>
	
</div>
</div><!-- first row ends -->
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->
      
<!-- Tutor Course list starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2"> <?php echo $_SESSION['firstname']." ". $_SESSION['lastname']; ?> </h6> <span class="fst-italic fw-bold"> my course list </span>
    <div class="row row-cols-1  align-items-stretch g-4 py-5">

    <!-- Student Grades --->
    <div class="container">
         <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Credit Hour</th>
            <th scope="col">Semester</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 

 // query to retrieve courses from system database
          
    // query to retrieve courses from system database
    $tut_id = $_SESSION['id'];  
    $sql = "SELECT * FROM `tbltutorcourses` 
    JOIN tblprograms ON tblprograms.prog_ID  = tbltutorcourses.prog_ID 
    JOIN tblcourses ON tblcourses.Course_ID = tbltutorcourses.course_ID 
    JOIN tbllevel ON tbllevel.level_ID = tbltutorcourses.level_ID 
    JOIN tblsemester ON tblsemester.sem_ID = tbltutorcourses.sem_ID
    JOIN tbltutor ON tbltutor.id = tbltutorcourses.tut_ID
    WHERE tbltutorcourses.tut_ID = '$tut_id'";
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['Course_ID'];?></td>
            <td><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['semester_Name'];?></td>
          </tr>
        
    
     <?php } 
     
        }
        ?>

          </tbody>
        </table>
</div>
</div>
     
      </div>
    </div>
  </div>
</div><!-- row ends -->


<!-- My teaching timetable area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
   <h6 class="display-6 fw-bold lh-2">My teaching timetable </h6> 
    <div class="row row-cols-1 align-items-stretch g-4 py-3">
<div class="container">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<tr class="text-center">
            <th scope="col">Program</th>
            <th scope="col">Level</th>
            <th scope="col">Course</th>
            <th scope="col">Days</th>
            <th scope="col">Time</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
 <?php
  include '../includes/connection.php'; 
 // query to retrieve courses from system database
      $tut_id = $_SESSION['id'];
      $sql = "SELECT * FROM `tbltutortimetable` 
      JOIN tblprograms ON tbltutortimetable.prog_ID = tblprograms.prog_ID 
      JOIN tbllevel ON tbllevel.level_ID = tbltutortimetable.level_ID 
      JOIN tblcourses ON tblcourses.Course_ID = tbltutortimetable.Course_ID
      JOIN tbldays ON tbldays.days_ID = tbltutortimetable.days
      JOIN tbltime ON tbltime.time_ID = tbltutortimetable.time
      JOIN tbltutor ON tbltutor.id = tbltutortimetable.tut_ID
      WHERE tbltutortimetable.tut_ID = '$tut_id'"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['program_Name'];?></td>
            <td><?php echo $row['level_Name'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['days'];?></td>
            <td><?php echo $row['time'];?></td>
          </tr>
        
    
     <?php } 
     
        }
        ?>

</table>
</div>
</div>
     </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->

</main>

<?php require 'faculty-dashboard-footer.php';?>
