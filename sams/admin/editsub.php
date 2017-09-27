<?php include "../classes/Subject.php"; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(!isset($_GET['subid']) || $_GET['subid']==NULL){
    echo "<script>window.location = 'sublist.php';</script>";
}else{
    $id=$_GET['subid'];
}

?>
<?php

$sub = new Subject();
if($_SERVER['REQUEST_METHOD'] =='POST'){
                   $subName = $_POST['subName'];
                  

                    $updateSub = $sub->updateSubject($subName, $id);
        }    

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Subject</h2>
                <?php
                if (isset($updateSub)) {
                   echo "$updateSub";
                }

                ?>
               <div class="block copyblock"> 
               <?php
                    $getsub = $sub->getsubById($id);
                    if ($getsub) {
                       
                        while ($result=$getsub->fetch_assoc()) {
                    
                    

                    ?>



                <form action="" method="POST">

                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="subName" value="<?php echo $result['subName'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>

                    </form>
                    <?php }} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>