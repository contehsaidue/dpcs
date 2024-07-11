<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-md-3 pt-5 pb-2 mb-3 border-bottom">
      </div>
      
<!-- Course area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
      <?php
          include '../includes/connection.php';
           $id = $_SESSION['program'];
           $level = $_SESSION['level'];

           $sql ="SELECT * FROM tblstudents 
           JOIN tblprograms ON tblstudents.program = tblprograms.prog_ID 
           JOIN tbllevel ON tblstudents.level = tbllevel.level_ID
           WHERE tblprograms.prog_ID = '$id' AND tbllevel.level_ID = '$level'";
           $result = mysqli_query($conn, $sql);
           $row = mysqli_fetch_assoc($result);
        ?>
        <h6 class="display-6 fw-bold lh-2">My Tutors </h6> <small class="fst-italic fw-bold"> for <?php echo $row['program_Name'].' '.$row['level_Name']; ?></small>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
    <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead class="py-5 bg-dark text-white">
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Name</th>
        <th class="d-none d-md-block">Email</th>
        <th>Phone</th>
</tr>
</thead>
<tbody class="text-center">

<tr class="py-2">
<!---Retrieving Tutors from DB--->
<?php 
require '../includes/connection.php';
$i = 1; // loops iteration in table
$prog = $_SESSION['program'];
$level = $_SESSION['level'];

 $sql = "SELECT * FROM tbltutorprogram 
 JOIN tblprograms ON tbltutorprogram.prog_ID = tblprograms.prog_ID
 JOIN tbllevel ON tbllevel.level_ID = tbltutorprogram.level_ID
 JOIN tbltutor ON tbltutor.id = tbltutorprogram.tut_ID 
WHERE tblprograms.prog_ID = '$prog' AND tbltutorprogram.level_ID = '$level' ";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){
  $i; ?>
 
<td><?php echo $i++;?></td>
<td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['firstname'];?>"/></td>
<td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
<td class="d-none d-md-block"><?php echo $row['email'];?></td>
<td><?php echo $row['phone'];?></td>
</tr>
<?php 
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

</div><!-- row ends -->

<?php include 'student-dashboard-footer.php';?>