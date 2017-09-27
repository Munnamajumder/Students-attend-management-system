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
error_reporting(0);
$stu = new student();
$cur_date = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $attend = $_POST['attend'];
  $department = $_POST['department'];
  $semester = $_POST['semester'];
  $subject = $_POST['subject'];
  $insertattend = $dep->insertDepAttendance($cur_date, $attend, $department, $semester, $subject);
}

?>

<?php
if ($insertattend) {
  echo "$insertattend";
}
?>


 <div class='alert alert-danger' style="display:none;"><strong>Error! </strong>student roll missing.</div>
<?php
$position = session::get('position');

?>


   <div class="panel panel-default">
     <div class="panel-heading">
      <h2>
        

            <?php

            if (session::get('position') == 'teacher') { ?>
               <a class="btn btn-success" href="add.php">add member</a>
                <a class="btn btn-success" href="students.php">students</a>
             
                 <a class="btn btn-success" href="calendar.php">calander</a>
                 <a class="btn btn-info pull-right" href="date_view.php">View All</a>


                  <div class="panel-body">
       <div class="well text-center" style="font-size: 20px;">
         <strong>Date: </strong> <?php echo $cur_date;?>
       </div>



               <?php
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $department = $_POST['department'];
        $smstr = $_POST['semester'];

        
        }

       

       ?>
     

        <form action="" method="post">
             <select name="department" ng-model='discussionsSelect' class='form-control' STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;">

                  <option value='total'>Select Your department</option>
                  <option value='EEE'>EEE</option>
                  <option value='CSE'>CSE</option>
                  <option value='ETE'>ETE</option>

                                
              </select>


              <select name="semester" ng-model='discussionsSelect' class='form-control' STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;">

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

            
            <input type="submit" class="btn btn-primary" name="search" value="search">
         </form>



         <form action="" method="post">
            <table class="table table-striped">
  


            <tr style="font-size: 16px">
               <th width="10%">serial</th>
               <th width="20%">Name</th>
               <th width="15%">ID</th>
               <th width="20%">Attendance</th>
               <th width="10%">dep</th>
               <th width="10%">semstr</th>
               <th width="15%">image</th>
            </tr>
       

      
<?php
           $get_student = $dep->getAtudentsDep($department, $smstr);
           if ($get_student) {
            $i = 0;
            while ($value = $get_student->fetch_assoc()) {
               $i++;
           
         ?> 

            <tr style="font-size: 16px">
               <td><?php echo $i; ?></td>
               <td><?php echo $value['name']; ?></td>
               <td><?php echo $value['roll']; ?></td>
               <td>
                  <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present">p
                  <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent">a
               </td>


                <td>
               <input type="text" name="department" value="<?php echo $value['department']; ?>">
               </td>
               <td>
               <input type="text" name="semester" value="<?php echo $value['semester']; ?>">
               </td>
            <td><img src="<?php echo $value ['image'];?>" height="40px" width="40px"/></td>
            </tr>



  <?php } ?>

            <tr>
               <td colspan="5">
                  <input type="submit" class="btn btn-primary" name="submit" value="submit">
               </td>
            </tr>

         <?php } ?>  

           
       

            

            </table>

         </form>

       </div>




            <?php }else {?>


              <div class="panel panel-default">


     <div class="panel-heading">
     
       
     </div>
     <div class="panel-body">
     <div class=" well text-center" style="font-size: 20px;">
      All Students List !
     </div>




               <?php
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $department = $_POST['department'];
        $smstr = $_POST['semester'];

        
        }

       

       ?>
     

        <form action="" method="post">
             <select name="department" ng-model='discussionsSelect' class='form-control' STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;">

                  <option value='total'>Select Your department</option>
                  <option value='EEE'>EEE</option>
                  <option value='CSE'>CSE</option>
                  <option value='ETE'>ETE</option>

                                
              </select>


              <select name="semester" ng-model='discussionsSelect' class='form-control' STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;">

                  <option value='total'>Select Your semester</option>
                  <option value='1st'>1st</option>
                  <option value='2nd'>2nd</option>
                  <option value='3rd'>3rd</option>
                  <option value='4th'>4th</option>
                  <option value='8th'>45th</option>
                  <option value='6th'>6th</option>
                  <option value='7th'>7th</option>
                  <option value='8th'>8th</option>
                                
              </select>
            <input type="submit" class="btn btn-primary" name="search" value="search">
         </form>


   <?php
          $get_student = $dep->getAtudentsDep($department, $smstr);
           if ($get_student) {
            $i = 0;
            while ($value = $get_student->fetch_assoc()) {
               $i++;
           
         ?> 


      <form action="" method="post">
        <table class="table table-striped">

        <tr style="font-size: 16px">
               <th width="15%">serial</th>
               <th width="25%">Name</th>
               <th width="25%">ID</th>
               <th width="20%">Action</th>
               
            </tr>



       


        <tr style="font-size: 16px">
          <td width="10%"><?php echo $i; ?></td>
          <td width="40%"><?php echo $value['name']; ?></td>
          <td width="30%"><?php echo $value['roll']; ?></td>
          <td  width="20%">
           <a class="btn btn-success" href="stdprofile.php?roll=<?php echo $value['roll']; ?>">profile</a>
          </td>
      
        </tr>

   <?php }} ?>




  

        
               

        </table>

      </form>

     </div>

   </div>
        

      <?php }  ?>
      </h2>
       
     </div>
    

   </div>

<?php include 'inc/footer.php'; ?>


