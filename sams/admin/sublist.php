<?php 
include "../classes/Subject.php";
 ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
		$db = new Database();
		$fm = new Format();
$sub = new Subject();

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Subject List</h2>

                   <?php
				if(isset($_GET['delsub'])){
					$delsub = $_GET['delsub'];
					$delquery = "DELETE FROM tbl_subject WHERE id='$delsub'";
					$delsub=$db->delete($delquery);
					if($delsub){
						echo "<span class='success'>subject Deleted sussesfully</span>";
						
					}else{
						echo "<span class='error'>subject not Deleted</span>";
					}
					
					
				}
				
				?>


                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>

							<th>Serial No.</th>
							<th>Subject Name</th>
							<th>Action</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
					$getsub = $sub->getAllSub();
					if ($getsub) {
						$i=0;
						while ($result=$getsub->fetch_assoc()) {
							$i++;
					

					?>
					
						<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result ['subName'];?></td>
					<td><a href="editsub.php?subid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete !!!');"href="?delsub=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
						<?php }} ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

