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
            <!-- Feedback Message -->
            <?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong>Tutor <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?> </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Tutor <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2">My Courses <span class="btn btn-dark btn-sm fst-italic fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-plus-circle"></i> Add Course Load</span></h6> 
    <div class="row row-cols-1  align-items-stretch g-4 py-5">

<!--Student View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<tr class="text-center">
            <th scope="col">#</th>
            <th scope="col" class="d-none d-md-block d-lg-block">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col" class="d-none d-md-block d-lg-block">Credit Hour</th>
            <th scope="col" >Semester</th>
            <th scope="col">Level</th>
            <th scope="col">Program</th>
            <th scope="col">Action</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 

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
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['tut_courseID'];?></td>
            <td class="d-none d-md-block d-lg-block"><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td class="d-none d-md-block d-lg-block"><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['semester_Name'];?></td>
            <td><?php echo $row['level_Name'];?></td>
            <td><?php echo $row['program_Name'];?></td>
            <td>
            <div class="btn-group py-2">
  <a href="controller.php?facultydeletecourse=<?php echo $row['tut_courseID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this course?')";
    title="Delete"><i class="fas fa-trash"></i> </a>
</div>
</td>
          </tr>
        
    
     <?php } 
     
        }
        ?>

</table>
</div>
</div>

<!---Modals Section Starts----->

 
 <!---ADD COURSE MODAL-------->
 <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add Course Load <i class="fas fa-plus-circle"></i> - <small class="text-success">select from available courses</small></h4>
</div>
<form action="controller.php" method="POST">
<div class="modal-body">
    <!-- Admin: Add Course Section --->
    <div class="row"> <!-- row starts -->
    <div class="col-md-6"> <!-- column 1 starts -->
    <div class="form-group mb-3">
    <select name="coursename" class="form-select" required>
     <option selected>Course Name</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblcourses";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['Course_ID'];?>"><?php echo $row['course_name'];?></option>
     <?php } 
     
        }
        ?>
     </select>
     </div>
     </div>
     <div class="col-md-6"> <!-- column 1 starts -->
    <div class="form-group mb-3">
    <select name="program" class="form-select" required>
     <option selected>Program</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblprograms";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['prog_ID'];?>"><?php echo $row['program_Name'];?></option>
     <?php } 
     
        }
        ?>
     </select>
     </div>
     </div>
     </div>
     <div class="row">
     <div class="col-md-6 mb-3">
     <div class="form-group">
     <select name="level" class="form-select" required>
     <option selected>Level</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tbllevel";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['level_ID'];?>"><?php echo $row['level_Name'];?></option>
     <?php } 
     
        }
        ?>
        </select>
     </div>
     </div>
     <div class="col-md-6 mb-3">
     <div class="form-group">
     <select name="semester" class="form-select" required>
     <option selected>Semester</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblsemester";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['sem_ID'];?>"><?php echo $row['semester_Name'];?></option>
     <?php } 
     
        }
        ?>
        </select>
     </div>
     </div>
  </div>
<div class="row">
<div class="col-md-12">
     <div class="form-group mb-3">
     <?php 
     
     include '../includes/connection.php';
     $tut_id = $_SESSION['id']; 
     $sql ="SELECT * FROM tbltutor WHERE id = '$tut_id'";
     $result = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($result); ?>
    <input type="hidden" name="tutor" class="form-select" value="<?php echo $row['id'];?>" required>
     </div>
     </div>  
</div> <!--row ends --->  

<div class="modal-footer">
<div class="text-center">
    <button class="btn btn-sm fw-bold btn-dark mt-4" type="submit" name="modalfacultyaddcourse"><i class="fas fa-plus-circle"></i> Add Load</button>
    <button type="button" class="close btn btn-sm fw-bold btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>


<!---- Modals Section Ends-------->
</main>


<?php require 'faculty-dashboard-footer.php';?>

