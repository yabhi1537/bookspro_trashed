<?php include('connection.php'); ?>

<?php
session_start();
if (isset($_POST['submit'])) {
// include 'dbconfig.php';

// $username = $_POST['username'];
        $password     = $_POST['password'];
        $newpassword  = $_POST['newpassword'];
        $cpassword    = $_POST['cpassword'];
        $result = "SELECT * FROM registration WHERE password='$password'";
        //print_r($result);die();
        $query = mysqli_query($conn,$result);
        $row   = mysqli_fetch_array($query);
        $ret = mysqli_num_rows($query);

        if(!$ret){
           echo '<script type="text/javascript">alert("The password you entered does not exist")</script>';
		   echo "<script>location.href='forgot_password.php'</script>";
        }
           if($newpassword==$cpassword){

              $sql = "UPDATE registration SET password='$newpassword' where password='$password'";
              $mysql = mysqli_query($conn,$sql);
			  
               if($mysql==true){
                  echo '<script type="text/javascript">alert("Congratulations You have successfully changed your password")</script>';
                  echo "<script>location.href='login.php'</script>";
               }
               else{
                	echo '<script type="text/javascript">alert("Passwords do not match")</script>';
				   echo "<script>location.href='forgot_password.php'</script>";
				  
               }
            }
        else if($password!= mysql_result($result, 0)){
        	 echo '<script type="text/javascript">alert("You entered an incorrect password")</script>';
			 echo "<script>location.href='forgot_password.php'</script>";
        }
        

   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Forgot Password Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/login/css/my-login.css">
	<style type="text/css">

body { 
	margin-top: 110px; 

}  
form{
	width: 350px;
}
.bth{
	margin-top: 6px;
}
   
	</style>
</head>

<body class="my-login-page">
	<section class="h-100">   
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<!-- <p>Admin Panel</p> -->
						<!-- <img src="img/logo.jpg" alt="logo"> -->
					</div>
					<div class="card fat">
						<div class="card-body">
		
							<h4 class="card-title text-center">Forgot Password</h4>
							<form method="POST" class="my-login-validation" novalidate="">
		                      <?php 
                                  if(isset($_SESSION['msg'])){ ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
            	                         <button class="close" type="button" data-dismiss="alert">×</button>
                                         <?php echo $_SESSION['msg']; ?>
                                   </div>
                               <?php 
                               unset($_SESSION['msg']);
                               } ?>
                                
								<div class="form-group">
									<label for="email">Old Password</label>
									<input id="password" type="password" class="form-control" name="password" value="" required autofocus>
									<div class="invalid-feedback">
										Password is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="email">New Password</label>
									<input id="newpassword" type="password" class="form-control" name="newpassword" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
                                 </div>
                                 <div class="form-group"> 
                                    <label for="email">Confirm Password</label> 
									<input id="cpassword" type="password" class="form-control" name="cpassword" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="submit" class="btn btn-primary btn-block">
										Update
									</button>
								</div>
								
							</form>
							<a href="login.php" class="btn btn-success btn-block bth">
										Back
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
