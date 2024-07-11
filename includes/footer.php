

<!-- Footer section starts-->
<footer class="footer_section bg-dark">
  <div class="row align-items-center">
    <!--Column starts-->
<div class="col-md-4">
<h4 class="text-uppercase footer-title">Our Location</h4>
<p> <i class="fas fa-map-marker"></i> Njala University, Njala Campus <br>
Moyamba Mokonde - Southern Province<br>
Sierra Leone</p>
</div>
<div class="col-md-4">
<h4 class="text-uppercase footer-title">Contact us</h4>
<a href="mailto:departmentofphysics&compsci@njala.edu.sl" class="text-decoration-none text-light"><i class="fas fa-envelope social-icon"></i> Mail us</a>
<p><i class="fas fa-phone"></i> +23277028023</p>
</div>
<div class="col-md-4">
<h4 class="text-uppercase footer-title">Connect with us</h4>
<div class="social-icons text-center">
                        <a class="social-icon" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-youtube"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-linkedin"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-twitter"></i></a>
                    </div>
<div>
 <p></p>
</div>
</div>
<!--Column ends-->
</div>
</footer>
<div class="footer-sidenote bg-dark">
<p class="text-align-center fw-bold"> &copy; <?php echo date('Y');?> <br>Department of Physics & Computer Science, Njala University.</p>
</div>
<!--Footer section ends-->

<!--Bootstrap Javascript Files-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/jquery-3.3.0.min.js"></script>

</body>
</html>


<!-- Modals -->

<!-- Student Registration Modal -->
<div class="modal fade" id="modalstudentreg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title"> 
    <img src="../assets/images/nulogo.jpeg" width="40" height="32"> Student Registration Portal</h5>
      </div>
      <!-- Modal Body -->
      <form action="student/controller.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
       <small class="fst-italic text-muted"> student ID is the same as student username for login</small>
       <input type="text" class="form-control"  name="studentid" placeholder="Student ID" required>
     </div>
    
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
     </div>
     
     <div class="form-group mb-3">
       <input type="text" class="form-control"  name="middlename" placeholder="Middle Name">
     </div>
     
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
     </div>
     <div class="form-group mb-3">
     <select name="gender"  class="form-select" required>
     <option selected>Gender</option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     </select>
     </div>
     </div> <!-- column 1 ends -->

     <div class="col-md-6"> <!-- column 2 starts -->
     <div class="form-group mb-3">
     <select name="level" class="form-select" required>
     <option selected>Level</option>
     <?php 
     
     include 'includes/connection.php';
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
     include 'includes/connection.php';
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
       <input type="password" class="form-control"  name="password" placeholder="Password">
     </div>
   
     <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" placeholder="Photo" required>
     </div>
     <div class="form-group mb-3">
       <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->

      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-sm fw-bold" type="submit" name="studentregister">Student Register <i class="fas fa-users"></i></button>
        <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Close</button>
      </div>
</form>

    </div>
  </div>
</div>

<!-- Faculty Registration Modal -->
<div class="modal fade" id="modalfacultyreg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title"> 
        <img src="../assets/images/nulogo.jpeg" width="40" height="32">  Faculty Registration Portal</h5>
      </div>
      <!-- Modal Body -->
      <form action="tutor/controller.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="username" placeholder="Username" required>
     </div>
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
     </div>  
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
     </div>
     <div class="form-group mb-3">
       <input type="text" class="form-control" name="designation" placeholder="Designation" required>
     </div>
     <div class="form-group mb-3">
       <input type="password" class="form-control" name="password" placeholder="Password" required>
     </div>
     </div> <!-- column 1 ends -->
    
     <div class="col-md-6"> <!-- column 2 starts -->
     <div class="form-group mb-3">
     <select name="gender"  class="form-select"  required>
     <option >Gender</option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
         </select>
     </div>
      <div class="form-group mb-3">
       <input type="email" class="form-control" name="email" placeholder="Email" required>
     </div>
     <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" placeholder="Photo">
     </div>
     <div class="form-group mb-3">
       <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-sm fw-bold" type="submit" name="facultyregister">Faculty Register <i class="fas fa-users"></i></button>
        <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Close</button>
      </div>
</form>

    </div>
  </div>
</div>


<!-- Admin Login Modal -->
<div class="modal fade" id="modaladminlogin">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">Admin Login Portal</h5>
</div>
<form action="admin/controller.php" method="POST">
<div class="modal-body text-center">
<img src="assets/images/nulogo.jpeg" width="70" class="mb-3" height="57">
 <div class="form-group mb-3">
      <input type="text" class="form-control" name="username"  placeholder="Username">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

</div>
<div class="modal-footer">
  <button class="btn btn-success btn-sm fw-bold" type="submit"  name="adminlogin">Login</button>
  <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

<!-- Tutor Login Modal -->
<div class="modal fade" id="modalfacultylogin">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">Faculty Login Portal</h5>
</div>
<form action="tutor/controller.php" method="POST">
<div class="modal-body text-center">
<img src="assets/images/nulogo.jpeg" width="70" class="mb-3" height="57">
 <div class="form-group mb-3">
      <input type="text" class="form-control" name="username"  placeholder="Username">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

</div>
<div class="modal-footer">
  <button class="btn btn-success btn-sm fw-bold" type="submit"  name="tutorlogin">Login</button>
  <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>


<!-- Student Login Modal -->
<div class="modal fade" id="studentlogin">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">Student Login Portal</h5>
</div>
<form action="student/controller.php" method="POST">
<div class="modal-body text-center">
<img src="assets/images/nulogo.jpeg" width="70" class="mb-3" height="57">
 <div class="form-group mb-3">
      <input type="text" class="form-control fst-italic fw-bold" name="username" placeholder="Student ID">
    </div>
    <div class="form-group">
      <input type="password" class="form-control fst-italic fw-bold" name="password" placeholder="Password">
    </div>

</div>
<div class="modal-footer">
  <button class="btn btn-success btn-sm fw-bold" type="submit"  name="studentlogin">Login</button>
  <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
