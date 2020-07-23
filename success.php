<?php include "inc/header.php"; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login==false) {
        header("Location:login.php");
    }
?>
<style>
	.psuccess{width: 500px; min-height: 200px; text-align: center; border: 1px solid #dddddd; margin: 0 auto; padding: 20px;}
	.psuccess h2{border-bottom: 1px solid #dddddd; margin-bottom: 20px; padding-bottom: 10px;}
	.psuccess p {line-height: 25px; font-size: 18px; text-align: left;}
	

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="psuccess">
				<?php
					$cmrId = Session::get("cmrId");
					$amount = $ct->payableAmount($cmrId);
					if ($amount) {
						$sum = 0;
						while ($result = $amount->fetch_assoc()) {
							$price = $result['price'];
							$sum = $sum+$price;
						}
					}
				?>
				<h2>Success</h2>
				<p>Total payable Amount : <?php echo $sum; ?> </p>
				<p>Thanks for order. We will contact with you as soon as possible. Here is your order details...<a href="orderdetails.php">Visit here</a></p>
			</div>   		
 		</div>
 	</div>
<?php include "inc/footer.php"; ?>

