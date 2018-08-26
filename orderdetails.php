<?php include 'inc/header.php';?>

<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }

?>
<?php

if (isset($_GET['customerId'])) {
      $id =$_GET['customerId'];
      $price= $_GET['price'];
      $time=$_GET['time'];
      $confirm = $ct->OrderConfirm($id, $price, $time);
   
    }

?>



 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="order">
    			<div>
    				<h2>Your Order Details</h2>
                    <table class="tblone">
                     
                            <tr>
                                <th >No</th>
                                <th >Product Name</th>
                                <th >Image</th>                               
                                <th >Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                            <?php 
                               $cmrId = Session::get("cmrId");
                               $getOrderProduct = $ct->getOrderProduct($cmrId);
                               if ($getOrderProduct) {
                                $i=0;
                                
                                  while ($result = $getOrderProduct->fetch_assoc()) {
                                    $i++;
                                    
                                  

                            ?>
                            <tr class="success">
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['productName'] ;?></td>
                                <td><img src="admin/<?php echo $result['image'] ;?>" alt=""/></td>
                                <td><?php echo $result['quantity'] ;?></td>
                                <td><?php echo $result['price'] ;?></td>
                              
                                <td><?php echo $fm->formatDate($result['date']) ;?></td> 
                                 
                                  <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo "Pending";
                                     
                                    }elseif($result['status'] == 1) { 
                                      echo "Shifted";

                                     } else{ 
                                      echo "OK";

                                    }    ?>

                                   
                                  </td>

                                  <?php 
                                  if($result['status'] == 1){ ?>
                                     <td> <a href="?customerId=<?php echo $cmrId; ?> & price=<?php echo $result['price'];?> &time=<?php echo $result['date'];?>">Confirm</a></td>
                                 <?php } elseif($result['status'] == 2){?> 

                                <td>OK</td>
                             

                             <?php } elseif($result['status'] == 0){?>
                              <td>N/A</td>


                             <?php }?>

                               
                        </tr>
                            <?php  } }?>
                        </table>
    				
    			</div>
    		</div>

    		
    	</div>
    <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php';?>