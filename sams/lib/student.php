<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/database.php');
?>
<?php

class student {
  private $db;
  
public function __construct(){
    $this->db = new database();
  }
public function getstudents($batch){
  $query = "select * from tbl_student ORDER BY roll ASC";
  $result = $this->db->select($query);
 return  $result;
}

public function insertstudent($name, $roll, $image){
  $name = mysqli_real_escape_string($this->db->link,$name);
  $roll = mysqli_real_escape_string($this->db->link,$roll);
  
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "img/".$unique_image;
    
    
  

  if (empty($name) || empty($roll) || empty($file_name) ) {
    echo "Field must not be empty";
        }elseif ($file_size >1048567){
         echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } elseif (in_array($file_ext, $permited) === false){
         echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } else{
        move_uploaded_file($file_temp, $uploaded_image);
    
    $stu_query = "INSERT INTO tbl_student(name, roll) VALUES('$name', '$roll')";
    $inserted_rows = $this->db->insert($stu_query);
  
        $att_query = "INSERT INTO  tbl_attendance(roll, image) VALUES('$roll', '$uploaded_image')";
        $inserted_rows = $this->db->insert($att_query);
  

    if ($inserted_rows) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>Data inserted successfully.</div>";
    return $msg;
    }else{
          $msg = "<div class='alert alert-danger'><strong>Error! </strong>Data not inserted successfully..</div>";
    return $msg;
    }
  }

}
public function insertattendance($cur_date, $attend  = array()){
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";
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
    $stu_query = "INSERT INTO tbl_attendance(roll, attend, att_time) VALUES ('$atn_key', 'present', now())";
    $data_insert = $this->db->insert($stu_query);
  }elseif ($atn_value == 'absent') {
    $stu_query = "INSERT INTO tbl_attendance(roll, attend, att_time) VALUES ('$atn_key', 'absent', now())";
    $data_insert = $this->db->insert($stu_query);
  }
}

if ($data_insert) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>attendance Data inserted successfully.</div>";
    return $msg;
    }else{
          $msg = "<div class='alert alert-danger'><strong>Error! </strong>attendance Data not inserted successfully..</div>";
    return $msg;
    }





}

 public function getdatelist(){
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";
  $result = $this->db->select($query);
  return $result;


 }

public function getalldata($dt){
  $query = "SELECT tbl_student.name,image, tbl_attendance.*
   From tbl_student
   INNER JOIN tbl_attendance
   ON tbl_student.roll = tbl_attendance.roll
   WHERE att_time = '$dt'";
   $result = $this->db->select($query);
   return $result;

}

public function updateattendance($dt, $attend){

  foreach ($attend as $atn_key => $atn_value) {
  if ($atn_value == 'present') {
     $query = "update tbl_attendance

     SET attend = 'present'
     WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
     $data_update = $this->db->update($query);

   
  }elseif ($atn_value == 'absent') {

    $query = "update tbl_attendance

     SET attend = 'absent'
     WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
     $data_update = $this->db->update($query);


  
  }
}

if ($data_update) {
      $msg = "<div class='alert alert-success'><strong>success! </strong>attendance Data updated successfully.</div>";
    return $msg;
    }else{
          $msg = "<div class='alert alert-danger'><strong>Error! </strong>attendance Data not updated successfully..</div>";
    return $msg;
    }

}




}



?>


