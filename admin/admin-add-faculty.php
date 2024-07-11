<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>



    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom mt-5">
      </div>
      <!-- Dashboard Main --->
      <div class="row mt-5">
    <div class="col-md-8">
    <h3 class="fst-italic">List of Tutors </h3> 
</div>
<div class="col-md-4">
<a data-bs-toggle="modal" data-bs-target="#Modal2">
<button type="button" class="btn btn-dark btn-sm fw-bold"> <i class="fas fa-users"></i> Add New Tutor </button>
</a>
</div>
</div>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
<!--Faculty View Section-->
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
<thead class="py-5 bg-dark text-white">
<tr class="text-center">
        <th>#</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th class="text-center">Action</th>
</tr>
</thead>
<tbody class="text-center">

<tr class="py-2">
<!---Retrieving Students from DB--->
<?php 
require '../includes/connection.php';

 $sql = "SELECT * FROM  tbltutor ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){ ?>
 
    <td><?php echo $row['id'];?></td>
    <td><img class="img-profile" src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['firstname'];?>"/></td>
<td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['phone'];?></td>
<td>
<div class="btn-group py-2">
<a href="admin-view-faculty.php?viewfaculty=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm" title="View"> <i class="fas fa-eye"></i> </a>
<a class="text-white mr-2 text-decoration-none btn btn-success btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal4" title="Edit"> <i class="fas fa-marker"></i> </a>
  <a href="../includes/action.php?deletefaculty=<?php echo $row['id'];?>" class="text-white mr-2 text-decoration-none btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this tutor?')";
    title="Delete"><i class="fas fa-trash"></i> </a>
</div>
</td>
</tr>
<?php 
}  
 }
 ?>
</tbody>
</table>
</div>
</div>

<!---Modals Section Starts----->


 <!---EDIT FACULTY MODAL-------->
 <div class="modal fade" id="Modal4">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Update Faculty Record</h4>
</div>
    <!-- Admin: Edit Faculty Section --->
<form action="../includes/action.php" method="POST" enctype="multipart/form-data">
<div class="modal-body">
<input type="hidden" name="updateid" id="updateid" value="<?php echo $row['id'];?>">
     <div class="row"> <!-- row starts -->
     <div class="col-md-6"> <!-- column 1 starts -->
    
     <div class="form-group mb-3">
       <input type="file" class="form-control"  name="photo" id="photo" placeholder="Photo">
     </div>

     <div class="form-group">
       <input type="email" class="form-control" name="email" id="email" required>
     </div> 
    
     </div> <!-- column 1 ends -->
     <div class="col-md-6"> <!-- column 2 starts -->
     <div class="form-group">
       <input type="text" class="form-control" name="phone" id="phone" required>
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modalupdatefaculty">
  <i class="fas fa-users"></i> Update Faculty Record</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>

 <!---ADD NEW FACULTY MODAL-------->
 <div class="modal fade" id="Modal2">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Add New Faculty</h4>
</div>
    <!-- Admin: Add Faculty Section --->
<form action="../includes/action.php" method="POST" enctype="multipart/form-data">
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
     <option value="male">Male</option>
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
     </div>
     </div> <!-- column 2 ends -->
 </div> <!--row ends --->
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modaladdfaculty">
  <i class="fas fa-users"></i> Add Faculty</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
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
      $('#email').val(data[3]);
      $('#phone').val(data[4]);

 });
  

  });

</script>
        