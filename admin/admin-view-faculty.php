<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>


  <style type="text/css">
  #img_profile{
    width: 100%;
    height:auto;
  }
    #img_profile >  a > img {
    width: 100%;
    height:auto;
}
  </style>
  	   <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <div class="row">
    <div class="col-md-8">
    <h3 class="page-header">  
    <a href="admin-add-faculty.php" class="btn btn-success btn-xs text-decoration-none"><i class="fas fa-arrow"></i> Back</a> Faculty Information </h3> 
</div>
<div class="col-md-4">
<button class="btn btn-dark btn-md"><i class="fas fa-print"></i> Print Record</button>
</div>
</div>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div> 
      <?php
      include '../includes/connection.php';

      if(isset($_GET['viewfaculty'])){
        $id = $_GET['viewfaculty'];
        $sql ="SELECT * FROM tbltutor WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0){
        while ($row = mysqli_fetch_assoc($result)){ 
     
 ?>
      <div class="row">
      <div class="col-md-3">
          <div class="panel">            
            <div id="img_profile" class="panel-body">
            <a href="" data-target="#myModal" data-toggle="modal" >
            <img title="profile image" class="img-hover"   src="../<?php echo $row['photo'];?>">
            </a>
             </div>
             </div>
            </div>
             <div class="col-md-9">
<table class="table table-striped table-bordered table-hover table-primary table-responsive" style="font-size:14px" cellspacing="0">
<tbody class="text-center">
<tr class="py-2">
<td>Designation </td>
<td><?php echo $row['designation'];?></td>
</tr>
<tr>
<td>Faculty Name </td>
<td><?php echo $row['firstname']." ".$row['lastname'];?></td>
</tr>
<tr>
<td>Gender</td>
<td><?php echo $row['gender'];?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $row['email'];?></td>
</tr>
<tr>
<td>Phone</td>
<td><?php echo $row['phone'];?></td>
</tr>
</tbody>
</table>


        </div>
        <?php } 
        }
     
 }?>
 </main>

<?php require 'admin-dashboard-footer.php';?>
 