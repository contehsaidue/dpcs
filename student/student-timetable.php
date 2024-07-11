<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      
<!-- Course area  starts -->
<div class="row">
<div class="col-md-12">
<div class="my-5">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  
        <h6 class="display-6 fw-bold lh-2">My Timetable </h6>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">

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
          <?php 
          }?>
          </tr>    
          <?php
        }
          }?>
          </tbody>
    </table>
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->

<?php include 'student-dashboard-footer.php';?>