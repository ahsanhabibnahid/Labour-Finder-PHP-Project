<div class="header_bottom">
	<!--
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getFridge = $work->latestFromFridge();
					if ($getFridge) {
						while ($result = $getFridge->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?workid=<?php echo $result['workerId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Fridge</h2>
						<p><?php echo $result['workerName']; ?></p>
						<div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	

			   <?php
					} }
			   ?>

			   <?php
					$getAir = $work->latestFromAir();
					if ($getAir) {
						while ($result = $getAir->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?workid=<?php echo $result['workerId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>AC</h2>
						<p><?php echo $result['workerName']; ?></p>
						<div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>">Add to cart</a></span></div>
				   </div>
				</div>
				<?php
					} }
			   ?>

			</div>
			<div class="section group">
				<?php
					$getComputer = $work->latestFromComputer();
					if ($getComputer) {
						while ($result = $getComputer->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?workid=<?php echo $result['workerId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Computer</h2>
						<p><?php echo $result['workerName']; ?></p>
						<div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
					} }
			   ?>
			   <?php
					$getElectrician = $work->latestFromElectrician();
					if ($getElectrician) {
						while ($result = $getElectrician->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?workid=<?php echo $result['workerId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Electric</h2>
						<p><?php echo $result['workerName']; ?></p>
						<div class="button"><span><a href="details.php?workid=<?php echo $result['workerId']; ?>">Add to cart</a></span></div>
				   </div>
				</div>
				<?php
					} }
			    ?>
			</div>
		  <div class="clear"></div>
		</div>
	-->
		<div class="header_bottom_right_images" style="width: 99%;">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1s.jpg" alt=""/></li>
						<li><img src="images/2s.jpg" alt=""/></li>
						<li><img src="images/3s.jpg" alt=""/></li>
						<li><img src="images/4s.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
</div>
