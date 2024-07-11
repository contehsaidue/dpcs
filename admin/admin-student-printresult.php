
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
   border-left:2px solid;
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
      <img class="pull-right result-logo" src="../assets/images/nulogo.jpeg" alt="nulogo">
        <h4 class="text-center">NJALA UNIVERSITY</h4>
        <h5 class="text-center">Office of the Registrar - Secretariat</h5>
        <h6 class="text-center">Njala Campus - Sierra Leone</h6>
        <h6 class="text-center">Call: 078 701 222 | Email: registrar@njala.edu.sl</h6>
            </div>
      </div>
      <!-- /.col -->
    </div>

  <div class="row">
        <div class="col-xs-12">
          <h5 class="text-uppercase text-center">
            Individual Progress Report - 2021/2022 Academic Year
            </h5>
        </div> 
      </div> 

       <div class="container">
        <table class="table table-striped table-bordered table-hover table-responsive">
          <thead>
          <?php
      include '../includes/connection.php';

      if(isset($_GET['printresult'])){
        $id = $_GET['printresult'];
        
        $sql ="SELECT * FROM tblstudents 
        JOIN tblprograms ON tblprograms.prog_ID = tblstudents.program
        JOIN tbllevel ON tbllevel.level_ID = tblstudents.level
        WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0){
        while ($row = mysqli_fetch_assoc($result)){ 
     
 ?>

            <th><?php echo "NAME: " .strtoupper($row['lastname']).' ' .', '.' ' .$row['firstname'].' ' . $row['middlename'];?></th> 
           
            <th><?php echo "ID. NO: " .$row['studentid'];?></label></th> 
            </thead>
          <thead> 
          <th><?php echo "PROGRAM OF STUDENT: " .$row['program_Name']; ?></th>
        
            <th><?php echo "Year: ".$row['level_Name'];?></th>
            </thead>
        </table>
      </div>
   
<?php
        }
    }
      } 
?>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
 <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead> 
<tr class="text-center text-uppercase">
            <th scope="col">Course Code</th>
            <th scope="col">Course Description</th>
            <th scope="col">Credit Hours</th>
            <th scope="col">Grade Earned</th>
          </tr>
 </thead>
          <tbody class="text-center">
     <tr>
          <?php
  include '../includes/connection.php'; 

 // query to retrieve grades from system database
 if(isset($_GET['viewresult'])){
  $id = $_GET['viewresult'];

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
            <td><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['Remarks'];?></td>
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
      <!-- Sessional GPA -->
<div class="container row">
<div class="col-md-12">
<h5>Sessional Grade Point Average (SGPA) =  </h5>
</div>
</div>

      <!--  Remarks -->
      <div class="container row mt-2">
<div class="col-md-12">
<h5><strong>Remark:</strong> </h5>
</div>
</div>

      <!-- Signatures -->
      <div class="container mt-5">
<div class="float-start">
<h5>................................................................. <br>
<strong>DEAN SCHOOL OF TECHNOLOGY</strong>  </h5>
</div>
<div class="float-end">
<h5>...............................................<br>
<strong>DEPUTY REGISTRAR,NC</strong>  </h5>
</div>
</div>

</div>
<!-- ./wrapper -->
<?php require 'admin-dashboard-footer.php';?>
 