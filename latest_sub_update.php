

<?php include('includes/header.php');
      include('connection.php');
 ?>
 <style>
     .blog-page{
         margin-left:10px;
     }
 </style>

<!-- Page Header Start -->
<div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-secondary text-uppercase"><strong style="color:white">BLOG PAGE
                    </strong></h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-sm btn-outline-light" href="index.php">Home</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-sm btn-outline-light disabled" href="">BLOG PAGE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Detail Start -->
   
    
  <!-- Detail End -->
<!-- Services Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="container">
        <?php 
               $query = "SELECT * FROM affiliate_tittle";
               $sql   = mysqli_query($conn,$query);
               while($row = mysqli_fetch_array($sql)){
                
            ?>
        <h1 class="display-4 text-center mb-5"><strong style="font-size: 43px;">Why BETA IT Solution is a Leading Blog Page ?
        </strong></h1>
        <!--<p style="text-align:center"><b>  <?php echo $row['sub_tittle']; ?></b></p><?php }?>-->
        <br><br>
        
       <div class="row">

                <?Php
                      $query = mysqli_query($conn,"SELECT * FROM latest_update");
                      $sql   = mysqli_query($conn,"SELECT * FROM latest_update WHERE id ='".$_GET['id']."'");
                      $row   = mysqli_fetch_array($sql);
               { ?>
                <div class="col-lg-12">
                    <div class="position-relative">
                        <a href="#"><img class="img-fluid" style="height:500px; width:1200px;" src="admin/<?php echo $row['image']; ?>" ></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p class="blog-page m-0 p-0 mt-1 ml-4"><?php echo $row['create_at']; ?> | Category : <?php echo $row['category']; ?></p> 
                    <p class="blog-page m-0 p-0 mt-1 ml-4">Developement | By  <?php echo $row['name']; ?></p>
                    <p class="m-3 p-1"><b><?php echo $row['sub_category']; ?></b></p>
                    <p class="m-3 p-1"><?php echo $row['massage']; ?></p>
                    </div>
                 <?php }?>
        </div><br> 
             <br>
    </div>
</div>
<!-- Services End -->
<?php include('includes/fooder.php'); ?>
