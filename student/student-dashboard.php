<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-md-3 pt-5 pb-2 mb-3 border-bottom mt-3">
      </div>
      <!-- Feedback Message -->
<?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?> </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
<!-- Main Dashboard Starts-->
<div class="row">
<h6 class="display-6 fw-bold mt-2">Dashboard</h6>
<div class="col-md-8 d-none d-md-block">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-4 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">My timetable</h6>
      </div>
      <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead>
          <tr class="text-center">
            <th scope="col"></th>
            <th scope="col">8:00 AM - 10:00 AM</th>
            <th scope="col">10:00 AM - 12:00 PM</th>
            <th scope="col">2:00 PM - 4:00 PM</th>
          </tr>
 </thead>
          <tbody class="text-center fw-bold">
           <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 
 // query to retrieve courses from system database
      $program = $_SESSION['program'];
      $level = $_SESSION['level'];

      $sql = "SELECT DISTINCT * FROM `tbltutortimetable` 
      JOIN tblprograms ON tbltutortimetable.prog_ID = tblprograms.prog_ID 
      JOIN tbllevel ON tbllevel.level_ID = tbltutortimetable.level_ID 
      JOIN tblcourses ON tblcourses.Course_ID = tbltutortimetable.Course_ID
      JOIN tbldays ON tbldays.days_ID = tbltutortimetable.days
      JOIN tbltime ON tbltime.time_ID = tbltutortimetable.time
      WHERE tbltutortimetable.prog_ID = '$program' AND 
      tbltutortimetable.level_ID  = '$level' ORDER BY tbldays.days_ID ASC"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
 
          <tr class="text-center">
          <?php if($row['days'] == "Monday" && $row['time'] == "8:00 AM - 10:00 AM"){?>
          <th scope="col"><?php echo $row['days'];?></th>
          <td class="bg-success text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Monday" && $row['time'] == "10:00 AM - 12:00 PM"){?>
             <!-- skip one columns -->
             <th scope="col"><?php echo $row['days'];?></th>
            <td></td>
            <td class="bg-success text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Monday" && $row['time'] == "2:00 PM - 4:00 PM"){?>
            <th scope="col"><?php echo $row['days'];?></th>
            <!-- skip two columns -->
            <td></td>
            <td></td>
            <td class="bg-success text-light"><?php echo $row['course_name'];?></td>
          <?php 
          }?>
          </tr>   
          <tr class="text-center">
          <?php if($row['days'] == "Tuesday" && $row['time'] == "8:00 AM - 10:00 AM"){?>
          <th scope="col"><?php echo $row['days'];?></th>
          <td class="bg-dark text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Tuesday" && $row['time'] == "10:00 AM - 12:00 PM"){?>
             <!-- skip one columns -->
             <th scope="col"><?php echo $row['days'];?></th>
            <td></td>
            <td class="bg-dark text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Tuesday" && $row['time'] == "2:00 PM - 4:00 PM"){?>
            <th scope="col"><?php echo $row['days'];?></th>
            <!-- skip two columns -->
            <td></td>
            <td></td>
            <td class="bg-dark text-light"><?php echo $row['course_name'];?></td>
          <?php 
          }?>
          </tr>   
          <tr class="text-center">
          <?php if($row['days'] == "Wednesday" && $row['time'] == "8:00 AM - 10:00 AM"){?>
          <th scope="col"><?php echo $row['days'];?></th>
          <td class="bg-primary text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Wednesday" && $row['time'] == "10:00 AM - 12:00 PM"){?>
             <!-- skip one columns -->
             <th scope="col"><?php echo $row['days'];?></th>
            <td></td>
            <td class="bg-primary text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Wednesday" && $row['time'] == "2:00 PM - 4:00 PM"){?>
            <th scope="col"><?php echo $row['days'];?></th>
            <!-- skip two columns -->
            <td></td>
            <td></td>
            <td class="bg-primary text-light"><?php echo $row['course_name'];?></td>
          <?php 
          }?>
          </tr>   
          <tr class="text-center">
          <?php if($row['days'] == "Thursday" && $row['time'] == "8:00 AM - 10:00 AM"){?>
          <th scope="col"><?php echo $row['days'];?></th>
          <td class="bg-secondary text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Thursday" && $row['time'] == "10:00 AM - 12:00 PM"){?>
             <!-- skip one columns -->
             <th scope="col"><?php echo $row['days'];?></th>
            <td></td>
            <td class="bg-secondary text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Thursday" && $row['time'] == "2:00 PM - 4:00 PM"){?>
            <th scope="col"><?php echo $row['days'];?></th>
            <!-- skip two columns -->
            <td></td>
            <td></td>
            <td class="bg-secondary text-light"><?php echo $row['course_name'];?></td>
          <?php 
          }?>
          </tr>    
          <tr class="text-center">
          <?php if($row['days'] == "Friday" && $row['time'] == "8:00 AM - 10:00 AM"){?>
          <th scope="col"><?php echo $row['days'];?></th>
          <td class="bg-danger text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Friday" && $row['time'] == "10:00 AM - 12:00 PM"){?>
             <!-- skip one columns -->
             <th scope="col"><?php echo $row['days'];?></th>
            <td></td>
            <td class="bg-danger text-light"><?php echo $row['course_name'];?></td>
          <?php }else if($row['days'] == "Friday" && $row['time'] == "2:00 PM - 4:00 PM"){?>
            <th scope="col"><?php echo $row['days'];?></th>
            <!-- skip two columns -->
            <td></td>
            <td></td>
            <td class="bg-danger text-light"><?php echo $row['course_name'];?></td>
          <?php }?>
          </tr>    
          <?php
        }
          }?>
          </tbody>
    </table>
    </div>
  </div>
