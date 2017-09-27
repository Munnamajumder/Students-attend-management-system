<?php 
include 'inc/header.php'; 
include 'lib/student.php'; 
?>



   <div class="panel panel-default">
   	 <div class="panel-heading">
   	 	<h2>
   	 		<a class="btn btn-success" href="add.php">add member</a>
   	 		<a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
   	 	</h2>
       
   	 </div>
   	 <div class="panel-body">

   	 	<form action="" method="post">
   	 		<table class="table table-striped">
   	 		<tr>
   	 			<th width="30%">serial</th>
   	 			<th width="50%">Attendance Date</th>
   	 			<th width="20%">Action</th>
   	 		</tr>
   	 	<?php
           $stu = new student();
   	 	  $get_date = $stu->getdatelist();
   	 	  if ($get_date) {
   	 	  	$i = 0;
   	 	  	while ($value = $get_date->fetch_assoc()) {
   	 	  		$i++;
   	 	  
   	 	?>	
   	 		<tr>
   	 			<td><?php echo $i; ?></td>
   	 			<td><?php echo $value['att_time']; ?></td>
   	 			<td>
   	 				<a class="btn btn-primary" href="student_view.php?dt=<?php echo $value['att_time']; ?>">View</a>
                  <a class="btn btn-primary" href="student_delete.php?sd=<?php echo $value['att_time']; ?>">Delete</a>

   	 			</td>
   	 		</tr>

  <?php }}else{ ?>

          <div class='alert alert-danger'><strong>Sorry! </strong>No Record Available. Please Take Attendance !</div>

   <?php } ?>
   	 			

   	 		</table>

   	 	</form>

   	 </div>

   </div>

<?php include 'inc/footer.php'; ?>


	