<?php 
$filepath = realpath(dirname(__FILE__));

include_ONCE ($filepath."/../lib/Database.php");
include_ONCE ($filepath."/../helpers/Format.php");


?>

<?php

class Department{
	
	private $db;
	private $fm;
	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
		
	}

	public function getAtudentsDep($department, $smstr){

			$query = "SELECT * FROM tbl_student WHERE department = '$department' AND semester = '$smstr'  ";
	        $result = $this->db->select($query);

	        return $result;



		
	
		 


	}

	public function insertDepAttendance($cur_date, $attend  = array(), $department, $semester, $subject){

if ($department == 'EEE'){

  $query = "SELECT DISTINCT att_time FROM tbl_eee";
  $query = "SELECT * FROM tbl_eee WHERE subject = '$subject' AND semester = '$semester'";
  $getdata = $this->db->select($query);

  while ($result = $getdata-> fetch_assoc()) {
    $db_date = $result['att_time'];
    $ssubject = $result['subject'];
    $ssemester = $result['semester'];
    if ($cur_date == $db_date && $subject = '$ssubject' && $semester = '$ssemester') {
      $msg = "<div class='alert alert-danger'><strong>Error! </strong>Attendance already taken !</div>";
    return $msg;
    }


}




foreach ($attend as $atn_key => $atn_value) {
  if ($atn_value == 'present') {
    $stu_query = "INSERT INTO tbl_eee(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'present', now())";
    $data_insert = $this->db->insert($stu_query);
  }elseif ($atn_value == 'absent') {
    $stu_query = "INSERT INTO tbl_eee(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'absent', now())";
    $data_insert = $this->db->insert($stu_query);
  }
}

if ($data_insert) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>attendance Data inserted successfully.</div>";
    return $msg;
    }else{
         // $msg = "<div class='alert alert-danger'><strong>Error! </strong>attendance Data not inserted successfully..</div>";
   // return $msg;
    }





} elseif ($department == 'CSE') {

  $query = "SELECT DISTINCT att_time FROM tbl_cse";
  $getdata = $this->db->select($query);
  while ($result = $getdata-> fetch_assoc()) {
    $db_date = $result['att_time'];
    if ($cur_date == $db_date) {
      $msg = "<div class='alert alert-danger'><strong>Error! </strong>Attendance already taken !</div>";
    return $msg;
    }


}




foreach ($attend as $atn_key => $atn_value) {
  if ($atn_value == 'present') {
    $stu_query = "INSERT INTO tbl_cse(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'present', now())";
    $data_insert = $this->db->insert($stu_query);
  }elseif ($atn_value == 'absent') {
    $stu_query = "INSERT INTO tbl_cse(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'absent', now())";
    $data_insert = $this->db->insert($stu_query);
  }
}

if ($data_insert) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>attendance Data inserted successfully.</div>";
    return $msg;
    }else{
          //$msg = "<div class='alert alert-danger'><strong>Error! </strong>attendance Data not inserted successfully..</div>";
    //return $msg;
    }





}elseif ($department == 'ETE') {

  $query = "SELECT DISTINCT att_time FROM tbl_ete";
  $getdata = $this->db->select($query);
  while ($result = $getdata-> fetch_assoc()) {
    $db_date = $result['att_time'];
    if ($cur_date == $db_date) {
      $msg = "<div class='alert alert-danger'><strong>Error! </strong>Attendance already taken !</div>";
    return $msg;
    }


}




foreach ($attend as $atn_key => $atn_value) {
  if ($atn_value == 'present') {
    $stu_query = "INSERT INTO tbl_ete(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'present', now())";
    $data_insert = $this->db->insert($stu_query);
  }elseif ($atn_value == 'absent') {
    $stu_query = "INSERT INTO tbl_ete(roll, department, semester, attend, att_time) VALUES ('$atn_key', '$department', '$semester', 'absent', now())";
    $data_insert = $this->db->insert($stu_query);
  }
}

if ($data_insert) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>attendance Data inserted successfully.</div>";
    return $msg;
    }else{
          //$msg = "<div class='alert alert-danger'><strong>Error! </strong>attendance Data not inserted successfully..</div>";
    //return $msg;
    }


}

}
}


	?>