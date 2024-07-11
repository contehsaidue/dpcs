<!-- search -->  
<div class="panel panel-default mb-3">
    <div class="panel-body">
     <form action="index.php?q=product" method="post">
       <div class="input-group custom-search-form">
            <input type="search" class="form-control fst-italic fw-bold" name="search" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-dark" id="btnsearch" name="btnsearch" type="submit" style="color:#fff;padding:8px;">
                    <i class="fa fa-search text-white"></i>
                </button>
            </span>
        </div>
    </form>

    </div> 
</div> 
<!-- end serch -->

<!-- category -->
 <div class="panel panel-default"> 
    <div class="panel-body">
    <div class="list-group mb-3">
     <div class="well well-sm text-center bg-dark" style="color:#fff;padding:8px;">
     <b> Recent News</b> 
     </div>
        <ul>
        <?php 
         require 'includes/connection.php';
         $sql = "SELECT * FROM  tblnews ORDER BY news_ID DESC";
            $query = mysqli_query($conn, $sql);
            foreach ($query as $result) {?>
            <li><a class="text-decoration-none text-dark" href="news.php?<?php echo $result['news_ID'];?>"><?php echo $result['posttitle'];?></a></li>
        
            <?php		
				  	} 
				  	?>
         </ul>
      </div> 
   </div> 
</div>
<!-- end category -->


<!-- login -->

 <div class="panel panel-default">
    <div class="panel-body">
        <div class="well well-sm text-center mb-3 bg-dark" style="color:#fff;padding:8px;"><b>Student Portal </b> </div>
<form class="form-horizontal span6" action="studentlogin-handler.php" method="POST">
                <div class="form-group">
                  <div class="col-md-12">
                          <input id="username" name="username" placeholder="Username" type="text" class="form-control input">  
                  </div> <br>
 
                  <div class="col-md-12 mb-3">
                     <input name="password" id="password" placeholder="Password" type="password" class="form-control input">
             
                  </div> 
                  </div>
                  <div class="form-group text-center mb-3">
                  <div class="col-md-12"> 
                    <button type="submit" id="sidebarLogin" name="studentlogin"   class="btn btn-md btn-dark fw-bold btn-block">Login</button> 
                     
                  </div>
                </div>


            </form>

        </div> 
</div>
