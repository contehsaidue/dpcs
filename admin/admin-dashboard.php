<?php 
      require 'admin-dashboard-header.php';
      include 'admin-dashboard-sidebar.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
	  <!-- Dashboard Main --->
 <style type="text/css">
	.panel-body{
		min-height: 15px;
		text-align: center;
   		font-size: 20px; 
	}
</style>
  <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
        <!-- Feedback Message -->
<?php 
            if(isset($_SESSION['status']) && ($_SESSION['type'] == "success"))
            {
                ?>
                    <div class="alert alert-success alert-dismissible fade show fw-bold fst-italic mt-3" role="alert">
                    <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?> </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                  unset($_SESSION['status']);
            }else if (isset($_SESSION['status']) && ($_SESSION['type'] == "error")){
                
            ?>
                    
                    <div class="alert alert-danger alert-dismissible fade show fw-bold fst-italic" role="alert">
                            <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                         unset($_SESSION['status']);
                    }     
                ?>
<!-- Dashboard Main starts-->
<div class="row mt-5">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
     <h6 class="display-6 fw-bold lh-2">Dashboard</h6>
    <div class="row row-cols-1 align-items-stretch g-4 py-3">
    <div class="col-md-4">
</div>
</div>

<div class="row">
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
    <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:8px;font-weight:bold;">
			Students
		</div>
    </div>
		<div class="panel-body" style="color:cyan">
    <span class="content-box-icon text-center text-dark"> <i class="fas fa-users"></i></span>
    <?php
                  require '../includes/connection.php';
                   echo $conn->query("SELECT * FROM tblstudents")->num_rows;
                    ?>
		</div>
<div class="panel-footer py-3" style="background-color:#025eb1;color:#fff;padding:10px;font-weight:bold;"></div>
	</div>
</div>
 
<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:8px;font-weight:bold;">
			Programs
		</div>
		<div class="panel-body" style="color:darkblue">
    <span class="content-box-icon text-dark"> <i class="fas fa-book"></i></span>
    <?php 
                   require '../includes/connection.php';
                   echo $conn->query("SELECT * FROM tblprograms")->num_rows; ?>
				   </div>
		<div class="panel-footer py-3" style="background-color:#025eb1;color:#fff;padding:10px;font-weight:bold;"></div>
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:8px;font-weight:bold;">
			Tutors
      </div>
		</div>
		<div class="panel-body" style="color:green">
    <span class="content-box-icon text-center"> <i class="fas fa-user text-dark"></i></span>
	  <?php
                  require '../includes/connection.php';
                   echo $conn->query("SELECT * FROM tbltutor")->num_rows;
                    ?>
		</div>
		<div class="panel-footer py-3" style="background-color:#025eb1;color:#fff;padding:10px;font-weight:bold;"></div>
	</div>
</div>  


<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
    <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:8px;font-weight:bold;">
			Courses
		</div>
    </div>
		<div class="panel-body" style="color:red">
    <span class="content-box-icon text-center text-dark"> <i class="fas fa-th-list"></i></span>
    <?php 
                    require '../includes/connection.php';
                    echo $conn->query("SELECT * FROM tblcourses")->num_rows; ?>
		</div>
		<div class="panel-footer py-3" style="background-color:#025eb1;color:#fff;padding:10px;font-weight:bold;"></div>
	</div>
</div> <!-- col end -->

</div> <!-- row ends -->
<!-- second row -->
<div class="row">
<div class="col-md-12">
	<h5 class="border-bottom mt-3 fst-italic">Lecturers recently joined...</h5>	
<!---Retrieving Students from DB--->
<div class="row mt-3">
<?php 
require '../includes/connection.php';

 $sql = "SELECT * FROM tbltutor ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
 while ($row = mysqli_fetch_assoc($result)){ ?>
<div class="col-md-3 text-center mb-3 fst-italic">
 <img class="img-profile-tutor" width="42" height="42"  src="../assets/<?php echo $row['photo'];?>" alt="<?php echo $row['firstname'];?>"/>
<h6><?php echo $row['firstname']." ".$row['lastname'];?></h6>
<small><?php echo $row['email'];?></small>
</div>
<?php 
}  
 }
 ?>
  </div>
