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
     <select name="program"  class="form-select" required>
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
        <button class="btn btn-dark btn-sm" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>

<div class="row">
    <div class="col-md-4">
    <h3 class="page-header fst-italic">List of Students </h3> 
</div>
<div class="col-md-8">
<a data-bs-toggle="modal" data-bs-target="#Modal1">
<button type="button" class="btn btn-dark btn-sm fw-bold">  Add New Student  <i class="fas fa-users"></i></button>
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
                            <strong>Admin <?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                        
                    ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Admin <?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>

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
        <th class="text-center">Action</th>
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
<div class="btn-group py-2">
<a href="admin-view-student.php?viewstudent=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm" title="View"><i class="fas fa-eye"></i> </a>
<a class="text-white mr-2 text-decoration-none btn btn-success btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal4" title="Edit"><i class="fas fa-marker"></i> </a>
  <a href="../inlcudes/action.php?del=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this student?')";
    title="Delete"><i class="fas fa-trash"></i> </a>
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
<div class="btn-group py-2">
<a href="admin-view-student.php?viewstudent=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm" title="View"><i class="fas fa-eye"></i> </a>
<a class="text-white mr-2 text-decoration-none btn btn-success btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal4" title="Edit"><i class="fas fa-marker"></i> </a>
  <a href="../includes/action.php?deletestudent=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this student?')";
    title="Delete"><i class="fas fa-trash"></i> </a>
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

   <!---ADD NEW STUDENT MODAL-------->
   <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add New Student</h4>
</div>
    <!-- Admin: Add Student Section --->
<form action="controller.php" method="POST" enctype="multipart/form-data">
<div class="modal-body">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
       <small class="fst-italic text-muted"> student ID is the same as student username for login</small>
       <input type="text" class="form-control"  name="studentid" placeholder="Student ID" required>
     </div>
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
     </div>
     
     <div class="form-group mb-3">
       <input type="text" class="form-control"  name="middlename" placeholder="Middle Name">
     </div>
     
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
     </div>
     <div class="form-group mb-3">
     <select name="gender"  class="form-select" required>
     <option selected>Gender</option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     </select>
     </div>
     </div> <!-- column 1 ends -->
     <div class="col-md-6"> <!-- column 2 starts -->
     <div class="form-group mb-3 mt-3">
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
       <input type="password" class="form-control"  name="password" placeholder="Password">
     </div>
   
     <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" placeholder="Photo" required>
     </div>
     <div class="form-group mb-3">
       <input type="tel" class="form-control fst-italic" name="phone" placeholder="Phone - format should start with +232" required>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4 fw-bold" type="submit" name="modaladdstudent">
  <i class="fas fa-users"></i> Add Student</button>
<button type="button" class="close btn btn-sm btn-danger mt-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>

 <!---EDIT STUDENT MODAL-------->
 <div class="modal fade" id="Modal4">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Update Student Record</h4>
</div>
    <!-- Admin: Edit Student Section --->
<form action="../includes/action.php" method="POST" enctype="multipart/form-data">
<div class="modal-body">
<input type="hidden" name="updateid" id="updateid" value="<?php echo $row['id'];?>">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
       <input type="text" class="form-control"  name="studentid" id="studentid" required>
     </div>
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="firstname" id="firstname" required>
     </div> 
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="lastname" id="lastname" required>
     </div>
     </div> <!-- column 1 ends -->
     <div class="col-md-6"> <!-- column 2 starts -->
     <div class="form-group mb-3">
     <select name="program" id="program"  class="form-select"  required>
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
     <select name="level" id="level" class="form-select" required>
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
    <div class="form-group">
       <input type="file" class="form-control"  name="photo" id="photo" required>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modalupdatestudent">
  <i class="fas fa-users"></i> Update Record</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>
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
      $('#studentid').val(data[2]);
      $('#firstname').val(data[3]);
      $('#lastname').val(data[4]);
      $('#program').val(data[5]);
      $('#level').val(data[6]);
    

 });
  

  });

</script>
        