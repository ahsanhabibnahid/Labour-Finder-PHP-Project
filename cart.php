<?php include "inc/header.php"; ?>

<?php
	if (isset($_GET['delworker'])) {
		$delId = preg_replace('/[^-a-zA-Z0-9_]/', '' ,  $_GET['delworker']);
		$deleteWorker = $ct->delWorkerByCart($delId);
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $updateCart = $ct->updateCartQuantity($cartId,$quantity);
        if ($quantity<=0) {
        	$deleteWorker = $ct->delWorkerByCart($cartId);
        }
    }
?>
<?php
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=refresh'/>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    		if (isset($updateCart)) {
			    			echo $updateCart;
			    		}
			    		if (isset($$deleteWorker)) {
			    			echo $$deleteWorker;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Worker Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
						<?php
							$getWorker = $ct->getCartWorker();
							if ($getWorker) {
								$i=0;
								$sum=0;
								$qty=0;
								while ($result = $getWorker->fetch_assoc()) {
								$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['workerName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
	<td>
		<form action="" method="post">
			<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
			<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
			<input type="submit" name="submit" value="Update"/>
		</form>
	</td>
								<td>

							<?php
								$total = $result['price']*$result['quantity'];
							 	echo $total; 
							 ?>		
								</td>

								<td><a onclick="return confirm('Are you sure to delete!');" href="?delworker=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
						<?php
							$qty = $qty+$result['quantity']; 
							$sum= $sum+$total; 
							Session::set('qty',$qty);
							Session::set('sum',$sum);
						?>
						<?php } } ?>	
							
						</table>
					<?php
						$getData = $ct->checkCartTable();
							if ($getData) {	
					?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sum; ?></td>
							</tr>
					   </table>
					<?php
						} else {
							header("Location: index.php");
						}
					?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"><h1 class="btn btn-danger">Add More Labour</h1></a>
						</div>
						<div class="shopright">
							<a href="payment.php"><h1 class="btn btn-danger">Checkout</h1></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include "inc/footer.php";?>
