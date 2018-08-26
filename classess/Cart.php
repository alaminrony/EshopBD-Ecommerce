<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>


<?php

class Cart{

    private $db;
    private $fm;

    public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

   
   public function addToCart($quantity, $id){
   	 $quantity   =$this->fm->validation($quantity);
		 $quantity   =mysqli_real_escape_string($this->db->link, $quantity);
		 $productId   =mysqli_real_escape_string($this->db->link, $id);
		 $sId        = session_id();

		 $squery = "SELECT * FROM tbl_product WHERE productId ='$productId '";
		 $result =$this->db->select($squery)->fetch_assoc();

		 $productName =$result['productName'];
     $price =$result['price'];
     $image =$result['image'];

     $chkquery ="SELECT * FROM tbl_cart WHERE productId ='$productId ' AND sId='$sId ' ";
     $getProduct =$this->db->select($chkquery);
        if ($getProduct) {
           $msg ="Product Already Added !";
           return $msg;
       
     } 

     else {

         $query= "INSERT INTO tbl_cart(sId, productId, productName, price, quantity,image) 
		    	VALUES('$sId','$productId', '$productName','$price','$quantity','$image')";

        	    $inserted_row =$this->db->insert($query);
        	               if($inserted_row){
        	               	header("Location:Cart.php");
        		           
        	               }

        	               else {
                          header("Location:404.php");
				                }
                    }    

  } 


      public function getCartProduct(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $result = $this->db->select($query);
        return $result;

      }    


      public function updateCartQuantity($cartId, $quantity){
        $cartId      =$this->fm->validation($cartId);
        $quantity    =$this->fm->validation($quantity);
        $cartId      =mysqli_real_escape_string($this->db->link,$cartId);
        $quantity    =mysqli_real_escape_string($this->db->link,$quantity);

        
       $query ="UPDATE  tbl_cart 
                     SET quantity= '$quantity' 
                     where cartId='$cartId'";
                     $update_row = $this->db->update($query);

              if($update_row){
              header("Location:cart.php");
            }
            else{
                $msg ="<span class='error'> Quantity Not updated . </span>";
                return $msg;
            }                

      }  

      public function delProductByCart($delId){
        $delId      =$this->fm->validation($delId);
        $delId      =mysqli_real_escape_string($this->db->link,$delId);

       $query ="DELETE from tbl_cart where cartId='$delId'";
         $delData  =$this->db->delete($query);

         if($delData){
               echo "<script> window.location = 'cart.php';</script>";
            }
            else{
                $msg ="<span class='error'> product Not Deleted . </span>";
                return $msg;
            }   
      } 


      public function chackCartTable(){
         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $result = $this->db->select($query);
        return $result;
      } 

      public function delCustomerData(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
        $this->db->delete($query);

      }  
         

      //Data insert using rettrive from cart table into order table.

      public function orderProduct($cmrId){
         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $getProduct = $this->db->select($query);
        if ($getProduct) {
              while ($result = $getProduct->fetch_assoc()) {
                $productId =$result['productId'];
                $productName =$result['productName'];               
                $quantity =$result['quantity'];
                $price =$result['price']* $quantity;
                $image =$result['image'];

                 $query= "INSERT INTO tbl_order(cmrId, productId, productName, quantity,price,image) 
                 VALUES('$cmrId','$productId', '$productName','$quantity','$price','$image')";

              $inserted_row =$this->db->insert($query);
                

               
              }
        }
      }
    
    // for success page
     public function PayableAmount($cmrId){

       $query = "SELECT price from tbl_order WHERE cmrId='$cmrId' AND date = now()";
        $result = $this->db->select($query);
     
        return $result;
        
     }

     // for Order details by specific customar orderdetails.php 30 number line

     public function getOrderProduct($cmrId){
       $query = "SELECT * from tbl_order WHERE cmrId='$cmrId' Order by date DESC";
        $result = $this->db->select($query);
        return $result;

     }

     public function chackOrder($cmrId){
        $query = "SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
        $result = $this->db->select($query);
        return $result;
     }

     public function getOrderDetails(){
       $query = "SELECT * FROM tbl_order Order By date DESC";
        $result = $this->db->select($query);
        return $result;
     }

     public function productShifted($id, $price, $date){
         $id      =$this->fm->validation($id);
         $price   =$this->fm->validation($price);
         $date    =$this->fm->validation($date);

        $id       =mysqli_real_escape_string($this->db->link,$id);
        $price    =mysqli_real_escape_string($this->db->link,$price);
        $date     =mysqli_real_escape_string($this->db->link,$date);

     $query ="UPDATE  tbl_order 
                     SET 
                     status ='1'
                     where cmrId='$id' AND price='$price' AND date='$date' ";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'> Update successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'> Not updated . </span>";
                return $msg;
            }       
     }


    public function productDeleted($id, $price, $date){
         $id      =$this->fm->validation($id);
         $price   =$this->fm->validation($price);
         $date    =$this->fm->validation($date);

        $id       =mysqli_real_escape_string($this->db->link,$id);
        $price    =mysqli_real_escape_string($this->db->link,$price);
        $date     =mysqli_real_escape_string($this->db->link,$date);

        $query ="DELETE from tbl_order where cmrId='$id' AND price='$price' AND date='$date' ";
         $delData  =$this->db->delete($query);

         if($delData){
                $msg ="<span class='success'>DELETE successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Not Deleted . </span>";
                return $msg;
            }   
    }


    public function OrderConfirm($id, $price, $date){
       $id=$this->fm->validation($id);
    $id=mysqli_real_escape_string($this->db->link,$id);

    $price=$this->fm->validation($price);
    $price=mysqli_real_escape_string($this->db->link,$price);

    $date=$this->fm->validation($date);
    $date=mysqli_real_escape_string($this->db->link,$date);

     $query ="UPDATE  tbl_order 
                     SET 
                     status ='2'
                     where cmrId='$id' AND price='$price' AND date ='$date' ";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'> Confirm successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'> Not Confirm successfully . </span>";
                return $msg;
            }      

    }

     
          
  




}
?>
