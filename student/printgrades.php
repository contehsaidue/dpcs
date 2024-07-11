
<?php
  require 'studentinit.php';

?>



<!-- Custom style for result Print image -->
<style>
 .result-logo{
   margin-top: 1.0rem;
   margin-bottom: 1.0rem;
   margin-right: 1.0rem;
   width: 10rem;
   height:8rem;
   border-left:2px solid;
 }
 </style>

</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
      <div class="result-header py-4" style="border: 3px solid;">
      <img class="pull-right result-logo" src="<?php echo web_root;?>image/nulogo.jpeg" alt="nulogo">
        <h4 class="text-center">NJALA UNIVERSITY</h4>
        <h5 class="text-center">Office of the Registrar - Secretariat</h5>
        <h6 class="text-center">Njala Campus - Sierra Leone</h6>
        <h6 class="text-center">Call: 078 701 222 | Email: registrar@njala.edu.sl</h6>
            </div>
      </div>
      <!-- /.col -->
    </div>

  <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header text-uppercase text-center">
            Individual Progress Report - 2021/2022 Academic Year
            </h2>
        </div> 
      </div> 
<?php
if (isset($_POST['IDNO'])) {
  # code...
   $stud = New Student();
   $resstud = $stud->single_student($_POST['IDNO']);

   $course = New Course();
   $rescourse = $course->single_course($resstud->COURSE_ID);
   
}
 

?> 
       <div class="container">
        <table style="max-width:100%" cellpadding="4" cellspacing="2" class="table">
          <thead>
            <th><label>NAME:</label></th><th><label><?php echo  $resstud->LNAME .' ' . $resstud->FNAME .' ' . $resstud->MNAME;?></label></th> 
            <th></th>
            <th>PROGRAM OF STUDENT: </th><th><?php echo $rescourse->COURSE_DESC; ?></th>
            </thead>
           <thead> 
            <th><label>ID. NO:</label></th><th><label><?php echo $_POST['IDNO'];?></label></th> 
            <th></th>
            <th>Year:</th><th><?php echo $_POST['YEARLEVEL'] ?></th>
            </thead>
        </table>
      </div>
   


      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
        <table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
          <thead>
            <tr>
              <th>
               <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
              
               COURSE CODE</th>
              <th>COURSE DESCRIPTION</th> 
              <th>CREDIT HOURS</th> 
              <th>GRADE EARNED</th> 
         
            </tr> 
          </thead> 
          <tbody>
       <?php  
          
         $sql = "SELECT * FROM `tblstudent` st, `grades` g,`subject` s ,'studentsubjects' ss
            WHERE st.`IDNO`=g.`IDNO` AND g.`SUBJ_ID`=s.`SUBJ_ID` AND s.`SUBJ_ID`=ss.`SUBJ_ID` 
            AND g.`IDNO`=ss.`IDNO` AND ss.`SEMESTER`='".$_POST['SEMESTER']."' AND st.'LEVEL'='".$_POST['YEARLEVEL']."' 
            AND IDNO ='".$_POST['IDNO']."'";
              $mydb->setQuery($sql);
              $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
              echo '<tr>'; 
             echo '<td>'.$result->SUBJ_CODE.'</td>';
              echo '<td>'.$result->SUBJ_DESCRIPTION.'</td>';
              echo '<td>' .$result->UNIT.'</td>'; 
              echo '<td>'.$result->REMARKS.'</td>'; 
              echo '<td>'. $result->SEMESTER.'</td>'; 
              echo '</tr>';
            } 
      ?>
          </tbody>
          
        </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

        </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>