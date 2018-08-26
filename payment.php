<?php include 'inc/header.php';?>

<!--jodi ligin na thake, tahole login page a redirect kore dibe-->
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }

?>

<style >
.payment{width: 500px; min-height: 200px;text-align: center;border: 2px solid #ddd; margin: 0 auto;padding: 50px;}
.payment h2{border-bottom: 2px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
.payment a{background: #334431;color: #fff;font-size: 26px;padding: 5px 30px;border-radius: 10px;}
.back a{width: 160px; margin:5px auto 0;padding: 7px;text-align: center;display: block;background: #555;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 20px;}


</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="payment">
                <h2>Choose your Payment Option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
                <a href="paymentonline.php">Online Payment</a> 
                
                             
            </div>

           

            <div class="back">
                <a href="cart.php">Previous</a>
            </div>

           
    		
    	
        </div>
    
       </div>
    </div>
<?php include 'inc/footer.php';?>