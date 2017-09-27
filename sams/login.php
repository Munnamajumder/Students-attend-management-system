<?php
include "lib/session.php";
Session::checklogin();
?>

<?php
include "helpers/format.php";
include "config/config.php";
include "lib/Database.php";

?>

<?php
$db = new Database();
$fm = new format();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Management system</title>
	<link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css">
	<script type="text/javascript" src="inc/jquery.min.js"></script>
	<script type="text/javascript" src="inc/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="colors/theme-color.css">
   <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fredoka+One">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">

  <!-- Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="fonts/map-icons/css/map-icons.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/icomoon/style.css">

	<link rel="icon" href="img/USTC.jpg">




</head>
<body style="background: url(img/4.jpg); height: 100%; width: 100%;">
<div class="container">


<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">


	
	<h2 style="color: #fff">Please Sign In</h2>


<?php
		if($_SERVER['REQUEST_METHOD'] =='POST'){
			    $email =$fm->validation($_POST['email']);
				$password = $fm->validation(md5($_POST['password']));
				
				$email = mysqli_real_escape_string($db->link,$email);
				$password = mysqli_real_escape_string($db->link,$password);
					
				$query = "select * from tbl_admin where email = '$email' and password = '$password'";
				
				$result = $db->select($query);
					if($result != false){
					$value = mysqli_fetch_array($result);
					$row = mysqli_num_rows($result);
					if($row > 0){
						session::set('login',true);
						session::set('email',$value['email']);
						session::set('password',$value['password']);
						session::set('position',$value['position']);
						header("location:index.php");
						
							}else{
								echo "No result founnd !!!";
								}
					}else{
				
						 $error = "<div class='alert alert-danger'><strong>Sorry! </strong>Email and Password Doesn't Match !</div>";
              			 echo $error;
						}
						

					}

	?>
		<form action="login.php" method="post">
			<fieldset style="color: #fff">
			
				<hr class="colorgraph">
				<div class="form-group">
				<label>E-mail</label>
                    <input type="email" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  name="email" id="email" class="" placeholder="Email Address">
				</div>
				<div class="form-group">
				<label>Password</label>
                    <input type="password" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  name="password" id="password" class="" placeholder="Password">
				</div>
				<span class="button-checkbox">
					<button type="button" class="btn btn-info" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
					<a href="#" class="btn btn-danger pull-right">Forgot Password?</a>
				</span>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="register.php" class="btn btn-lg btn-primary btn-block">Register</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>




</div>

</body>
</html>



