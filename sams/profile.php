<?php 
include 'inc/header.php'; 
include 'lib/student.php'; 

$db = new Database();
?>

<?php

if(!isset($_GET['roll']) || ($_GET['roll'])== NULL){
	header("location:404.php");	
}else{
	$roll = $_GET['roll'];
}
?>

     <div class="well text-center" style="font-size: 20px;">
      Student Profile.
     </div>
      <?php
      $query = "select * from tbl_student where roll = '$roll'";
      $post = $db->select($query);
      if($post){
        while($result = $post->fetch_assoc() ){


    ?>
    
      <div class="panel-heading">
   	 	<h2>
   	 		<a class="btn btn-success" href="add.php">add member</a>
            <a class="btn btn-success" href="stdupdate.php?updatestd=<?php echo $result['roll'];?>">Update</a>
   	 		<a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
   	 	</h2>
       
   	 </div>

				<section id="about" class="section section-about">
					<div class="animate-up">
						<div class="section-box">
							<div class="profile">
								<div class="row">


		

    
									<div class="col-xs-5">
										<div class="profile-photo"><img src="<?php echo $result['image'];?>" alt="Robert Smith"/></div>
									</div>
									<div class="col-xs-7">




										<div class="profile-info">
										
											<h1 class="profile-title"><?php echo $result['name'];?></h1>
											<h2 class="profile-position">University Of Science And Technology Chittagong</h2></div>
                                            <ul class="profile-list">
                                            	 <li class="clearfix">
                                                    <strong class="title">ID</strong>
                                                    <span class="cont"><?php echo $result['roll'];?></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">Age</strong>
                                                    <span class="cont">24</span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">Address</strong>
                                                    <span class="cont"><?php echo $result['address'];?></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">E-mail</strong>
                                                    <span class="cont"><a href=""><?php echo $result['email'];?></a></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">Phone</strong>
                                                    <span class="cont"><a href=""><?php echo $result['phonenumber'];?></a></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">Department</strong>
                                                    <span class="cont"><?php echo $result['department'];?></span>
                                                </li>
                                                <li class="clearfix">
                                                    <strong class="title">Semester</strong>
                                                    <span class="cont"><?php echo $result['semester'];?></span>
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

                                            </ul>

                                            

									</div>
									<?php } } }?>





								</div>
							</div>
						
						</div>


					</div>	


				</section><!-- #about -->

	<?php include 'inc/footer.php'; ?>								