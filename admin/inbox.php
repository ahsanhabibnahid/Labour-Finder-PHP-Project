<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../classes/Cart.php");

	$fm = new Format();
	$ct = new Cart();
?>
<?php
	if (isset($_GET['shiftid'])) {
		$id     = $_GET['shiftid'];
		$time   = $_GET['time'];
		$price  = $_GET['price'];
		$shitf  = $ct->workerShifted($id,$time,$price);
	}

	if (isset($_GET['delworkid'])) {
		$id     = $_GET['delworkid'];
		$time   = $_GET['time'];
		$price  = $_GET['price'];
		$delOrder  = $ct->delWorkerShifted($id,$time,$price);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                	if (isset($shitf)) {
                		echo $shitf;
                	}
                	if (isset($delOrder)) {
                		echo $delOrder;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Time</th>
							<th>Worker</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getOrder = $ct->getAllOrderWorker();
						if ($getOrder) {
							while ($result = $getOrder->fetch_assoc()) {
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['workerName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><?php echo $result['cmrId']; ?></td>
							<td><a href="customer.php?custId=<?php echo $result['cmrId']; ?>">View Details</a></td>
					<?php
						if ($result['status'] == '0') {
					?>
						<td><a href="?shiftid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
					<?php	
						} elseif($result['status'] == '1') { 
					?>
						<td>Pending</td>
					<?php
						}  else {
					?>
						<td><a href="?delworkid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Remove</a></td>
					<?php
						} 
					?>
							
						</tr>
					<?php
						} }
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
