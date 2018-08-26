<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style>
	.back a{width: 70px; margin-left: 634px;padding: 7px;text-align:center;display: block;background: #555;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 18px;}

</style>


<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../classess/Contact.php');
    
   
    
?>

<?php
       if(!isset($_GET['cont_id']) || $_GET['cont_id']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cont_id']);

       }


?>





        <div class="grid_10">
            <div class="box round first grid">
                
               <div class="block copyblock">

              
				<?php
				$contact = new Contact();
				$getmassageById = $contact->getMassageById($id);
				if ($getmassageById ) {
					while ( $result = $getmassageById->fetch_assoc()) {


				?>
										
						
				
			<div class="product-desc">
			     <h2><?php echo $result['name'];?>
                    sent this Massage</h2>
			      <?php echo $result['subject'];?>
	    </div>
	    <?php }}?>

	    
				
	
 	   </div>

            <div class="back">
                <a href="contactinbox.php">Back</a>
            </div>

            </div>
        
	<?php include 'inc/footer.php';?>