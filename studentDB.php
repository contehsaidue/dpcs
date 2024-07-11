<?php include 'includes/header.php';?>
 
<!-- Student Database area  starts -->
<div class="row mx-5">
<div class="col-md-12">
<div class="my-5">
    <div class="row p-4 pb-0 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  
        <h6 class="display-6 fw-bold lh-2">Students' Database </h6> 
        <form class="form-inline" role="form" method="POST">
 <div class="row">
    <div class="col-md-4">
    <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
     <option selected>Program</option>
     <?php 
     include 'includes/connection.php';
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
     
     include 'includes/connection.php';
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
        <button class="btn btn-dark btn-md" name="submit">Search  <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>

    <div class="row row-cols-1 align-items-stretch g-4 py-5">
    <?php 
require 'includes/connection.php';

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
    <div class="col-md-3 mb-3">  
 <div class="panel panel-default border-rounded"> 
 <div class="panel-body">
    <div class="well well-sm text-center bg-dark" style="color:#fff;padding:8px;">
              <b><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname']; ?></b> 
      </div>
         <img src="assets/<?php echo $row['photo'];?>" class="facultydb-img">
         <div class="panel-footer fst-italic fs-small">
         <div class="list-group bg-dark">
      <button class="btn btn-sm  text-white"><i class="fa fa-university fa-fw text-white"></i> <?php echo $row['program_Name'];?></button>
      <button class="btn btn-sm  text-white"><i class="fa fas fa-th-list fa-fw text-white"></i> <?php echo $row['level_Name'];?></button>
      <button class="btn btn-sm  text-white"><i class="fa fa-phone fa-fw text-white"></i> <?php echo $row['phone'];?></button>
           </div>
           </div>
           <!--<div class="text-center">
           <button type="button" class="btn btn-md btn-success">View <i class="fas fa-eye"></i></button>
           </div>-->
         </div>
 </div>

        </div> <!-- column ends -->
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
    <div class="col-md-3 mb-3">  
 <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
    <div class="well well-sm text-center bg-dark" style="color:#fff;padding:8px;">
              <b><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname']; ?></b> 
      </div>
         <img src="assets/<?php echo $row['photo'];?>" class="facultydb-img">
         <div class="panel-footer fst-italic fs-small">
         <div class="list-group bg-dark">
      <button class="btn btn-sm  text-white"><i class="fa fa-university fa-fw text-white"></i> <?php echo $row['program_Name'];?></button>
      <button class="btn btn-sm  text-white"><i class="fa fas fa-th-list fa-fw text-white"></i> <?php echo $row['level_Name'];?></button>
      <button class="btn btn-sm  text-white"><i class="fa fa-phone fa-fw text-white"></i> <?php echo $row['phone'];?></button>
           </div>
           </div>
           <!--<div class="text-center">
           <button type="button" class="btn btn-md btn-success">View <i class="fas fa-eye"></i></button>
           </div>-->
         </div>
 </div>

        </div> <!-- column ends -->
        <?php } 
}  
 }
 ?>
 
<!-- end student -->
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->


<!--Bootstrap Javascript Files-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.3.0.min.js"></script>