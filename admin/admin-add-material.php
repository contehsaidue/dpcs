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
    <div class="col-md-3">
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
     <div class="col-md-3">
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
      </div>
        <div class="col-md-2">
        <button class="btn btn-dark btn-sm" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>
      <!-- Dashboard Main --->
      <div class="row">
    <div class="col-md-8">
    <h3 class="page-header fst-italic">List of course materials </h3> 
</div>
<div class="col-md-4">
   <button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal3">
     <i class="fas fa-scroll"></i> Add New Material</button>
   </div>
   </div>
<div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
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
<!--Student Add Material view Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead>
<tr class="text-center">
        <th>#</th>
        <th>Material On</th>
        <th>Tutor</th>
        <th>Program</th>
        <th>Level</th>
        <th>Semester</th>
        <th>Action</th>
</tr>
</thead>
<tbody class="text-center">
<tr>
<!---Retrieving Students from DB--->
<?php 
require '../includes/connection.php';
if (isset($_POST['submit']))
{
  $program = $_POST['program'];
  $level = $_POST['level'];
  $semester = $_POST['semester'];

// selection all students from database
$sql = "SELECT * FROM `tblcoursematerial` 
JOIN tblprograms ON tblcoursematerial.prog_ID = tblprograms.prog_ID 
JOIN tblsemester ON tblsemester.sem_ID = tblcoursematerial.sem_ID 
JOIN tbllevel ON tbllevel.level_ID = tblcoursematerial.level_ID
JOIN tbltutor ON tbltutor.id = tblcoursematerial.tut_ID
WHERE tblcoursematerial.prog_ID = '$program' AND tblcoursematerial.level_ID = '$level' AND tblcoursematerial.sem_ID = '$semester' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){ ?>
<td><?php echo $row['mat_ID'];?></td>
<td><?php echo $row['matname'];?></td>
<td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
<td><?php echo $row['program_Name'];?></td>
<td><?php echo $row['level_Name'];?></td>
<td><?php echo $row['semester_Name'];?></td>
<td>
<div class="btn-group py-2">
<a class="text-white mr-2 text-decoration-none btn btn-dark btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal4" title="Edit"><i class="fas fa-edit"></i>  Edit</a>
  <a href="../includes/action.php?deletematerial=<?php echo $row['mat_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this material?')";
    title="Delete"><i class="fas fa-trash"></i> Remove</a>
</div>
</td>
</tr>
<?php } 
     
   }
      }else {
         $sql = "SELECT * FROM `tblcoursematerial` 
         JOIN tblprograms ON tblcoursematerial.prog_ID = tblprograms.prog_ID 
         JOIN tblsemester ON tblsemester.sem_ID = tblcoursematerial.sem_ID 
         JOIN tbllevel ON tbllevel.level_ID = tblcoursematerial.level_ID
         JOIN tbltutor ON tbltutor.id = tblcoursematerial.tut_ID";
       
         $result = mysqli_query($conn, $sql);
         $rowCount = mysqli_num_rows($result);
         if ($rowCount > 0){
          while ($row = mysqli_fetch_assoc($result)){ ?> 
      <td><?php echo $row['mat_ID'];?></td>
<td><?php echo $row['matname'];?></td>
<td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
<td><?php echo $row['program_Name'];?></td>
<td><?php echo $row['level_Name'];?></td>
<td><?php echo $row['semester_Name'];?></td>
<td>
<div class="btn-group py-2">
  <a href="../includes/action.php?deletematerial=<?php echo $row['mat_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this material?')";
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

 <!---ADD LEARNING MATERIAL MODAL-------->
 <div class="modal fade" id="Modal3">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add Learning Material</h4>
</div>
    <!-- Admin: Add Learning Material Section --->
 <form action="../includes/action.php" method="post" enctype="multipart/form-data">
 <div class="modal-body">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     
     <div class="form-group mb-3">
       <input type="text" class="form-control mb-2" id="floatingInput" name="filename" placeholder="File Name">
     </div>
     <div class="form-group mb-3">
       <input type="file" class="form-control" id="floatingPassword" name="filecontent" placeholder="filetype">
     </div>
     <div class="form-group mb-3">
    <select name="tutor" class="form-select" required>
     <option selected>Tutors</option>
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
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
   
</div>

<div class="modal-footer">
<div class="text-center">
     <button class="btn btn-sm btn-dark mt-4" type="submit" name="modaladdmaterial"> <i class="fas fa-scroll"></i> Add Material</button>
     <button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Close</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>
<!---- Modals Section Ends-------->

</main>
<?php require 'admin-dashboard-footer.php';?>
<script>
  $(document).ready(function () {
    $('.editbtn').on('click', function () {
      $trow = $(this).closest('tr');

      var data = $trow.children('td').map(function () {
        return $(this).text();
      }).get();

      console.log(data);

      $('#updateid').val(data[0]);
      $('#filename').val(data[2]);
      $('#filecontent').val(data[3]
      $('#tutor').val(data[4]);
      $('#program').val(data[5]);
      $('#level').val(data[6]);
      $('#semester').val(data[7]
    
    
 });
  
   });

</script>

     

