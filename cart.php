<?php include 'inc/header.php'; ?>

<?php

	if(isset($_GET['cartId'])){
    	$cartId=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['cartId']);
    	$delproduct=$ct->delCartItemByCartId($cartId);
	}


    if($_SERVER['REQUEST_METHOD']=='POST'){
    	$cartId      =$_POST['cartId'];
        $quantity    =$_POST['quantity'];
        $updateCart  =$ct->updateCartQuantity($cartId,$quantity);
        if($quantity<=0){
        		$delproduct=$ct->delCartItemByCartId($cartId);

        }
    }
?>
<?php

    if(!isset($_GET['id'])){
    	echo"<meta http-equiv='refresh' content='0,URL=?id=live' />";
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php if(isset($updateCart)){
			    		echo $updateCart;
			    	} ?>
						<table class="tblone">
							<tr>
								<th width="5%">Sl</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$getproduct=$ct->getCartProduct();
								$i=0;
								$sum=0;
								$qty=0;
								if($getproduct){
									while($result=$getproduct->fetch_assoc()){
										$i++;
									

							?>

							
							<tr>

								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['price'];?></td>
								<td>
								<form action="" method="POST">
								<input type="hidden" name="cartId" value="<?php  echo $result['cartId'];?>"    />
								<input type="number" name="quantity" value="<?php echo $result['quantity'];?>" />
								<input type="submit" name="submit" value="Update"/>
								</form>
								</td>
								<td>$
									<?php

									$q=$result['quantity'];
									$p=$result['price'];
									$total=$p*$q;	
								 	echo $total;
								 	?>
								 
								 </td>
								<td><a onclick="return confirm('Are you sure to delete ..')"href="?cartId=<?php echo $result['cartId'];?>">Delete</a></td>
							</tr>

							<?php		
								  $sum=$sum+$total;
								  $qty=$qty+$result['quantity'];
								  Session::set("sum",$sum) ;
								  Session::set("qty",$qty) ;
								}}
							?>
							
						</table>
						<?php
							$getdata=$ct->checkCartTable();
							if($getdata){
							
						?>
							<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>Tk: <?php echo $sum;?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>Tk:
								<?php 
								 $vat=($sum*10)/100; 
								 $grand_total=$vat+$sum;
								 echo $grand_total;
								 ?>
								 </td>
							</tr>
					   </table>
					   <?php
					   		}
					   		else{
					   			header("Location:index.php");
					   		}
					   ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>