<?php 
	include "inc/header.php";
	include "inc/slider.php";
?>
		
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3>Best Workers</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      		<?php
	      			$getFwork = $work->getFeaturedWorker();
	      			if ($getFwork) {
	      				while ($result = $getFwork->fetch_assoc()) {
	      		?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?workid=<?php echo $result['workerId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
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
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Workers</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

				<?php
	      			$getNewWork = $work->getNewWorker();
	      			if ($getNewWork) {
	      				while ($result = $getNewWork->fetch_assoc()) {
	      		?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?workid=<?php echo $result['workerId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['workerName']; ?></h2>
					 <p><span class="price"><?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>" class="details">Details</a></span></div>
				</div>

				<?php
					} }
				?>
				
			</div>
    </div>
 </div>

 <?php
 	include "inc/footer.php";
 ?>

