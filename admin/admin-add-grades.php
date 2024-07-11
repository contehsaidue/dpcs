<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>


  <style type="text/css">
  #img_profile{
    width: 100%;
    height:auto;
  }
    #img_profile >  a > img {
    width: 100%;
    height:auto;
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
<button type="button" class="btn btn-dark btn-sm mt-4 fw-bold"> <i class="fas fa-th-list"></i> Add Grades </button>
</a>
</div>
</div>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>

      <div class="row">
    <div class="col-md-4">
    <img class="img-profile-student"  title="<?php echo $row['id'];?>" src="../assets/<?php echo $row['photo'];?>">
    </div>
    <div class="col-md-8">
<table class="table table-bordered table-condensed table-responsive" style="font-size:14px" cellspacing="0">
<tbody class="text-center fw-bold">
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
      WHERE tblgrades.student_ID = '$id'";  
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
  <a href="../includes/action.php?deletegrade=<?php echo $row['grade_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this grade?')";
    title="Delete"><i class="fas fa-trash"></i></a>
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
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modaladdgrade">
  <i class="fas fa-th-list"></i> Add Grade</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>

 

 </main>

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

<?php require 'admin-dashboard-footer.php';?>
 