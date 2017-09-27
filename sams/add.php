<?php 
include 'inc/header.php';
include 'lib/student.php'; 
?>
<?php
$stu = new student();
$db = new Database ();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $department = $_POST['department'];
  $semester = $_POST['semester'];
  
  $name = mysqli_real_escape_string($db->link,$name);
  $roll = mysqli_real_escape_string($db->link,$roll);
  $address = mysqli_real_escape_string($db->link,$address);
  $email = mysqli_real_escape_string($db->link,$email);
  $phonenumber = mysqli_real_escape_string($db->link,$phonenumber);
  $department = mysqli_real_escape_string($db->link,$department);
  $semester = mysqli_real_escape_string($db->link,$semester);
  
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "img/".$unique_image;
  
    if (empty($name) || empty($roll) || empty($file_name) ||  empty($address) || empty($email) || empty($phonenumber) || empty($department) || empty($semester) ) {
  	$msg = "<div class='alert alert-danger'><strong>Error! </strong>Field Must Not Be Empty.</div>";
          echo $msg;
        }elseif ($file_size >1048567){
          $msg = "<div class='alert alert-danger'><strong>Error! </strong>Image Size should be less then 1MB!</div>";
          echo $msg;
        } elseif (in_array($file_ext, $permited) === false){
         echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } else{
        move_uploaded_file($file_temp, $uploaded_image);
		
		$stu_query = "INSERT INTO tbl_student(name, roll, image, address, email, phonenumber, department, semester ) VALUES('$name', '$roll', '$uploaded_image', '$address', '$email', '$phonenumber', '$department', '$semester') ";
		$inserted_rows = $db->insert($stu_query);
	
        $att_query = "INSERT INTO  tbl_attendance(roll) VALUES('$roll')";
        $inserted_rows = $db->insert($att_query);
        if ($department == 'EEE') {
        
        $eee_query = "INSERT INTO  tbl_eee(roll, department, semester) VALUES('$roll', '$department', '$semester')";
        $inserted_rows = $db->insert($eee_query);
      }elseif ($department == 'CSE') {

         $cse_query = "INSERT INTO  tbl_cse(roll, department, semester) VALUES('$roll', '$department', '$semester')";
        $inserted_rows = $db->insert($cse_query);

      }elseif ($department == 'ETE') {

         $ete_query = "INSERT INTO  tbl_ete(roll, department, semester) VALUES('$roll', '$department', '$semester')";
        $inserted_rows = $db->insert($ete_query);

      }
  

  	if ($inserted_rows) {
  		    $msg = "<div class='alert alert-success'><strong>success! </strong>Data inserted successfully.</div>";
  	      echo $msg;
          header('location:index.php');
  	}else{
  		  	$msg = "<div class='alert alert-danger'><strong>Error! </strong>Data not inserted successfully..</div>";
  	echo $msg;
  	}


  }




}
?>

<?php
 if (isset($insertdata)) {
   echo "$insertdata";
 }
?>
   <div class="panel panel-default">
   	 <div class="panel-heading">
   	 	<h2>
        <a class="btn btn-success" href="students.php">students</a>
        <a class="btn btn-success" href="calendar.php">calander</a>
   	 		<a class="btn btn-info pull-right" href="index.php">Back</a>
   	 	</h2>
       
   	 </div>
   	 <div class="panel-body">
 
   	 	<form action="" method="post" enctype="multipart/form-data"/>
   	 		   <div class="form-group">
              
               <label for="name">Student name</label>
               <input type="text" class="form-control" name="name" id="name" required ="">
           </div>

           <div class="form-group">
              
               <label for="roll">Student roll</label>
               <input type="text" class="form-control" name="roll" id="roll" >
           </div>

            <div class="form-group">
              
               <label for="roll">Address</label>
               <input type="text" class="form-control" name="address" id="address" >
           </div>

            <div class="form-group">
              
               <label for="roll">E-mail</label>
               <input type="text" class="form-control" name="email" id="email" >
           </div>

            <div class="form-group">
              
               <label for="roll">Phone No</label>
               <input type="text" class="form-control" name="phonenumber" id="phonenumber" >
           </div>

            <div class="form-group">
             <select name="department" ng-model='discussionsSelect' class='form-control' STYLE="color: #3D4451; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #ddd;">

                  <option value='total'>Select Your department</option>
                  <option value='EEE'>EEE</option>
                  <option value='CSE'>CSE</option>
                  <option value='ETE'>ETE</option>

                                
              </select>
           </div>

            <div class="form-group">
              
              <select name="semester" ng-model='discussionsSelect' class='form-control' STYLE="color: #3D4451; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #ddd;">

                  <option value='total'>Select Your semester</option>
                  <option value='1st'>1st</option>
                  <option value='2nd'>2nd</option>
                  <option value='3rd'>3rd</option>
                  <option value='4th'>4th</option>
                  <option value='8th'>5th</option>
                  <option value='6th'>6th</option>
                  <option value='7th'>7th</option>
                  <option value='8th'>8th</option>
                                
              </select>
           </div>
			
			<div class="form-group">
              
               <label for="image">Student image</label>
               <input type="file" class="form-control" name="image" id="image" >
            </div>

            <div class="form-group">
              
               <input type="submit" class="btn btn-primary" name="submit" value="Add Student">
            </div>

   	 	</form>

   	 </div>

   </div>

<?php include 'inc/footer.php'; ?>


	