<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../classess/Product.php');
    include_once ($filepath.'/../classess/Category.php');
    include_once ($filepath.'/../classess/Brand.php');
   
    
?>

<?php
       if(!isset($_GET['productId']) || $_GET['productId']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);

       }


?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Product Details</h2>
               <div class="block copyblock">

              
				<?php
				$pd = new Product();
				$getProductDetails =$pd->getProductById($id);
				if ($getProductDetails ) {
					while ( $result = $getProductDetails->fetch_assoc()) {


				?>				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?> </h2>
										
						
				
			<div class="product-desc">
			     <h2>Product Details</h2>
			      <?php echo $result['body'];?>
	    </div>
	    <?php }}?>
				
	
 	   </div>
            </div>
        
	<?php include 'inc/footer.php';?>