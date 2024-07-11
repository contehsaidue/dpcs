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
        <h6 class="display-6 fw-bold lh-2 mb-3">My Teaching Materials  <span class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal3">
     <i class="fas fa-plus-circle"></i> Add Material</span></h6> 
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
    </div>
<!--Faculty Add Material view Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead>
<tr class="text-center">
        <th>#</th>
        <th>Name</th>
        <th>Action</th>
</tr>
</thead>
<tbody>
<tr class="text-center">
<!---Retrieving Students from DB--->
<?php 
require '../includes/connection.php';

// selection all materials from database
      $tut_id = $_SESSION['id'];  
      $sql = "SELECT * FROM tblcoursematerial 
      JOIN tbltutor ON tbltutor.id = tblcoursematerial.tut_ID 
      JOIN tblprograms ON tblprograms.prog_ID = tblcoursematerial.prog_ID 
      JOIN tbllevel ON tbllevel.level_ID = tblcoursematerial.level_ID 
      JOIN tblsemester ON tblsemester.sem_ID = tblcoursematerial.sem_ID 
      WHERE tblcoursematerial.tut_ID = '$tut_id'";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
      if ($rowCount > 0){
      while ($row = mysqli_fetch_assoc($result)){ ?>
      <td class="text-center"><?php echo $row['mat_ID'];?></td>
      <td class="text-center"><?php echo $row['matname'];?></td>
      <td class="text-center">
      <div class="btn-group py-2">
                  <a href="../<?php echo $row['matcontent'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm" title="View" target="_blank"> <i class="fas fa-eye"></i> </a>
                  <a href="controller.php?facultydeletematerial=<?php echo $row['mat_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm editbtn"  title="delete" onclick="return confirm('Do you want to remove this course material?')";> <i class="fas fa-trash"></i> </a>
      </div>
      </td>
      </tr>
<?php } 
     
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
 <form action="controller.php" method="post" enctype="multipart/form-data">
 <div class="modal-body">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     
     <div class="form-group mb-3">
       <input type="text" class="form-control mb-2" name="filename" placeholder="File Name">
     </div>
     <div class="form-group mb-3">
       <input type="file" class="form-control" name="filecontent" placeholder="filetype">
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
     </div> <!-- column 1 ends -->
     <div class="col-md-6"> <!-- column 2 starts -->
  
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
     <button class="btn btn-sm fw-bold btn-dark mt-4" type="submit" name="facultyaddmaterial"> <i class="fas fa-plus-circle"></i> Add Material</button>
     <button type="button" class="close btn btn-sm fw-bold btn-danger mt-4" data-bs-dismiss="modal">Close</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>
<!---- Modals Section Ends-------->

     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->

</main>
<?php require 'faculty-dashboard-footer.php';?>
