<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Dashboard Main --->
      <div class="row">
    <div class="col-md-8">
    <h3 class="page-header fst-italic">List of programs </h3> 
</div>
<div class="col-md-4">
   <button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-book"></i> Add New Program</button>
   <button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-print"></i> Print Program List</button>
</div>
</div>
<div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }     
                ?>
<!--Program View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Program</th>
            <th scope="col">Action</th>
          </tr>
 </thead>
          <tbody class="text-center">
          <tr>
 <!--- PHP Code to retrieve courses from DB--->
  <?php
  include '../includes/connection.php'; 

 // query to retrieve courses from system database
          
      $sql = "SELECT * FROM `tblprograms`"; 
      $result = mysqli_query($conn, $sql);
      // checking query status inside DB
          if(!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){ ?> <!--Closes while loop to enter HTML --->
            <td><?php echo $row['prog_ID'];?></td>
            <td><?php echo $row['program_Name'];?></td>
            <td>
            <div class="btn-group py-2">
<a class="text-white mr-2 text-decoration-none btn btn-dark btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal2" title="Edit"><i class="fas fa-marker"></i></a>
  <a href="admin-add-student.php?del=<?php echo $row['prog_ID'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this student?')";
    title="Delete"><i class="fas fa-trash"></i></a>
</div>
</td>
          </tr>
        
    
     <?php } 
     
        }
        ?>

</table>
</div>
</div>

<!---Modals Section Starts----->

 
 <!---ADD PROGRAM MODAL-------->
 <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add New Program</h4>
</div>
<form action="../includes/action.php" method="POST">
<div class="modal-body">
    <!-- Admin: Add Program Section --->
    <div class="row"> <!-- row starts -->
    <div class="col-md-12"> <!-- column 1 starts -->
    <div class="form-group">
      <input type="text" class="form-control"  name="program" placeholder="Program Name">
    </div>

    </div> <!-- column 1 ends -->
  
</div> <!--row ends --->  
</div>

<div class="modal-footer">
<div class="text-center">
    <button class="btn btn-sm btn-dark mt-4 fw-bold" type="submit" name="modaladdprogram"><i class="fas fa-plus-circle"></i> Add New Program</button>
    <button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
    </div>
     </div>
     </form>
</div> <!-- End of content area ------>

</div>
</div>


 <!--- EDIT PROGRAM MODAL-------->
 <div class="modal fade" id="Modal2">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Edit Program</h4>
<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
</div>
<form action="../includes/action.php" method="POST">
<div class="modal-body">
    <!-- Admin: Edit Course Section --->
    <div class="row"> <!-- row starts -->
    <div class="col-md-12"> <!-- column 1 starts -->
    <div class="form-group mb-3">
      <input type="text" class="form-control"  id="program" name="program" placeholder="Program Name">
    </div>
</div>
</div> <!--row ends --->
 
   
</div>

<div class="modal-footer">
<div class="text-center">
    <button class="btn btn-md btn-dark mt-4" type="submit" name="modalupdateprogram"><i class="fas fa-plus-circle"></i> Update Program</button>
    <button type="button" class="close btn btn-md btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
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
      $('#program').val(data[1]);
    
 });
  
   });

</script>
