<?php require 'faculty-dashboard-header.php';
require 'faculty-dashboard-sidebar.php';?>
 

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
      <!-- Student Profile --->
    <div class="row">
    <div class="col-md-6">
    <div class="panel panel-default border-rounded"> 
    <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="color:#fff;padding:8px;">
              <b><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></b> 
      </div>
      <img class="figure-img img-fluid rounded profile-image" width="100%" height="100" role="img" src="../assets/<?php echo $_SESSION['photo'];?>">
         </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="panel-body">
      <div class="well well-sm text-center bg-success" style="color:#fff;padding:8px;">
              <b><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></b> 
              - <span class="fst-italic">Personal Records</span>
      </div>
      <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
          <tbody>
          <tr>
            <th scope="row">Username</th>
            <td><?php echo $_SESSION['username'];?></td>
          </tr>
          <tr>
            <th scope="row">First Name</th>
            <td><?php echo $_SESSION['firstname'];?></td>
          </tr>
            <th scope="row">Last Name</th>
            <td><?php echo $_SESSION['lastname'];?></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?php echo $_SESSION['email'];?></td>
          </tr>
          <tr>
            <th scope="row">Phone</th>
            <td><?php echo $_SESSION['phone'];?></td>
          </tr>
          </tbody>
        </table>
        </div>
        </div>
        </div>
        <button class="btn btn-sm btn-success" name="facultyupdaterecord">Update Record</button>
        </div> <!-- row ends --->

</main>

<?php require 'faculty-dashboard-footer.php';?>