</div>
<!-- Classes for today -->
<div class="col-md-4">
<div class="container my-3">
    <div class="row p-4 pb-0 pe-lg-2 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">Classes today</h6>
      </div>
      <table class="table table-striped table-borderless table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead>
          <tr class="text-center">
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
 </thead>
 <?php
 include '../includes/connection.php';
 $program = $_SESSION['program'];
 $level = $_SESSION['level'];
 $today = date('N');
 $timetableselectquery = "SELECT * FROM tbltutortimetable 
 JOIN tblprograms USING(prog_ID) 
 JOIN tbllevel USING(level_ID) 
 JOIN tblcourses USING(Course_ID) 
 JOIN tbltutor ON tbltutor.id = tbltutortimetable.tut_ID 
 JOIN tbldays ON tbldays.days_ID = tbltutortimetable.days
 JOIN tbltime ON tbltime.time_ID = tbltutortimetable.time
  WHERE tblprograms.prog_ID = '$program' AND tbllevel.level_ID = '$level' AND tbltutortimetable.days = '$today'";

$timetableselectqueryrun = mysqli_query($conn, $timetableselectquery);
$timetableselectqueryrowcount = mysqli_num_rows($timetableselectqueryrun);
if($timetableselectqueryrowcount > 0){
while ($row = mysqli_fetch_assoc($timetableselectqueryrun))
{

 ?>
          <tbody class="text-center">
          <tr class="text-center">
         <td><img src="../assets/images/1.jpg" class="img-profile-2"></td>
         <td><h6 class="text-start fw-bold"><?php echo $row['course_name'];?></h6>
         <p class="text-start"><?php echo $row['designation']. ' '.$row['lastname'];?> : <?php echo $row['time'];?></p>
         </td>
          </tr>  
          </tbody>
      <?php
   }
}else{?>
<h6 class="fst-italic fw-bold small text-center">Hey <?php echo $_SESSION['firstname']; ?>! <br> there're no class(es) for today!</h6>
<?php }?>
    </table>
    </div>
  </div>
</div>

