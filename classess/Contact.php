<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Contact{
	 	private $db;
	 	private $fm;
	
		public function __construct(){
			$this->db=new Database();
			$this->fm=new Format();
	}

     public function contactForm($data){
           $name          =$this->fm->validation($data['name']);
           $email         =$this->fm->validation($data['email']);
           $mobile        =$this->fm->validation($data['mobile']);
           $subject       =$this->fm->validation($data['subject']);
        

           $name          =mysqli_real_escape_string($this->db->link, $data['name']);
           $email         =mysqli_real_escape_string($this->db->link, $data['email']);
           $mobile        =mysqli_real_escape_string($this->db->link, $data['mobile']);
           $subject       =mysqli_real_escape_string($this->db->link, $data['subject']);
          

     if($name == '' || $email == '' || $mobile  == '' || $subject  == '' ){
                $msg = "<span class='error'> Fields must not be empty !! </span>";
                return $msg;

            }

           

            else{
                
                $query= "INSERT INTO tbl_contact(name, email, mobile, subject) 
                VALUES('$name','$email', '$mobile','$subject')";

                $inserted_row =$this->db->insert($query);
                           if($inserted_row){
                           $msg ="<span class='success'>Massage Sent successfully. </span>";
                           return $msg;
                           }

                           else {
                          echo "<span class='error'>Massage Not Sent !</span>";
                    }
               }

          }



          public function getContactData(){
            $query ="SELECT * FROM tbl_contact ORDER BY contact_id DESC";
            $result = $this->db->select($query);
            return $result;
          }

           public function getMassageById($id){
            $query ="SELECT * From tbl_contact WHERE contact_id='$id'";
            $result = $this->db->select($query);
            return $result;
          }

        public function MassageDeletedById($delid){
        
        $query ="DELETE from tbl_contact where contact_id='$delid'";
         $delData  =$this->db->delete($query);

         if($delData){
                $msg ="<span class='success'>Massage DELETE successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Massage Not Deleted . </span>";
                return $msg;
            }   

    }


	





}
?>