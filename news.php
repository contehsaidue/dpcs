<?php require 'includes/header.php';
?>
<style type="text/css"> 
#title-header {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    margin-bottom: 30px;
}
#title-header > .title  {
    width: 1050px;
    margin-left: 150px;
}
/*#title-header > .title  > img {
    width: 100%;
    height: 130px;
}*/
#title-header > .title  > p {
    width: 100%;
    height: 130px;
    font-family: "Arial";
    font-size: 90px;
    text-align: center;
}
.f-author {
     /*border-top: 1px solid #eee;*/
     padding: 5px;
}
.mg-available-rooms {
    border-bottom: 1px solid #ddd;
    /*border-top: 1px solid #ddd;*/
    margin-bottom: 20px;
}
.mg-available-rooms  .s-content{ 
    text-align: center;
    padding: 20px;
}
  
@media only screen and (max-width: 768px){
    #title-header > .title  {
        margin: 0px;
        padding: 0px; 
        height: 90px;
        width: 100%;
    }
  /*  #title-header > .title  >img {
        width: 100%;
        height: auto;
    }*/
      #title-header > .title  >p {
        width: 100%; 
        font-size: 50px;
    }


 
}
</style>  

<!-- Faculty -->
<div class="row container mt-5">
<div class="col-md-3"> 
   <?php require 'includes/sidebar.php'; 
   ?>
</div>

<div class="col-md-9">
 <?php 
         require 'includes/connection.php';
         $sql = "SELECT * FROM  tblnews JOIN tbladmin ON tblnews.postauthor = tbladmin.id
          ORDER BY news_ID DESC";
            $query = mysqli_query($conn, $sql);
            foreach ($query as $result) {?>
     <div class="mg-available-rooms col-lg-12">
                <div class="mg-avl-rooms">
                    <div class="mg-avl-room">
                        <div class="row">
                            <div class="col-sm-4 s-content" >
                                <span class="fas fa-calendar text-primary" style="font-size: 55px"></span>  
         					<h5 class="mg-sec-left-title"><?php echo date_format(date_create ($result['date_published']),'M d, Y'); ?></h5>
                            </div>
                            <div class="col-sm-8">
                                <div style=" padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                                <a class="text-decoration-none text-primary" href="index.php?q=singleblog&id=<?php echo $result['news_ID']; ?>">
                                <?php echo $result['posttitle'] ;?> 
                                </a>
                                </div> 
                                <div class="row contentbody">
                                    <div class="col-sm-12">
                                      <p> <?php echo  $result['postcontent']; ?></p> 
                                    </div>
                                
                                    <div class="col-sm-12 f-author">
                                        <p class="fw-bold"><span class="fa fa-user"></span> Author :  <?php echo   
                                        $result['firstname'].' '.$result['lastname']; ?>
                                         on  <?php echo  date_format(date_create($result['date_published']),"d M Y h:i a"); ?></p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
          <?php } ?> 

</div> 
</div>

<!-- end news section -->

<?php include 'includes/footer.php';?>