<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
    <!-- Progress resul area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3  align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
    <div class="row row-cols-1 align-items-stretch g-4 py-3">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    
    <?php 
     include '../includes/connection.php'; 
     $studentid =  $_SESSION['studentid']; 

     $sql = "SELECT * FROM tblstudents WHERE studentid = '$studentid'";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($result);
      
    ?>
    <div class="row">
    <div class="col-md-8"> 
    <h5 class="h3 mb-3 fw-bold fst-italic">
     <img title="profile image" class="img-profile-2 fst-italic" src="../assets/<?php echo $_SESSION['photo'];?>" alt="<?php echo $_SESSION['firstname']." ". $_SESSION['lastname']; ?>">
       <?php echo $_SESSION['firstname']." ". $_SESSION['lastname']; ?></h5>
    </div>
    <div class="col-md-4 mt-3 mb-3">
  <a href="student-print-result.php?printresult=<?php echo $row['id'];?>&viewresult=<?php echo $row['studentid'];?>" class="btn btn-dark btn-sm fw-bold" target="_blank">Print Progress <i class="fas fa-print"></i></a>
    <div>
    </div>
     </div>
     <!-- Student Courses --->
   <div class="container form-sigin">
       <div class="row">
       <div class="col-md-12">
       <div class="table-heading text-white fw-bold"> Sessional Grade Point Average </div>
       <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead>
         <tr class="text-center">
           <th scope="col">#</th>
           <th scope="col" class="d-none d-md-block">Course Code</th>
           <th scope="col">Course Name</th>
           <th scope="col" class="d-none d-md-block">Credit Hour</th>
           <th scope="col">Semester</th>
           <th scope="col">Grade Earned</th>
         </tr>
</thead>
         <tbody class="text-center">
         <tr>
<!--- PHP Code to retrieve courses from DB--->
 <?php
 include '../includes/connection.php'; 
 $i = 1; // loops iteration in table
// query to retrieve courses from system database
$studentid =  $_SESSION['studentid']; 

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
WHERE tblgrades.student_ID = '$studentid' ORDER BY tblgrades.sem_ID";

     $result = mysqli_query($conn, $sql);
     // checking query status inside DB
         if(mysqli_num_rows($result) > 0) {
       while ($row = mysqli_fetch_assoc($result)){ 
         $i;?> <!--Closes while loop to enter HTML --->
           <td><?php echo $i++;?></td>
           <td class="d-none d-md-block"><?php echo $row['course_code'];?></td>
           <td><?php echo $row['course_name'];?></td>
           <td class="d-none d-md-block"><?php echo $row['credit_hour'];?></td>
           <td><?php echo $row['semester_Name'];?></td>
           <td><?php echo $row['Remarks'];?></td>
         </tr>
       
   
    <?php } 
    
       }
       ?>

         </tbody>
       </table>
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