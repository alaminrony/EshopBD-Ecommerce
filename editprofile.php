<?php include 'inc/header.php';?>

<!--jodi ligin na thake, tahole login page a redirect kore dibe-->
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }
?>

<!--customer er ID dhore tar all information Method a pathano  -->
<!--customer class 108 no line er method  -->
<?php
    $id = Session::get("cmrId");
    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
    $cmrProfileUpdate = $cmr->cmrProfileUpdate($_POST,$id);
    }
?>

<style >
.tblone{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td{text-align: justify;}
.tblone input[type="text"]{width: 300px;padding: 5px; font-size: 15px; }
</style>


<div class="main">
    <div class="content">
        <div class="section group">
             <!--customer er ID dhore tar all details database thake tule ana -->
             <!--customer class er 102 line-->
            <?php
             $id= Session::get("cmrId");
             $getData = $cmr->getCustomerData($id);
            if ($getData ) {
             while ($result = $getData->fetch_assoc()){ 
           ?>
            

            <form action="" method="post">
    		<table class="tblone">

                 <?php
                     if (isset($cmrProfileUpdate)) {
                        echo "<tr><td colspan='2'>".$cmrProfileUpdate."</td> </tr>";                
                     }
                 ?>

                <tr>
                    <td colspan="2"><h2 style="text-align: center;">Update profile Details</h2></td>
                </tr>           
               
            
                <tr>
                    <td width="20%">Name</td>
                  
                    <td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
                    
                </tr>

                <tr>
                    <td>Address</td>
                    
                    <td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
                    
                </tr>
                <tr>
                    <td>City</td>
                   
                    <td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
                    
                </tr>
                <tr>
                    <td>Country</td>
                    
                    <td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
                    
                </tr>

                <tr>
                    <td>Zip</td>
                    
                    <td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
                    
                </tr>

                <tr>
                    <td>Phone</td>
                    
                    <td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
                    
                </tr>

                <tr>
                    <td>Email</td>                      
                    <td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
                    
                </tr>

                <tr>
                    <td></td>
                    
                    <td><input type="submit" name="submit" value="save"></td>
                    
                </tr>
                
            </table>
            </form>
<?php } }?>
         
    		
    	</div>
   
    </div>
 </div>
<?php include 'inc/footer.php';?>