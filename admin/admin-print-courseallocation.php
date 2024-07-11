
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
<link href="../css/bootstrap.min.css" rel="stylesheet">
<!--custom css-->
<link href="../css/dashboard.css" rel="stylesheet">
<!-- Font Awesome icons (free version)-->
<script src="../js/all.js"></script>
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
        <h4 class="text-center">SCHOOL OF TECHNOLOGY - NJALA UNIVERSITY</h4>
        <h5 class="text-center text-uppercase">Department of physics & computer science</h5>
        <h6 class="text-center text-uppercase">course allocation - 2021/22</h6>
            </div>
      </div>
      <!-- /.col -->
    </div>


       <div class="container">
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
 <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead> 

              <tr class="text-center text-uppercase">
            <th scope="col">Course Code</th>
            <th scope="col">Course Description</th>
            <th scope="col">Credit Hours</th>
            <th scope="col">Staff</th>
          </tr>
 </thead>
 <tr>
              <th class="text-center fst-italic text-uppercase" colspan="4"><?php echo $row['program_Name'].' - '.$row['level_Name'];?></th>
              </tr>
          <tbody class="text-center">
     <tr>
     
<?php
  include '../includes/connection.php'; 

 // query to retrieve courses from system database
   $sql = "SELECT * FROM `tblcourses` 
   JOIN tblprograms ON tblcourses.prog_ID = tblprograms.prog_ID 
   JOIN tblsemester ON tblsemester.sem_ID = tblcourses.sem_ID 
   JOIN tbllevel ON tbllevel.level_ID = tblcourses.level_ID
   JOIN facultyregister ON facultyregister.id = tblcourses.tut_ID";

      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
             
            <td><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
          </tr>
        
    
     <?php } 
     
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
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery-3.3.0.min.js"></script>
<script src="../js/dashboard.js"></script>
     
  </body>
</html>
