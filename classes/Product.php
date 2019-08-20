	
<?php    

     $filepath=realpath(dirname(__FILE__));
     include_once($filepath.'/../lib/Database.php');
     include_once($filepath.'/../helpers/Format.php');

?>
<?php
   class Product
	{

	   private $db;
	   private $fm;

	    public function __construct ()
		{
			$this->db=new Database();
			$this->fm=new Format();

		}
	

	public function productInsert($data,$file)
		{

			$productName=$this->fm->validation($data['productName']);
			$catId=$this->fm->validation($data['catId']);
			$brandId=$this->fm->validation($data['brandId']);
			$b0dy=$this->fm->validation($data['body']);
			$price=$this->fm->validation($data['price']);
			$type=$this->fm->validation($data['type']);

			$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
			$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
			$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
			$body=mysqli_real_escape_string($this->db->link,$data['body']);
			$price=mysqli_real_escape_string($this->db->link,$data['price']);
			$type=mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
  		    $file_name = $file['image']['name'];
   		    $file_size = $file['image']['size'];
   		    $file_temp = $file['image']['tmp_name'];

   		    $div = explode('.', $file_name);
    		$file_ext = strtolower(end($div));
    		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    		$uploaded_image = "upload/".$unique_image;




		if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" ||$type==""||$file_name==""){
				$msg=" <span class='error'>Field  must not be empty !</span>";
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
					$query="INSERT into tbl_product(productName,catId,brandId,body,price,image,type) 
					values('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')" ;

					$productInsert=$this->db->insert($query);
					if($productInsert){
						$msg="<span class='success'> Product inserted successfully...</span>";
						return $msg;
					}
					else{


						$msg="<span class='error'>Product not inserted </span>";
						return $msg;
					}
				}
			
		}



		public function getAllProduct(){
					  $query="SELECT   tbl_product.*,tbl_category.catName,tbl_brand.brandName 
					  FROM tbl_product
					  INNER JOIN  tbl_category
					  ON tbl_product.catId=tbl_category.catID

					  INNER JOIN tbl_brand
					  ON tbl_product.brandId=tbl_brand.brandID
					  ORDER BY productId ASC";
					  
					  $result=$this->db->select($query);
					  return $result;

		}

		public function getProductById($id){
					  $query="SELECT  * FROM tbl_product WHERE productId='$id'";
					  $result=$this->db->select($query);
					  return $result;

		}




		public function productUpdate($data,$file,$id){

			
			$productName=$this->fm->validation($data['productName']);
			$catId=$this->fm->validation($data['catId']);
			$brandId=$this->fm->validation($data['brandId']);
			$b0dy=$this->fm->validation($data['body']);
			$price=$this->fm->validation($data['price']);
			$type=$this->fm->validation($data['type']);

			$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
			$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
			$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
			$body=mysqli_real_escape_string($this->db->link,$data['body']);
			$price=mysqli_real_escape_string($this->db->link,$data['price']);
			$type=mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
  		    $file_name = $file['image']['name'];
   		    $file_size = $file['image']['size'];
   		    $file_temp = $file['image']['tmp_name'];

   		    $div = explode('.', $file_name);
    		$file_ext = strtolower(end($div));
    		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    		$uploaded_image = "upload/".$unique_image;




			if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type==""){
				$msg=" <span class='error'>Field  must not be empty !</span>";
				return $msg;
			}
			else{
					if( ! empty($file_name)){
						if ($file_size >1048567) {
				    		 echo "<span class='error'>Image Size should be less then 1MB! </span>";
				    		}

				   		else if (in_array($file_ext, $permited) === false) {
				    		 echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
				   		 }

						else{

							move_uploaded_file($file_temp, $uploaded_image);

							$query="UPDATE tbl_product 
									SET productName='$productName',
									    catID      ='$catId',
									    brandID    ='$brandId',
									    body       ='$body',
									    price      ='$price',
									    image      ='$uploaded_image',
									    type       ='$type'
									    WHERE productId='$id'  ";
							$productUpdate=$this->db->update($query);
							if($productUpdate){
								$msg="<span class='success'> Product updated successfully...</span>";
								return $msg;
							}
							else{


								$msg="<span class='error'>Product not updated </span>";
								return $msg;
							}
						}
					}
					else{

						$query="UPDATE tbl_product 
									SET productName='$productName',
									    catID      ='$catId',
									    brandID    ='$brandId',
									    body       ='$body',
									    price      ='$price',
									    type       ='$type'
										WHERE productId='$id' ";
							$productUpdate=$this->db->update($query);
							if($productUpdate){
								$msg="<span class='success'> Product updated successfully...</span>";
								return $msg;
							}
							else{


								$msg="<span class='error'>Product not updated </span>";
								return $msg;
							}

					}
		}


	}


	public function delProductById($id){
           $query="SELECT  * FROM tbl_product WHERE productId='$id'";
		   $result=$this->db->select($query);
			if($getdata){
				while($delImg=$getData->fetch_assoc){
					$dellink=$delImg['image'];
					unlink($dellink);
				}
				$msg="<span class='success'>Product deleted successfully...</span>";
					return $msg;

			}
		    
		    $delquery="DELETE FROM tbl_product WHERE productId='$id'";
			$deldata=$this->db->delete($delquery);
			if($deldata){
				$msg="<span class='success'>Product deleted successfully...</span>";
					return $msg;

			}
			else{
					$msg=" <span class='error'>Product not deleted !</span>";
				return $msg;
				}

		
	}

    public function	getFeaturedProduct(){

    	  $query="SELECT  * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
    	  $result=$this->db->select($query);
    	  return $result;


    }


      public function	getNewProduct(){

    	  $query="SELECT  * FROM tbl_product  ORDER BY productId DESC LIMIT 4";
    	  $result=$this->db->select($query);
    	  return $result;


    }


    public function getSingleProduct($id){

    	  $query="SELECT   tbl_product.*,tbl_category.catName,tbl_brand.brandName 
					  FROM tbl_product
					  INNER JOIN  tbl_category
					  ON tbl_product.catId=tbl_category.catID

					  INNER JOIN tbl_brand
					  ON tbl_product.brandId=tbl_brand.brandID
					  WHERE productId='$id'";
					  
					  $result=$this->db->select($query);
					  return $result;

    }

 public function latestFromApple(){

 		  $query="SELECT  * FROM tbl_product WHERE brandId='9' ORDER BY productId DESC LIMIT 1";
    	  $result=$this->db->select($query);
    	  return $result;
 		}

  public function latestFromSamsung(){

 		  $query="SELECT  * FROM tbl_product WHERE brandId='10' ORDER BY productId DESC LIMIT 1";
    	  $result=$this->db->select($query);
    	  return $result;
 		}

  public function latestFromAccer(){

 		  $query="SELECT  * FROM tbl_product WHERE brandId='7' ORDER BY productId DESC LIMIT 1";
    	  $result=$this->db->select($query);
    	  return $result;
 		}
 public function latestFromLg(){

 		  $query="SELECT  * FROM tbl_product WHERE brandId='12' ORDER BY productId DESC LIMIT 1";
    	  $result=$this->db->select($query);
    	  return $result;
 		}

 public function getProductByCatId($id){
 	  $catId=mysqli_real_escape_string($this->db->link,$id);
 	  $query="SELECT  * FROM tbl_product WHERE catId='$catId' ";
	  $result=$this->db->select($query);
	  return $result;

   }

   public function insertCompareData($productId,$customerId){


   		 $productId=mysqli_real_escape_string($this->db->link,$productId);
   		 $customerId=mysqli_real_escape_string($this->db->link,$customerId);

   		   $cquery= "SELECT * FROM tbl_compare  WHERE customerId ='$customerId'  AND  productId='$productId' ";
   		   $check=$this->db->select($cquery);
   		    if($check){
   		    	$msg="<span class='error'>Already added</span>";
						return $msg;
   		    }
   		    else{




   		  $query="SELECT  * FROM tbl_product WHERE productId='$productId'  ";
		  $result=$this->db->select($query)->fetch_assoc();
		    if($result){

		    		$productId=$result['productId'];
		    		$productName=$result['productName'];
		    		$price=$result['price'] ;
		       		$image=$result['image'];

		    		$insertquery="INSERT INTO tbl_compare(customerId,productId,productName,price,image) 
					VALUES ('$customerId','$productId','$productName','$price','$image')" ;
					 $insertedrow=$this->db->insert($insertquery);

					 if($insertedrow){
						$msg="<span class='success'>Added !Check compare page.</span>";
						return $msg;

						}
					else{
						$msg="<span class='error'>Not added</span>";
						return $msg;
						}

		    	}
		    }
			    	  
		    
		 }



		 public function getCompareProduct($customerId){

		 $query= "SELECT * FROM tbl_compare  WHERE customerId ='$customerId' ORDER BY id DESC";
		 	   $result=$this->db->select($query);
		 	   return $result;

		 }


		 public function delCompareData($customerId){

		 	   $query="DELETE FROM tbl_compare WHERE customerId ='$customerId' ";
		 	   $result=$this->db->delete($query);
	 		   return $result;



		 }


		 public function insertWishlistData($id,$customerId){



		   $cquery= "SELECT * FROM tbl_wishlist  WHERE customerId ='$customerId'  AND  productId='$id' ";
   		   $check=$this->db->select($cquery);
   		    if($check){
   		    	$msg="<span class='error'>Already added</span>";
						return $msg;
   		    }







		 	$pquery="SELECT  * FROM tbl_product WHERE productId='$id' ";
		    $getpro=$this->db->select($pquery)->fetch_assoc();
		    if($getpro){
		    		$productId=$getpro['productId'];
		    		$productName=$getpro['productName'];
		    		$price=$getpro['price'] ;
		       		$image=$getpro['image'];

		    		$query="INSERT INTO tbl_wishlist(customerId,productId,productName,price,image) 
					VALUES ('$customerId','$productId','$productName','$price','$image')" ;
					$result=$this->db->insert($query);

					 if($result){
						$msg="<span class='success'>Added !Check wishlist page.</span>";
						return $msg;

						}
					else{
						$msg="<span class='error'>Not added</span>";
						return $msg;
						}

		    	}
		    }


		public function getWishList($customerId){

		       $query= "SELECT * FROM tbl_wishlist  WHERE customerId ='$customerId' ORDER BY id DESC";
		 	   $result=$this->db->select($query);
		 	   return $result;

		    }



		   
		public function delWishListData($customerId,$productId){

		    $query="DELETE FROM tbl_wishlist WHERE customerId ='$customerId' AND productId='$productId' ";
		    $result=$this->db->delete($query);
	 	     return $result;

		    }
		 


   


	}
?>