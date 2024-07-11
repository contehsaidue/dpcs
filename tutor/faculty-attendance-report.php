<?php
 require 'faculty-dashboard-header.php';
 require 'faculty-dashboard-sidebar.php';
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Course area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-5">
<?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }     
                ?>
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2">Student Attendance Report</h6> 
    <div class="row row-cols-1 align-items-stretch g-4 py-5">
<div class="row">
  <div class="col-md-8">  
</div>
</div>

<!--Student View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Program</th>
            <th scope="col">Course</th>
            <th scope="col">Action</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve attendance sheet from DB--->
  <?php
  include '../includes/connection.php'; 
 // query to retrieve courses from system database
      $tut_id = $_SESSION['id'];
      $sql = "SELECT DISTINCT * FROM `tblstudentattendace` 
      JOIN tblprograms ON tblprograms.prog_ID = tblstudentattendace.programid
      JOIN tblcourses ON tblcourses.Course_ID = tblstudentattendace.courseid
       WHERE tblstudentattendace.tutid = '$tut_id'"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['attendanceid'];?></td>
            <td><?php echo $row['program_Name'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td> 
            <a href="faculty-student-attendance.php?program=<?php echo $row['prog_ID'];?>&tutid=<?php echo $row['tutid'];?>&courseid=<?php echo $row['courseid'];?>" target="_blank" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm fw-bold"><i class="fas fa-users"></i> Attendance Sheet</a></td>
            <td>
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
</div>
</div>

</div><!-- row ends -->
     
</main>

<?php require 'faculty-dashboard-footer.php';?>
