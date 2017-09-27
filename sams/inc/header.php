<?php
include "lib/session.php";
Session::checkSession();

spl_autoload_register(function($class){

include_ONCE "classes/".$class.".php";
});

?>

<?php

include 'lib/database.php';

$dep = new Department();
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
<body>
<div class="container">

				<?php
						if(isset($_GET['action']) && $_GET['action']=='logout'){
							Session::destroy();
						}
						
				?>



	<div class="well" style="background: url(img/banner21.jpg); height: 250px;">
		<h2 class="btn btn-info text " style="margin-top: 190px; margin-left: 820px;" > 
		<a style=" text-decoration: none; color: #fff" href="?action=logout">Logout</a> 
		</h2>
	</div>