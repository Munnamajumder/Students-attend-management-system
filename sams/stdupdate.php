<?php 
include 'inc/header.php'; 
include 'lib/student.php'; 

$db = new Database();
?>

<?php

if(!isset($_GET['updatestd']) || ($_GET['updatestd'])== NULL){
  header("location:404.php"); 
}else{
  $roll = $_GET['updatestd'];
}
?>



     <div class="well text-center" style="font-size: 20px;">
      Update Profile.
     </div>
   

      <div class="panel-heading">
   	 	<h2>
   	 		<a class="btn btn-success" href="add.php">add member</a>
        <a class="btn btn-success" href="students.php">Students</a>
   	 		<a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
   	 	</h2>
       
   	 </div>

         <?php
         
         if($_SERVER['REQUEST_METHOD'] =='POST'){
           $address = $_POST['address'];
           $email = $_POST['email'];
           $department = $_POST['department'];
           $phonenumber = $_POST['phonenumber'];
           $semester = $_POST['semester'];

          $address = mysqli_real_escape_string($db->link,$address);
          $email = mysqli_real_escape_string($db->link,$email);
          $department = mysqli_real_escape_string($db->link,$department);
          $phonenumber = mysqli_real_escape_string($db->link,$phonenumber);
          $semester = mysqli_real_escape_string($db->link,$semester);
          
          if(empty($address) || empty($email) || empty($phonenumber) || empty($department) || empty($semester)){
                  $error = "<div class='alert alert-danger'><strong>Error! </strong>Field Must Not Be Empty !</div>";
             echo $error;
            
          }else{
            $query = "UPDATE tbl_student
            SET
            address='$address',
            email='$email',
            department = '$department',
            phonenumber='$phonenumber',
            semester='$semester'
            where roll='$roll'";
            $updated_row = $db->update($query);
          
          if($updated_row){
                  $msg = "<div class='alert alert-success'><strong>Success! </strong>Profile Data updated successfully.</div>";
              echo $msg;
            
          }else{
             $error = "<div class='alert alert-danger'><strong>Erroe! </strong>Profile Data Not updated successfully.</div>";
              echo $error;
          }

          }

         }
         
         ?>




				<section id="about" class="section section-about">
					<div class="animate-up">
						<div class="section-box">
							<div class="profile">
								<div class="row">

		
    <?php
      $query = "select * from tbl_student where roll = $roll";
      $post = $db->select($query);
      if($post){
        while($result = $post->fetch_assoc() ){
    ?>
    
									<div class="col-xs-5">
										<div class="profile-photo"><img src="<?php echo $result['image'];?>" alt="Robert Smith"/></div>
									</div>
									<div class="col-xs-7">




										<div class="profile-info">
		


                                            <h1 class="profile-title"><?php echo $result['name'];?></h1>
                                            <h2 class="profile-position">University Of Science And Technology Chittagong</h2></div>

                 <form action="" method="POST">
                    <table class="form">
                                            <ul class="profile-list">
                                            	 <li class="clearfix">
                                                    <strong class="title"> <label>ID</label></strong>
                                                    <span class="cont"><input type="text" name="id" value="<?php echo $result['roll'];?>" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>Age</label></strong>
                                                    <span class="cont"><input type="text" name="age" value="24" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>Address</label></strong>
                                                    <span class="cont"><input type="text" name="address" value="<?php echo $result['address'];?>" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>E-mail</label></strong>
                                                    <span class="cont"><input type="text" name="email" value="<?php echo $result['email'];?>" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>Phone</label></strong>
                                                    <span class="cont"><input type="text" name="phonenumber" value="<?php echo $result['phonenumber'];?>" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>Department</label></strong>
                                                    <span class="cont"><input type="text" name="department" value="<?php echo $result['department'];?>" class="medium" /></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title"> <label>Semester</label></strong>
                                                    <span class="cont"><input type="text" name="semester" value="<?php echo $result['semester'];?>" class="medium" /></span>
                                                </li>
                                                
                                                
													 <?php
                                                error_reporting(0);

                                                    if(!isset($_GET['roll']) || ($_GET['roll'])== NULL){
                                                      header("location:404.php"); 
                                                    }else{

                                                    $query = "SELECT DISTINCT att_time FROM tbl_attendance";
                                                    $result = $db->select($query);
                                                    $total_days = mysqli_num_rows($result);

                                                    $query = "select * from tbl_attendance WHERE roll = '$roll' AND attend = 'present'";
                                                    $result = $db->select($query);
                                                    $total_present = mysqli_num_rows($result);


                                                   /* $query = "select * from tbl_attendance WHERE attend = 'absent'";
                                                    $result = $db->select($query);
                                                    $total_absent = mysqli_num_rows($result);

                                                    $attend = $total_absent+$total_present; */

                                                    $total_attend = ($total_days-1)/$total_present;
                                                    $att_percent = 100/$total_attend;
													
													?>
                                                    
												
													<li class="clearfix">
                                                  <strong class="title">Attendance :</strong>
                                                  <span class="cont"><?php echo $att_percent;?><b>%</b></span>
                                                </li>
													<?php } ?>
                                                    
                                               

                                                  <li class="clearfix">
                                                    <strong class="title"> <label></label></strong>
                                                    <span class="cont"><input class="btn btn-success" type="submit" name="submit" Value="Update" /></span>
                                                </li>
                                               <tr>


                                            </ul>


                              </table>
                              </form>
                
                                            

									</div>
									
								</div>
        <?php } } ?>

							</div>
						
						</div>


					</div>	
				</section><!-- #about -->

	<?php include 'inc/footer.php'; ?>								