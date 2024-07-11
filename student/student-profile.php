<?php
 require 'studentinit.php';
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
           
<!-- Student profile starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  
        <h6 class="display-6 fw-bold lh-2">My Profile </h6> 
    <div class="row row-cols-1  align-items-stretch g-4 py-5">
 
    <div class="row">
    <div class="col-md-4">
    <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="color:#fff;padding:8px;">
              <b><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'].' - '.' '.$_SESSION['studentid']; ?></b> 
      </div>
      <img class="figure-img img-fluid rounded profile-image" width="400" height="60" role="img" src="../<?php echo $_SESSION['photo'];?>">
         </div>
        </div>
        </div>
        <div class="col-md-8">
        <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="color:#fff;padding:8px;">
              <b><?php echo $_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']; ?></b> 
              - <span class="fst-italic">Personal Records</span>
      </div>
      <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
          <tbody>
          <tr>
            <th scope="row">Username</th>
            <td><?php echo $_SESSION['username'];?></td>
          </tr>
          <tr>
            <th scope="row">First Name</th>
            <td><?php echo $_SESSION['firstname'];?></td>
          </tr>
          <tr>
            <th scope="row">Middle Name</th>
            <td><?php echo $_SESSION['middlename'];?></td>
          </tr>
          <tr>
            <th scope="row">Last Name</th>
            <td><?php echo $_SESSION['lastname'];?></td>
          </tr>
          <tr>
          <?php
          include '../includes/connection.php';
           $id = $_SESSION['program'];

           $sql ="SELECT * FROM tblstudents 
           JOIN tblprograms ON tblstudents.program = tblprograms.prog_ID 
           JOIN tbllevel ON tblstudents.level = tbllevel.level_ID
           WHERE tblprograms.prog_ID = '$id'";
           $result = mysqli_query($conn, $sql);
           $row = mysqli_fetch_assoc($result);
          ?>
            <th scope="row">Program</th>
            <td><?php echo $row['program_Name'];?></td>
          </tr>
          <tr>
          <?php
          include '../includes/connection.php';
           $level = $_SESSION['level'];

           $sql ="SELECT * FROM tblstudents 
           JOIN tblprograms ON tblstudents.program = tblprograms.prog_ID 
           JOIN tbllevel ON tblstudents.level = tbllevel.level_ID
           WHERE tbllevel.level_ID = '$level'";
           $result = mysqli_query($conn, $sql);
           $row = mysqli_fetch_assoc($result);
          ?>
            <th scope="row">Level</th>
            <td><?php echo $row['level_Name']; ?></td>
          </tr>
          <tr>
            <th scope="row">Phone</th>
            <td><?php echo $_SESSION['phone'];?></td>
          </tr>

          </tbody>
        </table>
        <a href="student-update-record.php" class="btn btn-dark btn-sm">Update Record <i class="fas fa-marker"></i></a>
        </div>
        </div>
        </div>
        </div> <!-- row ends --->






     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->

</main>
<?php include 'student-dashboard-footer.php';?>