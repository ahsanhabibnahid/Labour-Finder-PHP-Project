<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Top.php' ; ?>

<?php
	$top = new Top();
	
	if (isset($_GET['deltop'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '' ,  $_GET['deltop']);
		$delTop = $top->delTopById($id);
	}
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Top Category List</h2>
                <div class="block">  

                <?php
                
                	if (isset($delTop)) {
                		echo $delTop;
                	}
                
                ?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Top Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$getTop = $top->getAllTop();
						if ($getTop) {
							$i=0;
							while ($result = $getTop->fetch_assoc()) {
								$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo  $result['topName']; ?></td>
							<td><a href="topedit.php?topid=<?php echo $result['topId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?deltop=<?php echo $result['topId']; ?>">Delete</a></td>
						</tr>
					<?php
							}
						}
					?>	
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

