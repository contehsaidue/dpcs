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
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2">My Students </h6> 
    <div class="row row-cols-1 align-items-stretch g-4 py-3">
    
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

<!--Student View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead class="py-5 bg-dark text-white">
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Student ID</th>
        <th >First Name</th>
        <th>Last Name</th>
        <th>Program</th>
        <th>Level</th>
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
<td ><?php echo $row['firstname'];?></td>
<td><?php echo $row['lastname'];?></td>
<td><?php echo $row['program_Name'];?></td>
<td><?php echo $row['level_Name'];?></td>
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

</tr>
<?php } 
}  
 }
 ?>
</tbody>
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
<script>
  $(document).ready(function () {
    $('.editbtn').on('click', function () {
      $trow = $(this).closest('tr');

      var data = $trow.children('td').map(function () {
        return $(this).text();
      }).get();

      console.log(data);

      $('#updateid').val(data[0]);
      $('#studentid').val(data[2]);
      $('#firstname').val(data[3]);
      $('#lastname').val(data[4]);
      $('#program').val(data[5]);
      $('#level').val(data[6]);
    

 });
  

  });

</script>