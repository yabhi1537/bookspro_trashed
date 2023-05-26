<?php include('connection.php'); ?>
<?php
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

  $data = $google_service->userinfo->get();
  
  // $google_id = trim($data['id']);
  // $f_name = trim($data['given_name']);
  // $l_name = trim($data['family_name']);
  // $email = trim($data['email']);
  // $gender = trim($data['gender']);
  // $picture = trim($data['picture']);

  // require('connection.php');

  // $check_email = $db_connection->prepare("SELECT `email` FROM `google_user` WHERE `email`=?");
  // $check_email->bind_param("s", $email);
  // $check_email->execute();
  // $check_email->store_result();

  // if($check_email->num_rows === 0){
  //   # Inserting the new user into the database
  //   $query_template = "INSERT INTO `google_user` (`oauth_uid`, `first_name`, `last_name`,`email`,`profile_pic`,`gender`) VALUES (?,?,?,?,?,?)";
  //   $insert_stmt = $db_connection->prepare($query_template);
  //   $insert_stmt->bind_param("sssssss", $google_id, $f_name, $l_name, $email, $gender, $picture);
  //   if(!$insert_stmt->execute()){
  //     echo "Failed to insert user.";
     
  //   }
  // }
  // header('location:index.php');
 



  if(!empty($data['given_name']))
  {
   $givename = $data['given_name'];

  }

  if(!empty($data['family_name']))
  {
    $familyname = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $email = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $gender = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $picture = $data['picture'];
  }

 
//   $sql = "INSERT INTO google_user (name, lastname, googleemail,gender,imagelink) VALUES
//   ('".$data['given_name']."','".$data['family_name']."','".$data['email']."','".$data['gender']."','".$data['picture']."')";
//   mysqli_query($con , $sql);

$sql = "INSERT INTO `google_user` ( `first_name`, `last_name`,`email`,`profile_pic`,`gender`) VALUES ($givename, $familyname,$email,$picture,$gender)";
mysqli_query($con , $sql);
 }

}



if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}
?>
<?php 

   //session_start();
   
   if (isset($_POST['submit'])) {
   	
     $email  = $_POST['email'];
     $password = $_POST['password'];

     $check = "SELECT * FROM registration where email ='$email' AND password ='$password'";

     $query = mysqli_query($conn,$check);
     $row   = mysqli_fetch_array($query);
     $ret = mysqli_num_rows($query);
        if($ret > 0){
     		$_SESSION['userid'] = $row['id'];
    //  		print_r($_SESSION['userid']);die();
            header('location:index.php');
        }else{
            $_SESSION['msg'] = "Wrong Username & Password";
    		//header('location:login.php');
        }

     

   }
   

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/login/css/my-login.css">
	<style type="text/css">
		body { 
	margin-top: 110px; 
    
}  
form{
	width: 360px;
}
.forgo{
	margin-left: 9rem!important;
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
		
							<h4 class="card-title text-center">Login</h4>
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
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot_password.php" class="forgo">
											Forgot Password?
										</a>
									</label>
                                     
									<input id="password" type="password" class="form-control" name="password" required data-eye>
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
										Login
									</button>
								</div>
			
							</form>
							<a href="signup.php" class="btn btn-success btn-block bth">
										SingUp
							</a>
						</div>
						
   
   <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<button class="btn btn-lg btn-google btn-block text-uppercase btn-outline" href="#"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> '.$login_button . '</button>';

   }
   ?>
                              
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