<!-- Course area starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-0  align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">My Courses</h6>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">
    <?php
  include '../includes/connection.php'; 
 // query to retrieve courses from system database
 $id = $_SESSION['id'];

 $sql ="SELECT * FROM tblstudentcourses 
 JOIN tblstudents ON tblstudents.id = tblstudentcourses.student_ID
 JOIN tblcourses ON tblcourses.course_ID = tblstudentcourses.course_ID
 JOIN tbltutor ON tbltutor.id = tblstudentcourses.tut_ID
 WHERE tblstudentcourses.student_ID = '$id'";

      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
      <div class="col">
        <div class="card card-cover h-70 overflow-hidden text-white bg-dark rounded-5 shadow-lg">
          <div class="d-flex flex-column h-100 p-2 pb-3 text-white text-shadow-1">
    
            <h6 class="pt-5 mt-2 mb-4 display-6 lh-1 fw-bold"><?php echo $row['course_name'];?></h6>
     
          </div>
        </div>
      </div>
      <?php } 
     
    }
    ?>
     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->


<!-- Grades summary area starts -->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 rounded-3 border shadow-lg">
        <h6 class="fw-bold lh-2 display-6">Grades Summary</h6>
  <div class="row">
  <div class="col-md-6 bg-success text-center text-light">
      <h5 class="fw-bold">First Semester Grades</h5>
      <span class="badge rounded-pill bg-dark"> 
    <?php
  include '../includes/connection.php'; 
// query to retrieve courses from system database
      $studentid =  $_SESSION['studentid']; 
     echo $conn->query( 
     $sql = "SELECT *, CASE WHEN score >= 75 then 'A' 
     WHEN score >= 65 then 'B' 
     WHEN score >= 50 then 'C' 
     WHEN score >= 40 then 'D' 
     WHEN score >= 30 then 'E' 
     ELSE 'F' END AS Remarks FROM tblgrades 
     JOIN tblprograms ON tblprograms.prog_ID = tblgrades.prog_ID
     JOIN tblcourses ON tblcourses.Course_ID = tblgrades.course_ID
     JOIN tblsemester ON tblsemester.sem_ID = tblgrades.sem_ID
     JOIN tbllevel ON tbllevel.level_ID = tblgrades.level_ID
     WHERE tblgrades.student_ID = '$studentid' AND tblgrades.sem_ID = 1")->num_rows;?>
     </span> 
     <p class="fw-bold fst-italic">Out of 7 Grades</p>
      </div><!-- column 1 ends-->

      <div class="col-md-6 bg-success text-center  text-light">
      <h5 class="fw-bold">Second Semester Grades</h5>
      <span class="badge rounded-pill bg-dark"> 
    <?php
  include '../includes/connection.php'; 
// query to retrieve courses from system database
      $studentid =  $_SESSION['studentid']; 
     echo $conn->query( 
     $sql = "SELECT *, CASE WHEN score >= 75 then 'A' 
     WHEN score >= 65 then 'B' 
     WHEN score >= 50 then 'C' 
     WHEN score >= 40 then 'D' 
     WHEN score >= 30 then 'E' 
     ELSE 'F' END AS Remarks FROM tblgrades 
     JOIN tblprograms ON tblprograms.prog_ID = tblgrades.prog_ID
     JOIN tblcourses ON tblcourses.Course_ID = tblgrades.course_ID
     JOIN tblsemester ON tblsemester.sem_ID = tblgrades.sem_ID
     JOIN tbllevel ON tbllevel.level_ID = tblgrades.level_ID
     WHERE tblgrades.student_ID = '$studentid' AND tblgrades.sem_ID = 2")->num_rows;?>
     </span> 
     <p class="fw-bold fst-italic">Out of 7 Grades</p>
      </div>
   </div>
    
  </div>
</div>
</div>

</div><!-- row ends -->
</main>

<?php require 'student-dashboard-footer.php';?>