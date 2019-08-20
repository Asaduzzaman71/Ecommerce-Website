<?php    

   
    $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/Database.php');
     include_once ($filepath.'/../helpers/Format.php');
?>




<?php


	class Customer
	{

	   private $db;
	   private $fm;

	    public function __construct ()
		{
			$this->db=new Database();
			$this->fm=new Format();

		}

		public function customerRegistration($data){
			$name=$this->fm->validation($data['name']);
			$address=$this->fm->validation($data['address']);
			$city=$this->fm->validation($data['city']);
			$zip=$this->fm->validation($data['zip']);
			$country=$this->fm->validation($data['country']);
			$phone=$this->fm->validation($data['phone']);
			$email=$this->fm->validation($data['email']);
			$password=$this->fm->validation($data['password']);

			$name=mysqli_real_escape_string($this->db->link,$data['name']);
			$address=mysqli_real_escape_string($this->db->link,$data['address']);
			$city=mysqli_real_escape_string($this->db->link,$data['city']);
			$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
			$country=mysqli_real_escape_string($this->db->link,$data['country']);
			$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
			$email=mysqli_real_escape_string($this->db->link,$data['email']);
			$password=mysqli_real_escape_string($this->db->link,md5($data['password']));

			if($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" ||$phone==""||$email==""||$password==""){
				$msg=" <span class='error'>Field  must not be empty !</span>";
				return $msg;
			}
			
			 $mailquery="SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
			 $mailcheck=$this->db->select($mailquery);
			 if($mailcheck!=false){
			 	$msg=" <span class='error'>Email already exist !</span>";
				return $msg;
			 }
			else{
					$query="INSERT INTO tbl_customer (name,address,city,country,zip,phone,email,password) 
					values('$name','$address','$city','$country','$zip','$phone','$email','$password')" ;

					$customerInfoInsert=$this->db->insert($query);

					if($customerInfoInsert){
						$msg="<span class='success'> Csutomer information inserted successfully...</span>";
						return $msg;
					}
					else{


						$msg="<span class='error'>Customer information not inserted </span>";
						return $msg;
					}

				}

		}

		public function customerLogin($data){

			$email=$this->fm->validation($data['email']);
			$email=mysqli_real_escape_string($this->db->link,$data['email']);

			$password=$this->fm->validation($data['password']);	
			$password=mysqli_real_escape_string($this->db->link,md5($data['password']));

			if($email =="" || $password =="" ){
				$msg=" <span class='error'>Field  must not be empty !</span>";
				return $msg;
			}


			$query="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
		    $result=$this->db->select($query);
			  if($result!=false){
			  	$value=$result->fetch_assoc();
			  	session::set("customer_login",true);
			  	session::set("customer_id",$value['id']);
			  	session::set("customer_name",$value['name']);
			  	header("location:cart.php");
			  }else{
			  	$msg="<span class='error'>Email or password not matched !</span>";
				return $msg;
		}


		}
		public function getCustomerData($id){
			 $query=" SELECT * FROM tbl_customer WHERE id='$id' ";
			 $result=$this->db->select($query);
			 return $result;

		}

		public function customerProfileUpdate( $data,$customerid){

			$name=$this->fm->validation($data['name']);
			$address=$this->fm->validation($data['address']);
			$city=$this->fm->validation($data['city']);
			$zip=$this->fm->validation($data['zip']);
			$country=$this->fm->validation($data['country']);
			$phone=$this->fm->validation($data['phone']);
			$email=$this->fm->validation($data['email']);
		
			$name=mysqli_real_escape_string($this->db->link,$data['name']);
			$address=mysqli_real_escape_string($this->db->link,$data['address']);
			$city=mysqli_real_escape_string($this->db->link,$data['city']);
			$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
			$country=mysqli_real_escape_string($this->db->link,$data['country']);
			$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
			$email=mysqli_real_escape_string($this->db->link,$data['email']);

			if($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" ||$phone==""||$email==""){
				$msg=" <span class='error'>Field  must not be empty !</span>";
				return $msg;
			}
			else{
			
			$query="UPDATE tbl_customer 
									SET name      ='$name',
									    address   ='$address',
									    city     ='$city',
									    zip       ='$zip',
									    country   ='$country',
									    phone     ='$phone',
									    email     ='$email'
									    WHERE id='$customerid'  ";
			 $update=$this->db->update($query);
			 if($update){
						$msg="<span class='success'> Csutomer information updated successfully...</span>";
						return $msg;
					}
					else{


						$msg="<span class='error'>Customer information not updated </span>";
						return $msg;
					}
			}

		}
	}
?>