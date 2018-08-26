<?php include 'inc/header.php';?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
				     $productByIphone = $pd->AllFromIphone();
	      	     if ($productByIphone ) {
	      	     	while ($result = $productByIphone->fetch_assoc()) {
	      	     		
	      	     	


	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>

				<?php  } } else{
					echo "<span style='color: red; font-size: 18px;'> Product of this brand are not available! </span>";

				}
				?>


				
				
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Samsung</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
				     $productBySamsung = $pd->AllFromSamsung();
	      	     if ($productBySamsung ) {
	      	     	while ($result = $productBySamsung->fetch_assoc()) {
	      	     		
	      	     	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>

				<?php  } } else{
					echo "<span style='color: red; font-size: 18px;'> Product of this brand are not available! </span>";

				}
				?>


				
				
				
				
			</div>
	<div class="content_bottom">
    		<div class="heading">
    		<h3>Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
				     $productByAcer = $pd->AllFromAcer();
	      	     if ($productByAcer ) {
	      	     	while ($result = $productByAcer->fetch_assoc()) {
	      	     		
	      	     	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>

				<?php  } } else{
					echo "<span style='color: red; font-size: 18px;'> Product of this brand are not available! </span>";

				}
				?>


				
				
				
				
				
			</div>


			<div class="content_bottom">
    		<div class="heading">
    		<h3>Canon</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
				     $productByCanon = $pd->AllFromCanon();
	      	     if ($productByCanon ) {
	      	     	while ($result = $productByCanon->fetch_assoc()) {
	      	     		
	      	     	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>

				<?php  } } else{
					echo "<span style='color: red; font-size: 18px;'> Product of this brand are not available! </span>";

				}
				?>


				
				
				
				
			</div>


             <div class="content_bottom">
    		<div class="heading">
    		<h3>HP</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
				     $productByHP = $pd->AllFromHP();
	      	     if ($productByHP) {
	      	     	while ($result = $productByHP->fetch_assoc()) {
	      	     		
	      	     	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>

				<?php  } } else{
					echo "<span style='color: red; font-size: 18px;'> Product of this brand are not available! </span>";

				}
				?>

				</div>
    </div>
 </div>
<?php include 'inc/footer.php';?>