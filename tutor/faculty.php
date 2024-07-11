
<?php 
require 'includes/faculty-db-header.php';
?>

    <div class="container mt-4">
      <div class="row">
<?php 
require 'includes/session.php';
require 'includes/connection.php';

$sql = "SELECT * FROM facultyregister";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{?>
        <div class="col-md-3 border-right no-gutters mt-4 mb-2">
          <div class="card text-center w-100">
          <img class="card-img-top" src="<?php echo $row['photo'];?>" alt="faculty members" width="auto" height="200" />
            <div class="card-body">
                <h4 class="card-title text-muted"> <i class=""></i> 
                <?php echo $row['designation']." ". $row['firstname']." ".$row['lastname'];?></h4>
                <h5 class="text-small"> <?php echo $row['email'];?></h5>
                <h6 class="text-small-dark"><?php echo $row['phone'];?></h6>
</div>
            </div>
</div>
            <?php 
  }?>
          </div>
        </div>
       

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#" class="text-decoration-none text-dark">Back to top</a>
  </div>
</footer>

</section>

<!--Bootstrap Javascript Files-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.3.0.min.js"></script>
</body>
</html>