</div><!-- second row end -->
     
      </div>
    </div>
  </div>
</div>
</div>

</div><!-- row ends -->
<!-- set semester and academic year section-->
<div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2">Set Semester & Academic Year</h6>
    <div class="row row-cols-1 align-items-stretch g-4 py-3">

    <div class="row">
<div class="col-md-6 mt-3">
<!-- category -->
 <div class="panel panel-success mt-4"> 
    <div class="panel-body">
     <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:5px;">
     <h6 class="fst-italic">Set Academic Year</h6> 
     </div>
     <form>
  <div class="form-group mt-3">
  <input type="date" class="form-control"  id="setacademicyear" name="setacademicyear" placeholder="Set Year">
   </div> 
   <div class="btn-group mt-3">
   <button class="btn btn-md btn-success">Set</button>
   <button class="btn btn-md btn-dark">Reset</button>
   </div>
   </form>
</div>
</div>
</div>
<!-- end category -->

<div class="col-md-6 mt-3">
<!-- category -->
<div class="panel panel-success mt-4"> 
    <div class="panel-body">
     <div class="well well-sm text-center" style="background-color:#025eb1;color:#fff;padding:5px;">
     <h6 class="fst-italic">Set semester</h6> 
     </div>
     <form>
  <div class="form-group mt-3">
  <input type="date" class="form-control"  id="setacademicyear" name="setacademicyear" placeholder="Set Year">
   </div> 
   <div class="btn-group mt-3">
   <button class="btn btn-md btn-success">Set</button>
   <button class="btn btn-md btn-dark">Reset</button>
   </div>
   </form>
   </div>
</div>
</div>
</div>


      </div>
    </div>
  </div>
</div>
</div>
</div><!-- row ends -->


  <!-- Message Board -->
  <div class="row">
<div class="col-md-12">
<div class="my-3">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
  <h6 class="display-6 fw-bold lh-2">Message Board <span class="btn-group fst-italic">
<a href="" class="btn btn-sm btn-success"><i class="fas fa-envelope"> </i> send message</a>
<a href="" class="btn btn-sm btn-dark"><i class="fas fa-bell"> </i> view notifications</a>
</span></h6> 
    <div class="row row-cols-13 align-items-stretch g-4 py-5"> 
 
 <?php 
require '../includes/connection.php';
$sql = "SELECT * FROM  tblnews JOIN tbladmin ON tblnews.postauthor = tbladmin.id
ORDER BY news_ID DESC";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
if ($rowCount > 0){
while ($row = mysqli_fetch_assoc($result)){ ?>
<div class="row container">
<div class="col-md-4">
<h6><i class="fas fa-calendar text-primary" style="font-size: 18px"></i>  
  <?php echo date_format(date_create ($row['date_published']),'M d, Y'); ?></h6>
</div>
<div class="col-md-8">
    <div style="padding: 10px;font-size: 20px;font-weight: bold;color: #000;margin-bottom: 5px;">
    <a class="text-decoration-none text-primary" href="index.php?q=singleblog&id=<?php echo $row['news_ID']; ?>">
    <?php echo $row['posttitle'] ;?> 
    </a>
    </div> 
</div>
    <div class="row">
        <div class="col-sm-12">
          <p> <?php echo $row['postcontent']; ?></p> 
        </div>

    <div class="col-sm-12 f-author">
                  <p class="fw-bold"><span class="fa fa-user"></span> Posted By:  <?php echo   
                  $row['firstname'].' '.$row['lastname']; ?>
                  on  <?php echo  date_format(date_create($row['date_published']),"d M Y h:i a"); ?></p>
              </div>
          </div> 
      </div>
            </div>

<?php } 
}
?> 
  </div>
</div>
</div>

</div><!-- row ends -->
  

</main>

<?php require 'admin-dashboard-footer.php';?>
