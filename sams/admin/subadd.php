<?php include "../classes/Subject.php"; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

$sub = new Subject();
if($_SERVER['REQUEST_METHOD'] =='POST'){
                   $department = $_POST['department'];
                   $semester = $_POST['semester'];
                   $subName = $_POST['subName'];
                  

                    $insertSub = $sub->catInsert($department, $semester, $subName);
        }    

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Subject</h2>
                <?php
                if (isset($insertSub)) {
                   echo "$insertSub";
                }

                ?>
               <div class="block copyblock"> 
                <form action="subadd.php" method="POST">
                    <table class="form">					
                         <select name="department" ng-model='discussionsSelect' class='form-control' STYLE="color: #000; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #ddd; width: 341px; height: 30px;">

                  <option value='total'>Select Your department</option>
                  <option value='EEE'>EEE</option>
                  <option value='CSE'>CSE</option>
                  <option value='ETE'>ETE</option>

                                
              </select>

                <select name="semester" ng-model='discussionsSelect' class='form-control' STYLE="color: #000; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #ddd; width: 341px; height: 30px; ">

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

                        <tr>
                            <td>
                                <input type="text" name ="subName" placeholder="Enter subject Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>