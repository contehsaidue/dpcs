<?php
 require 'faculty-dashboard-header.php';
 require 'faculty-dashboard-sidebar.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Course area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
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
    <div class="row p-4 pb-0 pe-lg-2 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
    <div class="row row-cols-1  align-items-stretch g-4 py-3">
       <!-- Dashboard Main --->
       <form class="form-inline" role="form" method="POST">
 <div class="row">
    <div class="col-md-4">
    <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
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
        </div>
    <div class="col-md-4">
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
      </div>
        <div class="col-md-4">
        <button class="btn btn-dark btn-sm fst-italic fw-bold" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>
 <h6 class="display-6 fw-bold lh-2">Students' Attendance List </h6> 
<!--Student View Section-->
<div class="row">
<div class="col-md-12">

<form action="controller.php" method="POST">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead class="py-5 bg-dark text-white">
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Student ID</th>
        <th>Course</th>
        <th>Program</th>
        <th>Level</th>
        <th>Status</th>
</tr>
</thead>
<tbody class="text-center fw-bold">

<tr class="py-2">
<!---Retrieving Students from DB--->
<?php 
require '../includes/connection.php';


if (isset($_POST['submit']))
{
  $program = $_POST['program'];
  $level = $_POST['level'];
  $id =  $_SESSION['id'];

// selection all students from database matching credentials
$sql = "SELECT * FROM tblstudentcourses 
JOIN tblstudents ON tblstudents.id = tblstudentcourses.student_ID
JOIN tblprograms ON tblprograms.prog_ID = tblstudentcourses.prog_ID
JOIN tbllevel ON tbllevel.level_ID = tblstudentcourses.level_ID
JOIN tblcourses ON tblcourses.course_ID = tblstudentcourses.course_ID
WHERE tblstudentcourses.prog_ID = '$program' AND tblstudentcourses.level_ID = '$level' AND tblstudentcourses.tut_ID = '$id'";

$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){  
   ?>
<td><?php echo $row['id'];?>
<input type="hidden" name="student_id[]" value="<?php echo $row['student_ID']; ?>"> 
</td>
<td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['studentid'];?>"/></td>
<td><?php echo $row['studentid'];?></td>
<td><?php echo $row['course_name'];?>
<input type="hidden" name="Course_ID" value="<?php echo $row['course_ID']; ?>">
</td>
<td><?php echo $row['program_Name'];?>
<input type="hidden" name="prog_ID" value="<?php echo $row['prog_ID']; ?>"></td>
<td><?php echo $row['level_Name'];?></td>
<td>
<i class="fas fa-check-circle text-success"></i> Present <input type="checkbox" class="me-2 mt-2" value="Present" name="attendancemarker">
<i class="fas fa-times-circle text-danger"></i> Absent  <input type="checkbox" class="me-2 mt-2" value="Absent" name="attendancemarker">
</td>
</tr>
<?php } 
     
 }
    }else {
      $id =  $_SESSION['id'];
      // selecting all students from database matching credentials
      $sql = "SELECT * FROM tblstudentcourses 
      JOIN tblstudents ON tblstudents.id = tblstudentcourses.student_ID
      JOIN tblprograms ON tblprograms.prog_ID = tblstudentcourses.prog_ID
      JOIN tbllevel ON tbllevel.level_ID = tblstudentcourses.level_ID
      JOIN tblcourses ON tblcourses.course_ID = tblstudentcourses.course_ID
      WHERE  tblstudentcourses.tut_ID = '$id'";
      
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
      if ($rowCount > 0){
       while ($row = mysqli_fetch_assoc($result)){  
         ?>
      <td><?php echo $row['id'];?>
      <input type="hidden" name="student_id[] " value="<?php echo $row['student_ID']; ?>"> 
      </td>
      <td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['studentid'];?>"/></td>
      <td><?php echo $row['studentid'];?></td>
      <td><?php echo $row['course_name'];?>
      <input type="hidden" name="Course_ID" value="<?php echo $row['course_ID']; ?>">
      </td>
      <td><?php echo $row['program_Name'];?>
      <input type="hidden" name="prog_ID" value="<?php echo $row['prog_ID']; ?>"></td>
      <td><?php echo $row['level_Name'];?></td>
      <td>
      <i class="fas fa-check-circle text-success"></i> Present <input type="checkbox" class="me-2 mt-2" value="Present" name="attendancemarker[]">
      <i class="fas fa-times-circle text-danger"></i> Absent  <input type="checkbox" class="me-2 mt-2" value="Absent" name="attendancemarker[]">
      </td>
</tr>
<?php } 
}  
 }
 ?>

</tbody>

</table>
<?php
require '../includes/connection.php';

// selection all tutor records from database
      $tut_id = $_SESSION['id'];  
      $sql = "SELECT * FROM tbltutor WHERE id = '$tut_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
?>
<input type="hidden" name="tut_id" value="<?php echo $row['id']; ?>">
<button class="btn btn-sm btn-success fw-bold" name="markattendance">Mark Attendance <i class="fas fa-marker"></i></button>
 </form>
</div>
</div>
     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->
  
</main>
<?php include 'faculty-dashboard-footer.php';?>