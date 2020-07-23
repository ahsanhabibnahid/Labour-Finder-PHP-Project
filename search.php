<?php include "inc/header.php"; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		
    		<h3>Search Results</h3>
    		
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      		<?php
			  		if (isset($_POST['search'])) {
			  			$searchId = $_POST['searchValue'];
			  			$searchResult = $work->searchData($searchId);
			  			if ($searchResult) {
			  				while ($result= $searchResult->fetch_assoc()) {
			  	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?workid=<?php echo $result['workerId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['workerName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],50); ?></p>
					 <p><span class="price"><?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>" class="details">Details</a></span></div>
				</div>

				<?php			}
			  			}
			  		}
			  	?>
			
				
			</div>

	
	
    </div>
 </div>
<?php include "inc/footer.php"; ?>



			  	