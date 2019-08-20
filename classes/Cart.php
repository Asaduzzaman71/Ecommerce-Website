<?php    

   
     $filepath=realpath(dirname(__FILE__));
     include_once($filepath.'/../lib/Database.php');
     include_once($filepath.'/../helpers/Format.php');

?>




<?php


	class Cart
	{

	   private $db;
	   private $fm;

	    public function __construct ()
		{
			$this->db=new Database();
			$this->fm=new Format();

		}
	

	public function addToCart($quantity,$id){


		    $quantity=$this->fm->validation($quantity);
		    $quantity=mysqli_real_escape_string($this->db->link,$quantity);
		    $productId=mysqli_real_escape_string($this->db->link,$id);
		    $sId=session_id();
		    $squery="SELECT  * FROM tbl_product WHERE productId='$productId' ";
		    $result=$this->db->select($squery)->fetch_assoc();

		    $productName=$result['productName'];
		    $price=$result['price'];
		    $image=$result['image'];
		    $checkquery=$squery="SELECT  * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
		    $checkrow=$this->db->select($squery);
		    if($checkrow){
		    	$msg="Product already added";
		    	return $msg;
		    }
		    else{

		    $query="INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) 
					VALUES ('$sId','$productId','$productName','$price','$quantity','$image')" ;

					$cartInsert=$this->db->insert($query);
					if($cartInsert){
						header("Location:cart.php");
					}
					else{

						header("Location:404.php");
				
					}

			}
		}

	public function getCartProduct(){
		$sId=session_id();
		  $query="SELECT  * FROM tbl_cart WHERE sId='$sId'";
		  $result=$this->db->select($query);
		 return $result;
	}


	public function updateCartQuantity($cartId,$quantity){

			$cartId=$this->fm->validation($cartId);
			$quantity=$this->fm->validation($quantity);
			$cartId=mysqli_real_escape_string($this->db->link,$cartId);
			$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		
				$query="UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId' ";
				$updated_row=$this->db->update($query);
				if($updated_row){
						header("Location:cart.php");
				}
				else{
					$msg=" <span class='error'>Quantity not updated !</span>";
				return $msg;
				}

			}

	public function delCartItemByCartId($cartId){
			$cartId=mysqli_real_escape_string($this->db->link,$cartId);
			$query="DELETE FROM tbl_cart WHERE cartId='$cartId'";
			$deldata=$this->db->delete($query);
			if($deldata){
				echo "<script>window.location='cart.php';</script>";

			}
			else{
					$msg=" <span class='error'>Cart not deleted !</span>";
					return $msg;
				}
		}

	public  function checkCartTable(){
		$sId=session_id();
		  $query="SELECT  * FROM tbl_cart WHERE sId='$sId'";
		  $result=$this->db->select($query);
		  return $result;
	}

	public function delCustomerCart(){
			$sId=session_id();
			$query="DELETE FROM tbl_cart WHERE sId='$sId'";
			$this->db->delete($query);

	}
	public function orderProduct($customer_id){
			$sId=session_id();
			$query="SELECT  * FROM tbl_cart WHERE sId='$sId'";
		    $getpro=$this->db->select($query);
		    if($getpro){
		    	while($result=$getpro->fetch_assoc()){
		    		$productId=$result['productId'];
		    		$productName=$result['productName'];
		    		$quantity=$result['quantity'];
		    		$price=$result['price'] * $quantity;
		       		$image=$result['image'];

		    		$query="INSERT INTO tbl_order(customerId,productId,productName,quantity,price,image) 
					VALUES ('$customer_id','$productId','$productName','$quantity','$price','$image')" ;
					 $result=$this->db->select($query);

		    	}
		    }

	}

	public function payableAmount($customerId){
		$query="SELECT price FROM tbl_order WHERE customerId = '$customerId' AND date=now()";
		$result=$this->db->select($query);
		return $result;

	}

	public function getOrderProduct($customerId){
		$query="SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY date DESC";
		$result=$this->db->select($query);
		return $result;

	}

	public function checkOrder($customerId){
		  $query="SELECT  * FROM tbl_order WHERE customerId='$customerId'";
		  $result=$this->db->select($query);
		  return $result;

	}

	public function getAllOrderProduct(){
		  $query="SELECT  * FROM tbl_order ORDER BY date DESC";
		  $result=$this->db->select($query);
		  return $result;

	}


	
	public function productShifted($id,$time,$price){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$date=mysqli_real_escape_string($this->db->link,$time);
		$price=mysqli_real_escape_string($this->db->link,$price);

		$query="UPDATE tbl_order SET status='1' WHERE customerId='$id' AND date='$date' AND price='$price' ";
				$update_row=$this->db->update($query);
				if($update_row){
					$msg="<span class='success'>Updated successfully...</span>";
					return $msg;
				}
				else{
					$msg=" <span class='error'>Not updated !</span>";
				return $msg;
				}

	}

	public function delShiftedProduct($id,$date,$price){

		$id=mysqli_real_escape_string($this->db->link,$id);
		$date=mysqli_real_escape_string($this->db->link,$date);
		$price=mysqli_real_escape_string($this->db->link,$price);

		$query="DELETE FROM tbl_order WHERE customerId = '$id' AND date='$date' AND price='$price' ";
				$del_row=$this->db->delete($query);
				if($del_row){
					$msg="<span class='success'>Data deleted successfully...</span>";
					return $msg;
				}
				else{
					$msg=" <span class='error'>Data not deleted !</span>";
				return $msg;
				}


	}


	public function productShiftConfirm($id,$date,$price){

		$id=mysqli_real_escape_string($this->db->link,$id);
		$date=mysqli_real_escape_string($this->db->link,$date);
		$price=mysqli_real_escape_string($this->db->link,$price);

		$query="UPDATE tbl_order SET status='2' WHERE customerId='$id' AND date='$date' AND price='$price' ";
				$update_row=$this->db->update($query);
				if($update_row){
					$msg="<span class='success'>Updated successfully...</span>";
					return $msg;
				}
				else{
					$msg=" <span class='error'>Not updated !</span>";
				return $msg;
				}

	}

	





}
