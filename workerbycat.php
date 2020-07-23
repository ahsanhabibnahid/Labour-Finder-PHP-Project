<?php include "inc/header.php"; ?>
<?php
	if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location='404.php';</script> ";
    }
    else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '' ,  $_GET['catId']);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<?php
    			if ($_GET['catId']) {
    				$id = $_GET['catId'];
    			}
				$getCat = $cat->getAllCatSingle($id);
				if ($getCat) {
					while ($result = $getCat->fetch_assoc()) {
			?>
    		<h3>Latest from <?php echo $result['catName']; ?></h3>
    		<?php
				} }	
			?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php
	      		$workerbycat = $work->workerByCat($id);
	      		if ($workerbycat) {
	      			while ($result = $workerbycat->fetch_assoc()) {
	      		
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
	      		} else {
	      			echo "<span style='color:red; font-size:24px;'>Worker of this Category are not Available</span>";
	      		}
			?>
				
			</div>

	
	
    </div>
 </div>
<?php include "inc/footer.php"; ?>

