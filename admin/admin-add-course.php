<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <form class="form-inline" role="form" method="POST">
 <div class="row">
    <div class="col-md-4">
    <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
     <option selected>Program</option>
     <?php 
     include '../includes/connection.php';
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
     
     include '../includes/connection.php';
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
        <button class="btn btn-dark btn-sm fst-italic fw-bold" name="submit">Search Course   <i class="fas fa-search"></i></button>
        </div>

    </div>
 </form>
      <!-- Dashboard Main --->
      <div class="row">
    <div class="col-md-8">
    <h3 class="page-header fst-italic">List of courses </h3> 
</div>
    <div class="col-md-4">
   <button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-th-list"></i> Add New Course</button>
</div>
</div>
<div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
            <!-- Feedback Message -->
<?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong>Admin <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?> </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Admin <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
<!--Course View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Credit Hour</th>
            <th scope="col">Tutor</th>
            <th scope="col">Semester</th>
            <th scope="col">Level</th>
            <th scope="col">Program</th>
            <th scope="col">Action</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 

 // query to retrieve courses from system database per program and level
    if (isset($_POST['submit']))
    {
      $program = $_POST['program'];
      $level = $_POST['level'];
          
      $sql = "SELECT * FROM `tblcourses` 
      JOIN tblprograms ON tblcourses.prog_ID = tblprograms.prog_ID 
      JOIN tblsemester ON tblsemester.sem_ID = tblcourses.sem_ID 
      JOIN tbllevel ON tbllevel.level_ID = tblcourses.level_ID
      JOIN tbltutor ON tbltutor.id = tblcourses.tut_ID
      WHERE tblcourses.prog_ID = '$program' AND tblcourses.level_ID = '$level'"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['Course_ID'];?></td>
            <td><img class="img-profile" src="../<?php echo $row['courseimage'];?>" alt="<?php echo $row['course_name'];?>"/></td>
            <td><?php echo $row['course_code'];?></td>
            <td><?php echo $row['course_name'];?></td>
            <td><?php echo $row['credit_hour'];?></td>
            <td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
            <td><?php echo $row['semester_Name'];?></td>
            <td><?php echo $row['level_Name'];?></td>
            <td><?php echo $row['program_Name'];?></td>
            <td>
            <div class="btn-group py-2">
<a class="text-white mr-2 text-decoration-none btn btn-dark btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal2" title="Edit"><i class="fas fa-marker"></i></a>
  <a href="controller.php?deletecourse=<?php echo $row['Course_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this course?')";
    title="Delete"><i class="fas fa-trash"></i></a>
</div>
</td>
          </tr>
        
    
     <?php } 
     
        }
      
    }else {

            
      $sql = "SELECT * FROM tblcourses 
      JOIN tblprograms ON tblcourses.prog_ID = tblprograms.prog_ID 
      JOIN tblsemester ON tblsemester.sem_ID = tblcourses.sem_ID 
      JOIN tbllevel ON tbllevel.level_ID = tblcourses.level_ID
      JOIN tbltutor ON tbltutor.id = tblcourses.tut_ID";

$result = mysqli_query($conn, $sql);
// checking query status inside DB
    if(!empty($result) && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
      <td><?php echo $row['Course_ID'];?></td>
      <td><img class="img-profile" src="../<?php echo $row['courseimage'];?>" alt="<?php echo $row['course_name'];?>"/></td>
      <td><?php echo $row['course_code'];?></td>
      <td><?php echo $row['course_name'];?></td>
      <td><?php echo $row['credit_hour'];?></td>
      <td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
      <td><?php echo $row['semester_Name'];?></td>
      <td><?php echo $row['level_Name'];?></td>
      <td><?php echo $row['program_Name'];?></td>
      <td>
      <div class="btn-group py-2">
      <a class="text-white mr-2 text-decoration-none btn btn-dark btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal2" title="Edit"><i class="fas fa-marker"></i></a>
  <a href="controller.php?deletecourse=<?php echo $row['Course_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this course?')";
    title="Delete"><i class="fas fa-trash"></i></a>
</div>
</td>
    </tr>

    <?php } 
}  
 }
 ?>

</table>
</div>
<!-- Print course outline -->
<form class="form-inline" role="form" action="admin-print-courseallocation.php" method="POST">
 <div class="row">
    <div class="col-md-3">
    <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
     <option selected>Program</option>
     <?php 
     include '../includes/connection.php';
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
    <div class="col-md-3">
    <div class="form-group mb-3">
     <select name="level" class="form-select" required>
     <option selected>Level</option>
     <?php 
     
     include '../includes/connection.php';
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
      <div class="col-md-3">
    <div class="form-group mb-3">
     <select name="semester" class="form-select" required>
     <option selected>Semester</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblsemester";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['sem_ID'];?>"><?php echo $row['semester_Name'];?></option>
     <?php } 
     
        }
        ?>
        </select>
     </div>
      </div>
        <div class="col-md-3">
        <?php 
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblprograms";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result) ?>
        <a class="btn btn-dark btn-sm" href="admin-print-courseallocation.php?printcourse=<?php echo['prog_ID'];?>" target="_blank"><i class="fas fa-print"></i> Print Course Outline</a>
        <?php } 
     
    ?>
        </div>

    </div>
 </form>
