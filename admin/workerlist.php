<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Worker.php';?>
<?php include_once '../helpers/Format.php';?>

<?php
	$work = new Worker();
	$fm = new Format();
?>
<?php
	if (isset($_GET['delworker'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '' ,  $_GET['delworker']);
		$delworker = $work->delWorkerById($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">

        <?php
        	if (isset($delworker)) {
        		echo $delworker;
        	}
        ?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial</th>
					<th>Worker Name</th>
					<th>Category</th>
					<th>Top Category</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getWorker = $work->getAllWorker();
					if ($getWorker) {
						$i=0;
						while ($result = $getWorker->fetch_assoc()) {
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['workerName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['topName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'],50); ?></td>
					<td><?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" width="60px" height="40px" ></td>
					<td>
						<?php
							if ($result['type']==0) {
								echo "Featured";
							}else{
								echo "General";
							}
						?>
					</td>
					<td><a href="workeredit.php?workerid=<?php echo $result['workerId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delworker=<?php echo $result['workerId']; ?>">Delete</a></td>
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
