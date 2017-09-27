
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
<div class="container" style="color: #fff">








<div class="row" style="margin-top:20px">
<h2 class="panel-heading text-center" style="color: #fff">Please Sign up</h2>

<?php
include "lib/database.php";

$db = new Database ();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $position = $_POST['position'];


   $name = mysqli_real_escape_string($db->link,$name);
  $email = mysqli_real_escape_string($db->link,$email);
  $password = mysqli_real_escape_string($db->link,$password);
  $position = mysqli_real_escape_string($db->link,$position);


  if (empty($name) ||  empty($email) || empty($password) || empty($position)) {
     $msg = "<div class='alert alert-danger'><strong>Error! </strong>Field Must Not Be Empty !</div>";
    echo $msg;
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $msg = "<div class='alert alert-danger'><strong>Error! </strong>Email address invalied !</div>";
    echo $msg;
  }else{
        $addmin_query = "INSERT INTO tbl_admin(name, email, password, position ) VALUES('$name', '$email', '$password', '$position') ";
        $inserted_rows = $db->insert($addmin_query);

        if ($inserted_rows) { ?>
            <div class="panel-heading">
            <div class='panel-heading'><h4 class='alert alert-success'><strong>success! </strong>You Have Registered successfully.</h4></div
         
          </div>
          
      
   <?php }else{
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Registration Failed !</div>";
    echo $msg;
    }



  }
}

?>

					<form action="" method="post">
        		        <div class="body">
        		  
        		        	<!-- username -->
        		        	<label>Username</label>
        		        	<input STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  name="name" class="input-huge" type="text">

                      <label>Position</label>
                      <select name="position" ng-model='discussionsSelect' class='form-control' STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;">

                          <option value='total'>Select Your Position</option>
                          <option value='teacher'>Teacher</option>
                          <option value='student'>Student</option>
                          
                      </select>

        		        	<!-- email -->
        		        	<label>E-mail</label>
        		        	<input STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  name="email" class="input-huge" type="text">
        		        	<!-- password -->
        		        	<label>Password</label>
        		        	<input STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  name="password" class="input-huge" type="text">

        		        </div>
                        <?php

                        if (isset($inserted_rows)) { ?>

                            <div class="panel-heading text-center">
                           
                            <a href="login.php" type="submit"  class="btn btn-success">Login</a>
                        </div>

                      <?php  }else{ ?>
                            <div class=" text-center">
                            <label class="checkbox inline">
                                <input STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;"  type="checkbox" id="inlineCheckbox1" value="option"> I agree to something I will never read
                            </label>
                            <button type="submit"  class="btn btn-success">Register</button>
                        </div>

                       <?php }


                        ?>


        		         
        		   </form>

        		   </div>


        		   </div>


        		   </body>