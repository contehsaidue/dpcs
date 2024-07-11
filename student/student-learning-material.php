<?php
 require 'student-dashboard-header.php';
 require 'student-dashboard-sidebar.php';
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-md-3 pt-5 mt-3 border-bottom">
      </div>
      <div class="row">
<div class="col-md-12">
<div class="my-5">
    <div class="row p-4 pb-0 pe-lg-3 align-items-center rounded-3 border shadow-lg">
      <div class="p-3 pt-lg-3">
        <h6 class="display-6 fw-bold lh-2">My Notes</h6>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
     <table class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
 <thead class="text-center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Course Name</th>
            <th scope="col" >Tutor</th>
            <th scope="col" class="d-none d-md-block">Semester</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody class="text-center">
          <tr>
          <?php 
          require '../includes/connection.php';
          $i = 1; // loops iteration in table
          $prog = $_SESSION['program'];
          $level = $_SESSION['level'];
          
           $sql = "SELECT * FROM tblcoursematerial 
           JOIN tbltutor ON tbltutor.id = tblcoursematerial.tut_ID
           JOIN tblprograms ON tblcoursematerial.prog_ID = tblprograms.prog_ID
           JOIN tbllevel ON tbllevel.level_ID = tblcoursematerial.level_ID
           JOIN tblsemester ON tblsemester.sem_ID = tblcoursematerial.sem_ID
           WHERE tblprograms.prog_ID = '$prog' AND tbllevel.level_ID = '$level' ORDER BY tblcoursematerial.sem_ID";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
          if ($rowCount > 0){
           while ($row = mysqli_fetch_assoc($result)){ 
         $i;?>
          
            <th scope="row"><?php echo $i++;?></th>
            <td><?php echo $row['matname'];?></td>
            <td><?php echo $row['designation']." ".$row['firstname']." ".$row['lastname'];?></td>
            <td class="d-none d-md-block"><?php echo $row['semester_Name'];?></td>
            <td>
            <div class="btn-group py-2">
            <a href="../assets/<?php echo $row ['matcontent'];?>" class="text-white mr-2 text-decoration-none btn btn-dark btn-sm" title="View" target="_blank"><i class="fas fa-eye"></i> </a>
            <a href="../assets/<?php echo $row ['matcontent'];?>" download class="text-white mr-2 text-decoration-none btn btn-success btn-sm editbtn"  title="download"><i class="fas fa-download"></i> </a>
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

     
      </div>
    </div>
  </div>
</div>
</div>

</div>
</main>
<?php include 'student-dashboard-footer.php';?>
