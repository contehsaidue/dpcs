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
<div class="my-5">
<?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }     
                ?>
    <div class="row p-4 pb-0 pe-lg-1 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
   <h6 class="display-6 fw-bold lh-2"><i class="fas fa-users"></i> Students' Grades </h6> 
    <div class="row row-cols-1  align-items-stretch g-4 py-3">
       
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
        <button class="btn btn-dark btn-sm fst-italic" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>

<!--Student View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead class="py-5 bg-dark text-white">
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Program</th>
        <th>Level</th>
        <th>Action</th>
</tr>
</thead>
<tbody class="text-center">

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
<td><?php echo $row['id'];?></td>
<td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['studentid'];?>"/></td>
<td><?php echo $row['studentid'];?></td>
<td><?php echo $row['firstname'];?></td>
<td><?php echo $row['lastname'];?></td>
<td><?php echo $row['program_Name'];?></td>
<td><?php echo $row['level_Name'];?></td>
<td>
<div class="btn-group py-2 fst-italic">
<a data-bs-toggle="modal" data-bs-target="#Modal1">
<button type="button" class="btn btn-success btn-sm fw-bold"> <i class="fas fa-plus-circle"></i> Add Grades </button>
</a>
<a href="admin-add-grades.php?viewstudentgrades=<?php echo $row['id'];?>&viewresult=<?php echo $row['studentid'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm fw-bold" title="View"><i class="fas fa-eye"></i> View Grades  </a>
</div>
</td>
</tr>
<?php } 
     
 }
    }else {
      $id =  $_SESSION['id'];
      // selection all students from database matching credentials
      $sql = "SELECT * FROM tblstudentcourses 
      JOIN tblstudents ON tblstudents.id = tblstudentcourses.student_ID
      JOIN tblprograms ON tblprograms.prog_ID = tblstudentcourses.prog_ID
      JOIN tbllevel ON tbllevel.level_ID = tblstudentcourses.level_ID
      JOIN tblcourses ON tblcourses.course_ID = tblstudentcourses.course_ID
      WHERE  tblstudentcourses.tut_ID = '$id'";
     $result = mysqli_query($conn, $sql);
     $rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
while ($row = mysqli_fetch_assoc($result)){ ?>
 
    <td><?php echo $row['id'];?></td>
    <td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['studentid'];?>"/></td>
<td><?php echo $row['studentid'];?></td>
<td><?php echo $row['firstname'];?></td>
<td><?php echo $row['lastname'];?></td>
<td><?php echo $row['program_Name'];?></td>
<td><?php echo $row['level_Name'];?></td>
<td>
<div class="btn-group py-2 fst-italic">
<a data-bs-toggle="modal" data-bs-target="#Modal1">
<button type="button" class="btn btn-success btn-sm fw-bold"> <i class="fas fa-plus-circle"></i> Add Grades </button>
</a>
<a href="faculty-view-student-grades.php?viewstudentgrades=<?php echo $row['id'];?>&viewresult=<?php echo $row['studentid'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm fw-bold" title="View"><i class="fas fa-eye"></i> View Grades  </a>
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
     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->
 

</main>
<?php require 'faculty-dashboard-footer.php';?>
       