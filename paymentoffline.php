<?php include 'inc/header.php';?>

<!--jodi ligin na thake, tahole login page a redirect kore dibe-->
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }

?>

<?php 
     if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
        $cmrId = Session::get("cmrId");
        $insertOrder= $ct->orderProduct($cmrId);
        $deldata =$ct->delCustomerData();
        header("Location:Success.php");
     }

?>

<style >
.division{width: 50%;float: left;}
.tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td{text-align: justify;}
.tbltwo{float:right;text-align:left; width:60%; border:2px solid #ddd;margin-right: 14px;margin-top: 12px;}
.tbltwo tr td{text-align: justify;padding: 5px 10px;}
.order{}
.order img{width: 200px;height: 90px; margin-left: 400px; margin-top: 10px; margin-bottom:-15px; outline: none;}

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="division">
                <table class="tblone">
                            <tr>
                                <th >No</th>
                                <th >Product</th>                                
                                <th >Price</th>
                                <th >Quantity</th>
                                <th >Total</th>
                                
                            </tr>
                            <?php 
                               $getCartProduct = $ct->getCartProduct();
                               if ($getCartProduct) {
                                $i=0;
                                $sum =0;
                                $qty =0;
                                  while ($result = $getCartProduct->fetch_assoc()) {
                                    $i++;
                                    
                                  

                            ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['productName'] ;?></td>
                               <td>$<?php echo $result['price'] ;?></td>
                                <td><?php echo $result['quantity'] ;?></td>
                   
                                <td>$<?php 
                                      $total = $result['price'] * $result['quantity'];
                                echo $total;?></td>
                                
                            </tr>
                                    <?php
                                       $qty = $qty + $result['quantity'];
                                       $sum = $sum + $total;
                                       


                                    ?>

                            <?php  }}?>
                            
                            
                        </table>

                                

                        <table class="tbltwo">
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>$ <?php echo $sum;?></td>
                            </tr>
                            <tr>
                                <td>VAT : </td>
                                <td>:</td>
                                <td>10%($<?php echo $vat =$sum* 0.1;?>)</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td>$
                                    <?php 
                                           $vat =$sum* 0.1;
                                           $gTotal = $sum + $vat;
                                           echo $gTotal;
                                    ?>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td>Quantity</td>
                                <td>:</td>
                                <td><?php echo $qty;?></td>
                            </tr>
                       </table>

                                   
                
            </div>
            <div class="division">
                <?php
                $id= Session::get("cmrId");
                $getData = $cmr->getCustomerData($id);
                if ($getData ) {
                    while ($result = $getData->fetch_assoc()){ 
           ?>

            <table class="tblone">

                <tr>
                    <td colspan="3"><h2 style="text-align: center;">Your profile Details</h2></td>
                    
                    
                </tr>
                <tr>
                    <td width="20%">Name</td>
                    <td width="5%">:</td>
                    <td><?php echo $result['name'];?></td>
                    
                </tr>

                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address'];?></td>
                    
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city'];?></td>
                    
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country'];?></td>
                    
                </tr>

                <tr>
                    <td>Zip</td>
                    <td>:</td>
                    <td><?php echo $result['zip'];?></td>
                    
                </tr>

                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone'];?></td>
                    
                </tr>

                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'];?></td>
                    
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="editprofile.php">Update Details</a></td>
                    
                </tr>
                
            </table>
<?php } }?>
            </div>     
         
        </div>

                       <div class="order">
                            <a href="?orderid=order"> <img src="images/order.jpg" alt="" /></a>
                        </div>
                                  


            
<?php include 'inc/footer.php';?>