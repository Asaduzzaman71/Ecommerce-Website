<?php include 'inc/header.php'; ?>


<?php
if(isset($_GET['productid'] )){

    $id=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['productid']);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

        $quantity=$_POST['quantity'];
        $addcart=$ct->addToCart($quantity,$id);
    }
?>

 <?php 
    
     
        if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['compare'])){
        	 $productId=$_POST['productId'];
             $insertcom=$pd->insertCompareData($productId,$customerId);
        }
  ?>

   <?php 
    
        if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['wishlist'])){

             $insertwishlist=$pd->insertWishlistData($id,$customerId);
        }
  ?>

  <style>
  	.mybutton{width:100px;float:left;margin-right: 50px; }
  </style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

				<?php
					$getsingleproduct=$pd->getSingleProduct($id);
					if($getsingleproduct){
						while($result=$getsingleproduct->fetch_assoc()){

				?>

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result['productName']; ?>  </h2>				
						<div class="price">
							<p>Price: <span>$<?php echo $result['price']; ?></span></p>
							<p>Category: <span><?php echo $result['catName']; ?></span></p>
							<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
						</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<span style="color:red; font-size: 18px">
					<?php
						if(isset($addcart)){
							echo $addcart;
						}
					?>
				</span>

				<?php
						if(isset( $insertcom)){
							echo  $insertcom;
						}
						if(isset($insertwishlist)){
							echo  $insertwishlist;
						}
					?>


				<?php
		   		$login=Session::get("customer_login");
        		if($login==true){ ?>	
					

				<div class="add-cart">
					<div class="mybutton">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>  							
							<input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
					
						</form>
					</div>

					<div class="mybutton">
						<form action="" method="post">
								<input type="submit" class="buysubmit" name="wishlist" value="Save to list"/>
						</form>
					</div>
				</div>

				<?php }?>


			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body']; ?>
	    </div>
	    <?php
		}}
		?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					  <?php
					  $getcat=$cat->getAllCat();
					  if($getcat){
					  	while($result=$getcat->fetch_assoc()){
					  ?>
				      <li><a href="productbycat.php?catId= <?php echo $result['catId']; ?>"><?php  echo 
				      $result['catName'];?></a></li>
				      <?php
				        }
					  }
				      ?>
				     
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>



   <?php include 'inc/footer.php'; ?>