</div>

<!---Modals Section Starts----->

 
 <!---ADD COURSE MODAL-------->
 <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add New Course</h4>
</div>
<form action="controller.php" method="POST" enctype="multipart/form-data">
<div class="modal-body">
    <!-- Admin: Add Course Section --->
    <div class="row"> <!-- row starts -->
    <div class="col-md-6"> <!-- column 1 starts -->
    <div class="form-group mb-3">
      <input type="text" class="form-control"  name="coursecode" placeholder="Course Code">
      
    </div>
    <div class="form-group mb-3">
      <input type="text" class="form-control mb-2"  name="coursename" placeholder="Course Name">
    
    </div>
    <div class="form-group mb-3">
      <input type="text" class="form-control mb-2" name="credithour" placeholder="Credit Hour">
 
    </div>
    <div class="form-group mb-3">
    <select name="tutor" class="form-select" required>
     <option selected>Tutors</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tbltutor";
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
    </div> <!-- column 1 ends -->
    <div class="col-md-6"> <!-- column 2 starts --> 
    <div class="form-group mb-3">
     <select name="semester" class="form-select" required>
     <option selected>Semester</option>
     <?php 
     
     include '../includes/connection.php';
     $sql ="SELECT * FROM tblsemester";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)){ ?>
     ?>
     <option value="<?php echo $row['sem_ID'];?>"><?php echo $row['semester_Name'];?></option>
     <?php } 
     
        }
        ?>
     </select>
     </div>
    <div class="form-group mb-3">
     <select name="level" class="form-select" required>
     <option selected>Level</option>
     <?php 
     
     include '../includes/connection.php';
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
     <div class="form-group mb-3">
     <select name="program"  class="form-select"  required>
     <option selected>Program</option>
     <?php 
     
     include '../includes/connection.php';
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
     <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" placeholder="Photo">
     </div>
    </div> <!-- column 2 ends -->
</div> <!--row ends --->
 
   
</div>

<div class="modal-footer">
<div class="text-center">
    <button class="btn btn-sm btn-dark mt-4" type="submit" name="modaladdcourse"><i class="fas fa-th-list"></i> Add New Course</button>
    <button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>


 <!--- EDIT COURSE MODAL-------->
 <div class="modal fade" id="Modal2">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Edit Course</h4>
</div>
<form action="../includes/action.php" method="POST">
<div class="modal-body">
    <!-- Admin: Edit Course Section --->
    <div class="row"> <!-- row starts -->
    <div class="col-md-6"> <!-- column 1 starts -->
    <input type="hidden" name="updateid" id="updateid">
    <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" placeholder="Photo">
     </div>
    <div class="form-group mb-3">
      <input type="text" class="form-control mb-2"  name="coursecode" id="coursecode" placeholder="Course Code">
    </div>
    
    <div class="form-group mb-3">
      <input type="text" class="form-control"  name="coursename"  id="coursename" placeholder="Course Name">
    </div>
    
    </div> <!-- column 1 ends -->
    <div class="col-md-6"> <!-- column 2 starts -->
    <div class="form-group mb-3">
      <input type="text" class="form-control mb-2" name="credithour" id="credithour"  placeholder="Credit Hour">
    </div>
    
    <div class="form-group mb-3">
      <input type="text" class="form-control" name="tutor" id="tutor" placeholder="Tutor">
    </div>
    </div> <!-- column 2 ends -->
</div> <!--row ends --->
</div>

<div class="modal-footer">
<div class="text-center">
    <button class="btn btn-sm btn-dark mt-4" type="submit" name="modalupdatecourse"><i class="fas fa-th-list"></i> Update Course</button>
    <button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>
<!---- Modals Section Ends-------->
</main>
<?php require 'admin-dashboard-footer.php';?>

<script>
  $(document).ready(function () {
    $('.editbtn').on('click', function () {
      $trow = $(this).closest('tr');

      var data = $trow.children('td').map(function () {
        return $(this).text();
      }).get();

      console.log(data);

      $('#updateid').val(data[0]);
      $('#coursecode').val(data[2]);
      $('#coursename').val(data[3]);
      $('#credithour').val(data[4]);
      $('#tutor').val(data[5]);
    
 });
  
   });

</script>
 
