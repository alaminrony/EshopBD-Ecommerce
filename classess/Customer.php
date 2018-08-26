<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Customer{

    private $db;
    private $fm;

    public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

   public function customerRegistration($data){
   	       $name            =$this->fm->validation($data['name']);
   	       $address         =$this->fm->validation($data['address']);
   	       $city            =$this->fm->validation($data['city']);
   	       $country         =$this->fm->validation($data['country']);
   	       $zip             =$this->fm->validation($data['zip']);
   	       $phone           =$this->fm->validation($data['phone']);
   	       $email           =$this->fm->validation($data['email']);
   	       $pass            =$this->fm->validation($data['pass']);
		

           $name            =mysqli_real_escape_string($this->db->link, $data['name']);
           $address         =mysqli_real_escape_string($this->db->link, $data['address']);
           $city            =mysqli_real_escape_string($this->db->link, $data['city']);
           $country         =mysqli_real_escape_string($this->db->link, $data['country']);
           $zip             =mysqli_real_escape_string($this->db->link, $data['zip']);
           $phone           =mysqli_real_escape_string($this->db->link, $data['phone']);
           $email           =mysqli_real_escape_string($this->db->link, $data['email']);
           $pass            =mysqli_real_escape_string($this->db->link, md5($data['pass']));

     if($name == '' || $address == '' || $city  == '' || $country  == '' ||$zip== '' || 
		    	$phone  == ''|| $email  == '' || $pass  == ''){
		    	$msg = "<span class='error'> Fields must not be empty !! </span>";
        	    return $msg;

		    }

		    $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
		    $mailchack = $this->db->select($mailquery);
		    if ($mailchack !=false) {
		    	$msg = "<span class='error'> Email already exist !! </span>";
        	    return $msg;
		    	
		    }

		    else{
		    	
		    	$query= "INSERT INTO tbl_customer(name, address, city, country,zip,phone,email,pass ) 
		    	VALUES('$name','$address', '$city','$country','$zip','$phone','$email','$pass')";

        	    $inserted_row =$this->db->insert($query);
        	               if($inserted_row){
        		           $msg ="<span class='success'> Registration Complete successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Registration Not Completed !</span>";
				    }
               }

          }

          public function customerLogin($data){
          	$email           =$this->fm->validation($data['email']);
          	$pass            =$this->fm->validation($data['pass']);
          	$email           =mysqli_real_escape_string($this->db->link, $data['email']);
            $pass            =mysqli_real_escape_string($this->db->link, md5($data['pass']));

            if($email  == '' || $pass  == ''){
		    	$msg = "<span class='error'> Fields must not be empty !! </span>";
        	    return $msg;

		    }

          	$query ="SELECT *FROM tbl_customer WHERE email='$email' AND pass='$pass'";
          	$result = $this->db->select($query );
          	if ($result != false) {
          		$value = $result->fetch_assoc();
          		Session::set("cmrLogin",true);
          		Session::set("cmrId",$value['id']);
          		Session::set("cmrName",$value['name']);
          		header("Location:cart.php");
          		
          	}else{
          		$msg = "<span class='error'> Email or Password didn't Match !! </span>";
        	    return $msg;

          	}

          }

          public function getCustomerData($id){
            $query ="SELECT * FROM tbl_customer WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
          }

          public function cmrProfileUpdate($data,$id){
           $name            =$this->fm->validation($data['name']);
           $address         =$this->fm->validation($data['address']);
           $city            =$this->fm->validation($data['city']);
           $country         =$this->fm->validation($data['country']);
           $zip             =$this->fm->validation($data['zip']);
           $phone           =$this->fm->validation($data['phone']);
           $email           =$this->fm->validation($data['email']);
           
    

           $name            =mysqli_real_escape_string($this->db->link, $data['name']);
           $address         =mysqli_real_escape_string($this->db->link, $data['address']);
           $city            =mysqli_real_escape_string($this->db->link, $data['city']);
           $country         =mysqli_real_escape_string($this->db->link, $data['country']);
           $zip             =mysqli_real_escape_string($this->db->link, $data['zip']);
           $phone           =mysqli_real_escape_string($this->db->link, $data['phone']);
           $email           =mysqli_real_escape_string($this->db->link, $data['email']);
         
            

      if($name == '' || $address == '' || $city  == '' || $country  == '' ||$zip== '' || 
          $phone  == ''|| $email  == '' ){
          $msg = "<span class='error'> Fields must not be empty !! </span>"; 
          return $msg;

        }

              
        else{
            $query ="UPDATE  tbl_customer 
                     SET
                       name= '$name',
                      address= '$address', 
                      city= '$city' ,
                      country= '$country', 
                      zip= '$zip', 
                      phone= '$phone', 
                      email= '$email' 
                     where id='$id'";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'> Profile Update successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'> Profile Not updated . </span>";
                return $msg;
            } 

        }  
  }
        
}
?>