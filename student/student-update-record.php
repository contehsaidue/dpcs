<?php
 require 'studentinit.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Admin: Update Student Record Section --->
      <form  action="../includes/action.php" method="post" enctype="multipart/form-data">
     
    <h1 class="h3 mb-3 fw-normal mt-4 fst-italic">Update Record</h1>
    <input type="hidden" name="updateid" id="updateid" value="<?php echo $row['id'];?>">
    <div class="row"> <!-- row starts -->
    <div class="col-md-6"> <!-- column 1 starts -->
    <div class="form-group mb-3">        
      <input type="text" class="form-control"  name="username" placeholder="Username">
    </div>
    <div class="form-group mb-3">
     <select name="level" class="form-select">
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
      <input type="text" class="form-control"  name="phone" placeholder="Phone Number">
    </div> 
    </div> <!-- column 1 ends -->
    <div class="col-md-6"> <!-- column 2 starts -->
    <div class="form-group mb-3">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-group mb-3">
      <input type="file" class="form-control"  name="photo" placeholder="Photo">
    </div>
    <button class="btn btn-sm btn-dark" type="submit" name="studentupdatestudent">
     <i class="fas fa-upload"></i> Update Record
    </button>
    </div> <!-- column 2 ends -->
    
</div> <!--row ends --->
   
  </form>
   
</main>
<?php include 'student-dashboard-footer.php';?>