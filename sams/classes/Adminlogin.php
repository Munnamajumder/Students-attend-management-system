<?php
 include "/../lib/Session.php"; 
 Session::checkLogin();
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php"); 
include_once ($filepath."/../helpers/Format.php"); 
?>


<?php

class Adminlogin{
	private $db;
	private $fm;

	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
		
	}

	public function adminLogin($adminUser, $adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if (empty($adminUser) || empty($adminPass)) {
			$msg ="<span class='error'>Username Or Password Must not be empty !!!</span>";
			return $msg;
		}else{
			$query = "SELECT * FROM tbl_adminn WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("adminId", $value['adminId']);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminName", $value['adminName']);
				header("location:dashbord.php");
			}else{
				$msg = "<span class='error'>Username Or Password  not match!!!</span>";
				return $msg;
			}
			
		}

	}
}






 ?>