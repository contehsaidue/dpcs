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
    <h3 class="fst-italic">Departmental Updates </h3> 
</div>
<div class="col-md-4">
<button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#Modal1"><i class="fas fa-envelope"></i> Add News</button>
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
	 		    
           <form action="../inlcudes/action.php" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead class="text-center">
				  	<tr> 
				  		 <th>Title</th>
				  		<th>Body</th>
				  	 	<th>Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody class="text-center">
				  	<?php   
              require '../includes/connection.php';
				  	  $sql = "SELECT * FROM  tblnews ORDER BY news_ID DESC";
              $query = mysqli_query($conn, $sql);
              foreach ($query as $result) {?>
				  		<tr> 
				  		<td> <?php echo $result['posttitle'];?></td>
				  		<td> <?php echo $result['postcontent'];?></td>

				  	  <td>
                <div class="btn-group">
              <a class="text-white mr-2 text-decoration-none btn btn-dark btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#Modal3" title="Edit">Edit <i class="fas fa-marker"></i> </a>
				  					 <a title="Delete" href="../includes/action.php?deletenews=<?php echo $result['news_ID'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to remove this post?')";><i class="fas fa-trash"></i> Remove</a>
              </div>
                    </td>
              </tr>
             <?php		
				  	} 
				  	?>
				  </tbody>
					</table>

			</div>
				</form> 


<!---Modals Section Starts----->

 
 <!---ADD NEWS MODAL-------->
 <div class="modal fade" id="Modal1">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Post News</h4>
</div>
<form action="../includes/action.php" method="POST">
<div class="modal-body">
<div class="row">
 <div class="col-md-6">
 <div class="form-group mb-2">
 <input class="form-control input-sm"  name="posttitle" placeholder="Title" type="text" value="">
  </div>
  </div>
  <div class="col-md-6">
 <div class="form-group mb-2">
 <input class="form-control input-sm"  name="postauthor" type="hidden" value="<?php echo $_SESSION['id']; ?>" readonly>
  </div>
  </div>
 </div>
 <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <textarea  class="form-control input-sm" name="postcontent" placeholder= "Body" rows="12" cols="60"></textarea>
  </div>
  </div>
         </div>  
<div class="modal-footer">
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modaladdnews"><i class="fas fa-plus-circle"></i> Post News</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
     </div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>


 
 <!---EDIT NEWS MODAL-------->
 <div class="modal fade" id="Modal3">
<div class="modal-dialog modal-lg">

<!--- Modal Content --------->
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title">Edit News</h4>
</div>
<form action="../includes/action.php" method="POST">
<div class="modal-body">
<input type="hidden" name="updateid" id="updateid" value="<?php echo $row['news_ID'];?>">
<div class="row">
 <div class="col-md-6">
 <div class="form-group mb-2">
 <input class="form-control input-sm" id="posttitle" name="posttitle" placeholder="Title" type="text" value="">
  </div>
  </div>
 <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <textarea  class="form-control input-sm" id="postcontent" name="postcontent" placeholder= "Body" rows="12" cols="60"></textarea>
  </div>
  </div>
         </div>  
<div class="modal-footer">
  <div class="btn-group py-2">
<button class="btn btn-sm btn-dark mt-4" type="submit" name="modalupdatenews"><i class="fas fa-plus-circle"></i> Update News</button>
<button type="button" class="close btn btn-sm btn-danger mt-4" data-bs-dismiss="modal">Cancel</button>
          </div>
</div>
     </form>
</div> <!-- End of content area ------>
</div>
</div>


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
      $('#posttitle').val(data[1]);
      $('#postcontent').val(data[2]);
    
 });
  
   });

</script>

 
