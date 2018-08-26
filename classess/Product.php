<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>



<?php
class Product{
	 private $db;
	 private $fm;
	
	 public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}


	public function productInsert($data, $file){

		$productName   =$this->fm->validation($data['productName']);
		$catId         =$this->fm->validation($data['catId']);
		$brandId       =$this->fm->validation($data['brandId']);
		$body          =$this->fm->validation($data['body']);
		$price         =$this->fm->validation($data['price']);
		

		$productName    =mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId          =mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId        =mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body           =mysqli_real_escape_string($this->db->link, $data['body']);
		$price          =mysqli_real_escape_string($this->db->link, $data['price']);
		$type           =mysqli_real_escape_string($this->db->link, $data['type']);
		
       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if($productName == '' || $catId == '' || $brandId  == '' || $body  == '' ||$price== '' || 
		    	$file_name  == ''|| $type  == ''){
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
        	    return $msg;

		    }
		     elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB! </span>";
			    } 

			 elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			    }

		    
		    else{
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query= "INSERT INTO tbl_product(productName, catId, brandId, body,price,image,type ) 
		    	VALUES('$productName','$catId', '$brandId','$body','$price','$uploaded_image','$type')";

        	    $inserted_row =$this->db->insert($query);
        	               if($inserted_row){
        		           $msg ="<span class='success'> product insert successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Image Not Inserted !</span>";
				    }
				        	
				 }
			}


	public function getAllProduct(){
		      /*  JOIN BY ARRIES JOIN  */

		   $query = "SELECT p.*, c.catName , b.brandName
		             FROM tbl_product as p, tbl_category as c, tbl_brand as b
		             WHERE p.catId = c.catId AND p.brandId= b.brandId
		             ORDER BY p.productId DESC    "; 


		    
		    /*  JOIN BY INNER JOIN  */
        
		/*	$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
			          FROM tbl_product
			          INNER JOIN tbl_category
			          ON tbl_product.catId =  tbl_category.catId

			          
			          INNER JOIN tbl_brand
			          ON tbl_product.brandId =  tbl_brand.brandId
			          ORDER BY tbl_product.productId DESC "; */

         
          $result = $this->db->select($query);
        return $result;
        

	}


	 public function getProductById($id){
        $query =  "SELECT * FROM tbl_product where productId='$id'";
        $result = $this->db->select($query);
        return $result;

    }

    public function productUpdate($data, $file, $id){
    	$productName   =$this->fm->validation($data['productName']);
		$catId         =$this->fm->validation($data['catId']);
		$brandId       =$this->fm->validation($data['brandId']);
		$body          =$this->fm->validation($data['body']);
		$price         =$this->fm->validation($data['price']);
		

		$productName    =mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId          =mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId        =mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body           =mysqli_real_escape_string($this->db->link, $data['body']);
		$price          =mysqli_real_escape_string($this->db->link, $data['price']);
		$type           =mysqli_real_escape_string($this->db->link, $data['type']);
		
       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		  if($productName == '' || $catId == '' || $brandId  == '' || $body  == '' ||$price== '' || $type  == '')
		  {
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
        	    return $msg;

		    }
		      else{
					if (!empty($file_name)) {
					      	 	
					      	 

					     if ($file_size >1048567) {
						     echo "<span class='error'>Image Size should be less then 1MB! </span>";
						    } 

						 elseif (in_array($file_ext, $permited) === false) {
						     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						    }

					    
					    else{
					    	move_uploaded_file($file_temp, $uploaded_image);

					    	$query= "UPDATE tbl_product
					    	         SET 
					    	         productName = '$productName',
					    	         catId       = '$catId',
					    	         brandId     = '$brandId',
					    	         body        = '$body',
					    	         price       = '$price',
					    	         image       = '$uploaded_image',
					    	         type        = '$type'
					    	         WHERE productId ='$id' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> product Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Product Not Update !</span>";
							          }
				        	
				        	}
				    
				    } 
				       
				       else{

					    						    	
					    	$query= "UPDATE tbl_product
					    	         SET 
					    	         productName = '$productName',
					    	         catId       = '$catId',
					    	         brandId     = '$brandId',
					    	         body        = '$body',
					    	         price       = '$price',					    	         
					    	         type        = '$type'
					    	         WHERE productId ='$id' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> product Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Product Not Update !</span>";
							    }

				    }
				 
         
            }
    }

         

        public function delProductById($id){

        	    $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        	    $getData = $this->db->select($query);

        	    if ($getData) {
        	    	while ($delImg =$getData->fetch_assoc()) {
        	    	 $delLink =	$delImg['image'];
        	    	 unlink($delLink);

        	    		
        	    	}
        	    }
        
		         $delquery ="DELETE from tbl_product where productId='$id'";
		         $delData  =$this->db->delete($delquery);

		         if($delData){
		                $msg ="<span class='success'> Product Deleted successfully. </span>";
		                return $msg;
		            }
		            else{
		                $msg ="<span class='error'> Product Not Deleted . </span>";
		                return $msg;
		            }   

		    }
	
	public function getFeaturedProduct(){

		 $query =  "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
        
	}

	public function getNewProduct(){
		 $query =  "SELECT * FROM tbl_product  ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;

	}


	public function getSingleProduct($id){
		 $query = "SELECT p.*, c.catName , b.brandName
		             FROM tbl_product as p, tbl_category as c, tbl_brand as b
		             WHERE p.catId = c.catId AND p.brandId= b.brandId AND p.productId ='$id' "; 
		   $result = $this->db->select($query);
           return $result;

	}



	 public function latestFromIphone(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}

	public function latestFromSamsung(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}

	public function latestFromAcer(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}

	public function latestFromCanon(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}


	//product by brand

	 public function AllFromIphone(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
	}

	public function AllFromSamsung(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
	}

	public function AllFromAcer(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
	}

	public function AllFromCanon(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
	}

	public function AllFromHP(){
		 $query =  "SELECT * FROM tbl_product WHERE brandId='9' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
	}



	public function productByCat($id){
		$catId=$this->fm->validation($id);
		$catId=mysqli_real_escape_string($this->db->link,$id);


		$query =  "SELECT * FROM tbl_product where catId='$catId'";
        $result = $this->db->select($query);
        return $result;
		

	}

	 



}
?>

