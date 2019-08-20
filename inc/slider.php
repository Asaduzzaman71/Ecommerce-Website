	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">


				<?php
					$getiphone=$pd->latestFromApple();
					if($getiphone){
						while($result=$getiphone->fetch_assoc()){
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>"; alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Apple</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
				   <?php

						}
					}
				?>
			   </div>	




			   	<?php
					$getapple=$pd->latestFromApple();
					if($getapple){
						while($result=$getapple->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>"; alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						 <p><?php echo $result['productName']; ?></p>
						 <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>

					<?php }} ?>
				




				<?php
					$getaccer=$pd->latestFromAccer();
					if($getaccer){
						while($result=$getaccer->fetch_assoc()){
				?>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>"; alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Accer</h2>
						 <p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>

			   </div>

			   	<?php }} ?>
			      


			   	<?php
					$getlg=$pd->latestFromLg();
					if($getlg){
						while($result=$getlg->fetch_assoc()){
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>"; alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						 <h2>LG</h2>
						 <p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>

		<?php }} ?>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
