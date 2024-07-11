<?php include 'includes/header.php';?>

<!-- Faculty Database area  starts -->
<div class="row mx-5">
<div class="col-md-12">
<div class="my-5">
    <div class="row p-4 pb-0 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">Department of Physics & Computer Science Faculty Database </h6> 
    <div class="row row-cols-1 align-items-stretch g-4 py-5">

     <!-- Faculty -->

<?php 
         include 'includes/connection.php';

        $query = mysqli_query($conn, "SELECT * FROM tbltutor");
           foreach ($query as $result) { ?> 

<div class="col-md-3 mb-3">  
 <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
      <div class="well well-sm text-center bg-dark p-2 text-light">
              <b><?php echo $result['designation'].' '.$result['firstname'].' '.$result['lastname']; ?></b> 
      </div>
         <img src="assets/<?php echo $result['photo'];?>" class="facultydb-img">
         <div class="panel-footer fst-italic fs-small">
      <h5 class="text-center"><i class="fa fa-envelope fa-fw text-primary"></i> <?php echo $result['email'];?></h5>
      <h5 class="text-center"><i class="fa fa-phone fa-fw text-primary"></i> <?php echo $result['phone'];?></h5>
           </div>
           <!--<div class="text-center">
           <button type="button" class="btn btn-md btn-success">View <i class="fas fa-eye"></i></button>
           </div>-->
         </div>
 </div>

        </div> <!-- column ends -->
   <?php 
           }?>
 
<!-- end faculty -->
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->


<!--Bootstrap Javascript Files-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.3.0.min.js"></script>