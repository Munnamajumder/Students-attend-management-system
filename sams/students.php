<?php 
include 'inc/header.php'; 
include 'lib/student.php'; 
$db = new Database();
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
error_reporting(0);
$stu = new student();
$cur_date = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $attend = $_POST['attend'];
  $insertattend = $stu->insertattendance($cur_date, $attend);
}

?>

<?php
 if (isset($insertattend)) {
   echo "$insertattend";
 }
?>




 <div class='alert alert-danger' style="display:none;"><strong>Error! </strong>student roll missing.</div>
   <div class="panel panel-default">


     <div class="panel-heading">
      <h2>
        <a class="btn btn-success" href="add.php">add member</a>
        <a class="btn btn-success" onclick="return confirm('Are you sure to delete aLL!!!');" href="?action=deleteall">Delete All</a>
        <a class="btn btn-info pull-right" href="index.php">Back</a>
      </h2>
       
     </div>
     <div class="panel-body">
     <div class="well text-center" style="font-size: 20px;">
      All Students List !
     </div>
      <form action="" method="post">
        <table class="table table-striped">

<?php
            if(isset($_GET['action']) && $_GET['action']=='deleteall'){
             $query = "TRUNCATE TABLE tbl_student";
             $result = $db->select($query);
             $query = "TRUNCATE TABLE tbl_attendance";
             $result = $db->select($query);
             $query = "TRUNCATE TABLE tbl_eee";
             $result = $db->select($query);
             $query = "TRUNCATE TABLE tbl_cse";
             $result = $db->select($query);
             $query = "TRUNCATE TABLE tbl_ete";
             $result = $db->select($query);
             if (isset($result)) {
              header("location:students.php");
             }else{ ?>
              <tr>
          <th width="20%">serial</th>
          <th width="20%">Name</th>
          <th width="20%">ID</th>
          <th width="20%">Action</th>
           
        </tr>
     

  <?php } 
            }
            
            ?>




<?php
        if(isset($_GET['deletestd'])){
          $deletestd = $_GET['deletestd'];
          $delquery = "DELETE FROM tbl_student WHERE roll ='$deletestd'";
          $deletestd = $db->delete($delquery);
          if($deletestd){
            header("location:students.php");   
          }else{
            $error = "<div class='alert alert-danger'><strong>Erroe! </strong>Profile Data Not Deleted successfully.</div>";
              echo $error;
          }
          
          
        }
        
?>


<?php
  $get_student = $stu->getstudents();
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
           <a class="btn btn-success" href="profile.php?roll=<?php echo $value['roll']; ?>">profile</a>
           <a class="btn btn-success" onclick="return confirm('Are you sure to delete !!!');" href="?deletestd=<?php echo $value['roll']; ?>">Delete</a>
          </td>
      
        </tr>

   <?php }} else{ ?>

         <div class='alert alert-danger'><strong>Sorry! </strong>No Data Available.</div>

   <?php } ?>

  

        
               

        </table>

      </form>

     </div>

   </div>



<?php include 'inc/footer.php'; ?>


  