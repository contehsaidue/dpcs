<?php
 require 'faculty-dashboard-header.php';
 require 'faculty-dashboard-sidebar.php';
 ?>

  <style type="text/css">
  #img_profile{
    width: 100%;
    height:20rem;
  }
    #img_profile >  a > img {
    width: 100%;
    height:20rem;
}
  </style>
        <?php
      include '../includes/connection.php';

      if(isset($_GET['viewstudentgrades'])){
        $id = $_GET['viewstudentgrades'];
        
        $sql ="SELECT * FROM tblstudents 
        JOIN tblprograms ON tblprograms.prog_ID = tblstudents.program
        JOIN tbllevel ON tbllevel.level_ID = tblstudents.level 
         WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0){
        while ($row = mysqli_fetch_assoc($result)){ 
     
 ?>
  	  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <div class="row">
    <div class="col-md-8">
    <h3 class="page-header fst-italic">
    <img title="profile image" class="img-profile-2" src="../assets/<?php echo $row['photo'];?>">
    <?php echo $row['firstname']." ".$row['lastname'];?> - Semester Grades </h3> 
</div>
<div class="col-md-4">
<a data-bs-toggle="modal" data-bs-target="#Modal1">
<button type="button" class="btn btn-dark btn-sm fw-bold"> <i class="fas fa-users"></i> Add Grades </button>
</a>
</div>
</div>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
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
      <div class="row">
    <div class="col-md-4">
    <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="background-color:#025eb1;color:#fff;padding:8px;">
              <b><?php echo $row['studentid']; ?></b> 
      </div>
      <img id="img_profile"  title="<?php echo $row['studentid'];?>" src="../assets/<?php echo $row['photo'];?>">
         </div>
        </div>
    </div>
    <div class="col-md-8">
    <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="color:#fff;padding:8px;">
              <b><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname']; ?></b> 
              - <span class="fst-italic">Personal Records</span>
      </div>
<table class="table table-striped table-bordered table-hover table-success table-responsive" style="font-size:14px" cellspacing="0">
<tbody class="text-center">
<tr class="py-2">
<td>Student ID </td>
<td><?php echo $row['studentid'];?></td>
</tr>
<tr>
<td>Student Name </td>
<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname'];?></td>
</tr>
<tr>
<td>Program</td>
<td><?php echo $row['program_Name'];?></td>
</tr>
<tr>
<td>Level</td>
<td><?php echo $row['level_Name'];?></td>
</tr>
</tbody>
</table>


        </div>
        <?php } 
        }
     
 }?>
</div>
</div>
<div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
<!--Student View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead>
<tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Credit Hour</th>
            <th scope="col">Semester</th>
            <th scope="col">Grade Earned</th>
            <th scope="col">Action</th>
    </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 

  if(isset($_GET['viewresult'])){
    $id = $_GET['viewresult'];
 // query to retrieve courses from system database
    $tut_id = $_SESSION['id'];

      $sql = "SELECT *, CASE
      WHEN score >= 75 then 'A' 
      WHEN score >= 65 then 'B' 
      WHEN score >= 50 then 'C' 
      WHEN score >= 40 then 'D' 
      WHEN score >= 30 then 'E' 
      ELSE 'F' END AS Remarks FROM tblgrades 
      JOIN tblprograms ON tblprograms.prog_ID = tblgrades.prog_ID
      JOIN tblcourses ON tblcourses.Course_ID = tblgrades.course_ID
      JOIN tblsemester ON tblsemester.sem_ID = tblgrades.sem_ID
      JOIN tbllevel ON tbllevel.level_ID = tblgrades.level_ID
      WHERE tblgrades.student_ID = '$id' AND tblgrades.tut_ID = '$tut_id'";  
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['grade_ID'];?></td>
            <td><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['semester_Name'];?></td>
            <td><?php echo $row['Remarks'];?></td>
            <td>
  <div class="btn-group py-2">
  <a href="controller.php?facultydeletegrade=<?php echo $row['grade_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this grade?')";
    title="Delete"><i class="fas fa-trash fw-bold"></i> Remove</a>
</div>
</td>
          </tr>
        
    
     <?php } 
          }
     }
        ?>
</tbody>
</table>
</div>
</div>
   
 </main>

<?php require 'faculty-dashboard-footer.php';?>
 
 
<!---Modals Section Starts----->

   <!---ADD  STUDENT GRADE MODAL-------->
   <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add Grades</h4>
</div>
    <!-- Admin: Add Student Section --->
<form action="controller.php" method="POST">
<div class="modal-body">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
    <select name="coursename" class="form-select" required>
     <option selected>Course Name</option>
     <?php 
     
     include '../includes/connection.php';
     $tut_id = $_SESSION['id'];
     $sql ="SELECT * FROM tbltutorcourses 
     JOIN tblcourses ON tbltutorcourses.course_ID = tblcourses.Course_ID 
     WHERE tbltutorcourses.tut_ID = '$tut_id'";
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
     <div class="form-group mb-3">
    <select name="program" class="form-select" required>
     <option selected>Program</option>
     <?php 
     include '../includes/connection.php';
     $tut_id = $_SESSION['id'];

     $sql ="SELECT DISTINCT prog_ID, program_Name FROM tbltutorprogram 
     JOIN tblprograms USING(prog_ID)
     JOIN tbltutor ON tbltutor.id = tbltutorprogram.tut_ID 
     WHERE tbltutorprogram.tut_ID = '$tut_id'";
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
     
     <div class="form-group mb-3">
     <select name="level" class="form-select" required>
     <option selected>Level</option>
     <?php 
     
     include '../includes/connection.php';
     $tut_id = $_SESSION['id'];
     $sql ="SELECT * FROM tbltutorprogram 
     JOIN tbllevel ON tbllevel.level_ID = tbltutorprogram.level_ID 
     JOIN tbltutor ON tbltutor.id = tbltutorprogram.tut_ID
      WHERE tbltutorprogram.tut_ID = '$tut_id'";
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
     <div class="form-group mb-3">
     <?php 
     
     include '../includes/connection.php';
     $tut_id = $_SESSION['id'];
     $sql ="SELECT * FROM tbltutor WHERE id = '$tut_id'";
     $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result) ?>
    <input type="hidden" name="tutor" class="form-select"  value="<?php echo $row['id'];?>" required>
     </div>
     </div> <!-- column 1 ends -->
     <div class="col-md-6"> <!-- column 2 starts -->
   
     <div class="form-group mb-3">
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
     <div class="form-group mb-3">
       <input type="text" class="form-control"  name="studentid" id="studentid" placeholder="Student ID" required>
     </div>
     <div class="form-group mb-3">
       <input type="number" class="form-control" name="score" placeholder="Score" required>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>
<div class="modal-footer">
<button class="btn btn-sm fw-bold btn-dark mt-4" type="submit" name="facultyaddgrade">
  <i class="fas fa-plus-circle"></i> Add Grade</button>
<button type="button" class="close btn btn-sm fw-bold btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>