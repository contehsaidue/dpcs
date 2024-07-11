<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-md-3 pt-5 pb-2 mb-3 border-bottom"> 
      </div>
           <!-- Dashboard Main --->
 <form action="controller.php" class="form-inline" method="POST">
 <div class="row mt-5">
    <div class="col-md-4">
        <?php
          include '../includes/connection.php';
           $id = $_SESSION['id'];
          
           $sql ="SELECT * FROM tblstudents 
           JOIN  tblprograms ON tblprograms.prog_ID = tblstudents.program
           JOIN tbllevel ON tbllevel.level_ID = tblstudents.level
           WHERE id = '$id'";
           $result = mysqli_query($conn, $sql);
           $row = mysqli_fetch_assoc($result);
          ?>
    <input type="hidden" class="form-control"  name="studentid" value="<?php echo $row['id'];?>">
    <input type="hidden" class="form-control"  name="program" value="<?php echo $row['prog_ID'];?>">
    <input type="hidden" class="form-control"  name="level" value="<?php echo $row['level_ID'];?>">
    <div class="form-group mb-3">
     <select name="coursename"  class="form-select"  required>
     <option selected>Course</option>
     <?php 
     include '../includes/connection.php';
     $program = $_SESSION['program'];
     $level = $_SESSION['level'];

     $sql ="SELECT * FROM tbltutorcourses 
     JOIN tblcourses ON tblcourses.Course_ID = tbltutorcourses.course_ID
     WHERE tbltutorcourses.prog_ID = '$program' AND tbltutorcourses.level_ID = '$level'";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['Course_ID'];?>"><?php echo $row['course_name'];?></option>
     <?php } 
     
        }
        ?>
     </select>
     </div>
        </div>
      <div class="col-md-4">
    <div class="form-group mb-3">
     <select name="tutor"  class="form-select"  required>
     <option selected>Tutor</option>
     <?php 
     include '../includes/connection.php';
     $program = $_SESSION['program'];
     $level = $_SESSION['level'];

     $sql ="SELECT * FROM tbltutorcourses 
     JOIN tbltutor ON tbltutor.id = tbltutorcourses.tut_ID
     WHERE tbltutorcourses.prog_ID = '$program' AND tbltutorcourses.level_ID = '$level'";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['id'];?>"><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></option>
     <?php } 
     
        }
        ?>
     </select>
     </div>
        </div>
        <div class="col-md-4">
        <button class="btn btn-success btn-sm fw-bold fst-italic" name="studentcoursesignup">Signup  <i class="fas fa-check-circle"></i></button>
        </div>

    </div>
 </form>
<!-- Feedback Message -->
<?php 
                    if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                            <strong><?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                        
                    ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong><?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>

    <div class="row">
 <div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">My Courses </h6>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">
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

</div>

        <div class="table-heading text-white">
        <strong class="fst-italic fw-bold">course outline for <?php echo $row['program_Name'].' '.$row['level_Name']; ?></strong> </div>
  <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col" class="d-none d-md-block">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col" class="d-none d-md-block">Credit Hour</th>
            <th scope="col">Tutor</th>
            <th scope="col">Action</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 
  $i = 1; // loops iteration in table
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
        while ($row = mysqli_fetch_assoc($result)){ 
          $i;?> <!--Closes while loop to enter HTML --->
            <td><?php echo $i++;?></td>
            <td class="d-none d-md-block"><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td class="d-none d-md-block"><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
          <td>
          <div class="btn-group py-2">
  <a href="controller.php?studentdeletecourse=<?php echo $row['student_courseID'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm fst-italic fw-bold" onclick="return confirm('Do you want to unsign-up for this course?')";
    title="Delete">Unsign Up <i class="fas fa-marker"></i></a>
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

       
     
      </div>
    </div>
  </div>
</div>
</div>
   

</main>

<?php include 'student-dashboard-footer.php';?>