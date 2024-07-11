<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Dashboard Main --->
 <form class="form-inline" role="form" method="POST">
 <div class="row">
    <div class="col-md-4">
    <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
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
    <div class="col-md-4">
    <div class="form-group mb-3">
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
        <div class="col-md-4">
        <button class="btn btn-dark btn-sm fw-bold" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>

<div class="row">
    <div class="col-md-12">
    <h3 class="page-header fst-italic">Students Grades : Second Semester </h3> 
</div>

</div>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
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

// selection all students from database matching credentials
$sql = "SELECT * FROM tblstudents 
JOIN tblprograms ON tblprograms.prog_ID = tblstudents.program
JOIN tbllevel ON tbllevel.level_ID = tblstudents.level 
WHERE program = '$program' AND level = '$level' ORDER BY id DESC";

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

      $sql = "SELECT * FROM tblstudents 
      JOIN tblprograms ON tblprograms.prog_ID = tblstudents.program
      JOIN tbllevel ON tbllevel.level_ID = tblstudents.level ORDER BY id DESC";
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
<a href="admin-add-grades.php?viewstudentgrades=<?php echo $row['id'];?>&viewresult=<?php echo $row['studentid'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm fw-bold" title="View"><i class="fas fa-eye"></i> View Grades  </a>
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
<form action="../includes/action.php" method="POST">
<div class="modal-body">
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
     
     <div class="form-group mb-3">
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
     <div class="form-group mb-3">
    <select name="tutor" class="form-select" required>
    <option selected>Tutor</option>
     <?php 
     
     include '../includes/connection.php';

     $sql ="SELECT * FROM tbltutor";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['id'];?>"><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></option>
     <?php } 
     
        }
        ?>
     </select>
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
<button class="btn btn-sm btn-dark mt-4 fw-bold" type="submit" name="modaladdgrade">
  <i class="fas fa-plus-circle"></i> Add Grade</button>
<button type="button" class="close btn btn-sm btn-danger mt-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>

</main>

     
        <?php require 'admin-dashboard-footer.php';?>