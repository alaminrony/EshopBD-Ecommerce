<?php include 'inc/header.php';?>

<!--jodi ligin na thake, tahole login page a redirect kore dibe-->
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }

?>

<style >
.psuccess{width: 500px; min-height: 200px;text-align: center;border: 2px solid #ddd; margin: 0 auto;padding: 20px;}
.psuccess h2{border-bottom: 2px solid #ddd; margin-bottom: 20px; padding-bottom: 10px;}
.psuccess p{line-height: 25px;text-align: justify; font-size: 18px;}

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="psuccess">
                <?php
             
                   $cmrId = Session::get("cmrId");
                 $Amount = $ct->PayableAmount($cmrId);

                 if ( $Amount) {
                    $sum = 0;
                    
                    while ($result = $Amount->fetch_assoc()) {
                        $price = $result['price'];
                        $sum = $sum + $price;
                        
                       
                    }
                 }
                   ?>
                <h2>Success</h2>
                 <p style="color: red;">Total Payable Amount(Including VAT) :$
                    <?php 
                   
                   $vat = $sum * 0.1;
                   $total = $vat+ $sum;
                    echo $total;
                   



                    ?>

                        
                </p>
                <p>Thanks For Purchase. Receive your Order Successfully. We will contact With you as soon as possible with delivery Details. Here is your Order....<a href="orderdetails.php">Visit Here</a></p>


                
                
                             
            </div>

           

           

           
    		
    	
        </div>
    
       </div>
    </div>
<?php include 'inc/footer.php';?>