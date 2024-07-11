<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
           <!-- Feedback Message -->
<?php 
                    if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                            <strong>Admin <?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                        
                    ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong>Admin <?php echo $_SESSION['firstname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
      <div class="row">
    <div class="col-md-8">
    <h3 class="fst-italic">What our head of department is saying... </h3> 
</div>
<div class="col-md-4">
<button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-users"></i> Add Message</button>
</div>
</div>
<!--Student Quote View Section-->
<div class="row">
<div class="col-md-12">
<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead>
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Message</th>
        <th>Name</th>
        <th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<!---Retrieving HOD Message from DB--->
<?php 
require '../includes/connection.php';

// selection all students from database
$sql = "SELECT * FROM tblstudentmessage";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){ ?>
<td><?php echo $row['messageID'];?></td>
<td><img class="img-profile" src="../<?php echo $row['hodimage'];?>" alt="<?php echo $row['messageID'];?>"/></td>
<td><?php echo $row['hodmessage'];?></td>
<td><?php echo $row['hodname'];?></td>
<td class="text-center">
<div class="btn-group">
   <a class="btn btn-danger btn-sm fw-bold" href="controller.php?removemessage=<?php echo $row['messageID'];?>" onclick="return confirm('Do you want to remove this message?')";>Remove <i class="fas fa-trash"></i></a>
</div></td>
</tr>
<?php } 
     
   }
        ?>
</tbody>
</table>
</div>
</div>

<!---Modals Section Starts----->

 <!---ADD HOD Message MODAL-------->
 <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title fw-bold fst-italic">Head of department's Message</h4>
</div>
 <!-- Admin: Add Student Quote Section --->
 <form action="controller.php" method="POST" enctype="multipart/form-data">
<div class="modal-body">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
     <div class="form-group mb-3">
    <input type="file" name="hodimage" class="form-control fst-italic">
     </div>
     </div> <!-- column 1 ends -->
     <div class="col-md-6">
     <div class="form-group mb-3">
       <input type="text" class="form-control fst-italic" name="hodname" placeholder="Enter head of department's name" required>
     </div> 
      </div>
      </div>
      <div class="row">
     <div class="col-md-12"> <!-- column 2 starts -->
     <div class="form-group">
       <textarea type="textarea" class="form-control" cols="5" rows="5" name="hodmessage">
      </textarea>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->

<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4 fw-bold" type="submit" name="modalsubmitmessage"><i class="fas fa-user"></i> Send Message</button>
<button type="button" class="close btn btn-sm btn-danger mt-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>
<!---- Modals Section Ends-------->
</main>


<?php require 'admin-dashboard-footer.php';?>
  </body>
</html>
