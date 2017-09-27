<?php 
include 'inc/header.php'; 
include 'lib/student.php'; 
?>

<script type="text/javascript">
   
$(document).ready(function(){
$("form").submit(function(){
 var roll = true;
 $(':radio').each(function(){
   name = $(this).attr('name');
   if (roll && !$(':radio[name = "'+ name +'"]:checked').length) {
      //alert(name + " roll missing !");

      $('.alert').show();
      roll = false;
   }
 });
return roll;

});
});


</script>


<?php
//error_reporting(0);
$stu = new student();
$dt = $_GET['dt'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $attend = $_POST['attend'];
  $attupdate = $stu->updateattendance($dt, $attend);
}

?>

<?php
 if (isset($attupdate)) {
   echo "$attupdate";
 }
?>


<div class='alert alert-danger' style="display:none;"><strong>Error! </strong>student roll missing.</div>

   <div class="panel panel-default">
   	 <div class="panel-heading">
   	 	<h2>
   	 		<a class="btn btn-success" href="add.php">add member</a>
   	 		<a class="btn btn-info pull-right" href="date_view.php">Back</a>
   	 	</h2>
       
   	 </div>
   	 <div class="panel-body">

      <div class="well text-center" style="font-size: 20px;">
         <strong>Date: </strong> <?php echo $dt;?>
      </div>

   	 	<form action="" method="post">
   	 		<table class="table table-striped">
   	 		<tr>
               <th width="20%">serial</th>
               <th width="20%">Name</th>
               <th width="20%">ID</th>
               <th width="20%">Attendance</th>
               <th width="20%">image</th>
            </tr>
   	 	<?php
   	 	  $get_student = $stu->getalldata($dt);
   	 	  if ($get_student) {
   	 	  	$i = 0;
   	 	  	while ($value = $get_student->fetch_assoc()) {
   	 	  		$i++;
   	 	  
   	 	?>	



            <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $value['name']; ?></td>
               <td><?php echo $value['roll']; ?></td>
               <td>
                  <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present" <?php if ($value['attend'] == "present") {
                    echo "checked";}?>>p
                  <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent" <?php if ($value['attend'] == "absent") {
                    echo "checked";}?>>a
               </td>
               <td><img src="<?php echo $value ['image'];?>" height="40px" width="40px"/></td>
            </tr>


  <?php }} ?>

            <tr>
               <td colspan="4">
                  <input type="submit" class="btn btn-primary" name="submit" value="Update">
               </td>
            </tr>
   	 			

   	 		</table>

   	 	</form>

   	 </div>

   </div>

<?php include 'inc/footer.php'; ?>


	