
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Department of Physics & Computer Science</title>

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<!--custom css-->
<link href="../assets/css/dashboard.css" rel="stylesheet">
<!-- Font Awesome icons (free version)-->
<script src="../assets/js/all.js"></script>
  <!-- Custom style for result Print image -->
 <style>
 .result-logo{
   margin-right:1rem;
   width: 8rem;
   height:8.0rem;
   margin-top:-5px;
   float:right;
 }
 .result-logo-1{
   margin-right:1rem;
   width: 4rem;
   height:4.0rem;
   margin-top:4.5px;
   float:right;
 }
 </style>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->

    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
      <div class="result-header py-2" style="border: 3px solid;">
      <img class="pull-right result-logo-1" src="../assets/images/nulogo.jpeg" alt="nulogo">
        <h4 class="text-center text-uppercase">Njala University</h4>
        <h5 class="text-center text-uppercase">Department of physics & computer science</h5>
      
            </div>
      </div>
      <!-- /.col -->
    </div>

       <div class="container mt-3">
      <div class="text-center fw-bold text-uppercase">
          Student Attendance List - BSC Computer Science - 2022-01-19 <br>
          Second Year
</div>
<div class="fw-bold text-uppercase">
Tutor: Mr Michael Tommy <br>
Course: Human Computer Interaction
</div>

   
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row mt-5">
        <div class="col-xs-12 col-md-12">
 <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead> 
<tr class="text-center text-uppercase">
            <th scope="col">Student ID</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
          </tr>
 </thead>
          <tbody class="text-center">
     <tr>
  <?php
  include '../includes/connection.php'; 

 // query to retrieve courses from system database

 if(isset($_GET['program']) && isset($_GET['tutid']) && isset($_GET['courseid'])){
  $program = $_GET['program'];
  $tutid = $_GET['tutid'];
  $courseid = $_GET['courseid'];
      $sql = "SELECT * FROM `tblstudentattendace` 
      JOIN tblstudents ON tblstudents.id = tblstudentattendace.studentid  
      JOIN tblstudentcourses ON tblstudentcourses.student_courseID = tblstudentattendace.courseid 
      JOIN tblprograms ON tblprograms.prog_ID = tblstudentattendace.programid
      WHERE tblstudentattendace.programid = '$program' 
      AND tblstudentattendace.tutid = '$tutid' AND tblstudentattendace.courseid = '$courseid'"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['studentid'];?></td>
            <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></td>
            <td><?php echo $row['status'];?></td>
            
          </tr>
        
    
     <?php } 
     
        }
      }
        ?>

  </tbody>
</table>


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 



</div>
<!-- ./wrapper -->
<?php include 'faculty-dashboard-footer.php';?>