<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../classess/Cart.php');
    include_once ($filepath.'/../helpers/Format.php');

   $ct = new Cart();
   $fm = new Format();
    
?>

<?php
    if (isset($_GET['shiftid'])) {
    	$id =$_GET['shiftid'];
    	$price= $_GET['price'];
    	$time=$_GET['time'];
    	$shift = $ct->productShifted($id, $price, $time);
    	
    	
    }
    ?>

 <?php
    if (isset($_GET['delproductid'])) {
    	$id =$_GET['delproductid'];
    	$price= $_GET['price'];
    	$time=$_GET['time'];
    	$remove = $ct->productDeleted($id, $price, $time);
    	
    	
    }
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block"> 
                <?php
                if (isset($shift)) {
                	echo $shift;
                }

                ?>  
                <?php
                if (isset($remove)) {
                	echo $remove;
                }

                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Product ID</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>price</th>
							<th>Cmr Id</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						  
						  
						   $getOrder = $ct->getOrderDetails();
						   if ($getOrder) {
						   	while ($result =  $getOrder->fetch_assoc()) {						   	
						   

						?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']?></td>
						     <td><a href="productDetails.php?productId=<?php echo $result['productId']?>"><?php echo $result['productId']?></a></td>	
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td><?php echo $result['productName']?></td>
							<td><?php echo $result['quantity']?></td>
							<td><?php echo $result['price']?></td>
							<td><?php echo $result['cmrId']?></td>
							<td><a href="customar.php?cmrId=<?php echo $result['cmrId']?>">View Details</a></td>
						<?php

						if($result['status']== 0){?>

							<td><a href="?shiftid=<?php echo $result['cmrId']?> & price=<?php echo $result['price']?> & time=<?php echo $result['date']?>">Shifted</a></td>

						<?php } elseif($result['status'] == 1){ ?>
							<td>Pending</td

						<?php } else{?>
						
						
							<td><a href="?delproductid=<?php echo $result['cmrId']?> & price=<?php echo $result['price']?> &time=<?php echo $result['date']?>">Remove</a></td>
                             
						

						<?php } ?>
							
								
							
						</tr>
						<?php }}?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
