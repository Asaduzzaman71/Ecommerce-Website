<?php include 'inc/header.php'; ?>
<?php
if(isset($_GET['delwishlistid'])){
    	$productId=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delwishlistid']);
    	$delwlist=$pd-> delWishListData($customerId,$productId);
	}
?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>WishList</h2>
			    	
						<table class="tblone">
							<tr>
								<th >Sl</th>
								<th>Product Name</th>
								<th >Image</th>
			    				<th >Price</th>				
								<th >Action</th>
							</tr>


							<?php
							
								$getproduct=$pd->getWishList($customerId);
								$i=0;
								if($getproduct){
									while($result=$getproduct->fetch_assoc()){
										$i++;
									

							?>						
						
							<tr>

								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>$<?php echo $result['price'];?></td>
								<td>
									<a href="details.php?productid=<?php echo $result['productId']; ?>">Buy Now</a> || <a href="?delwishlistid=<?php echo $result['productId']; ?>">Remove</a> 
								</td>
								
							</tr>
							

							
						
					   <?php
					   		}}  ?>
					  </table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width:100%; text-align:center">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>