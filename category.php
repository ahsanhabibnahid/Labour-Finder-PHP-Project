<?php include "inc/header.php"; ?>

 <div class="main">
    <div class="content">
    	<?php
			$getCat = $cat->getAllCat();
			if ($getCat) {
				while ($result = $getCat->fetch_assoc()) {
		?>
    	<div class="content_top">
    		<div class="heading">
    		<div style="pointer-events: none;">
    			<h3><a style="color: #C51214" href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></h3>
    		</div>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$id = $result['catId'];

	      		$workerByCategory = $work->workerByCat($id);
	      		if ($workerByCategory) {
	      			while ($result = $workerByCategory->fetch_assoc()) {
	      					
	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['workerName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],50); ?></p>
					 <p><span class="price"><?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
	      		}
			?>
				
			</div>
		
		<?php
			} }	
		?>
    </div>
 </div>
<?php include "inc/footer.php"; ?>

