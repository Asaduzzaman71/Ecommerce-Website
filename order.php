<?php include 'inc/header.php';?>
<?php
        $login=session::get("customer_login");
        if($login==false){
        	header("location:login.php");
        	}
   ?>


<?php 
  	if(isset($_GET['customerId'])){
		$id=$_GET['customerId'];
		$date=$_GET['time'];
		$price=$_GET['price'];
		$confirm=$ct->productShiftConfirm($id,$date,$price);

	}
  ?>
<style >
	.tblone tr td{
		text-align: justify;
	}
</style>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>Your ordered details</h2>
				<table class="tblone">
							<tr>
								<th >No</th>
								<th >Product Name</th>
								<th >Image</th>
								<th >Quantity</th>			
								<th >Price</th>
								<th >Total Price</th>
								<th >Date</th>
								<th >Status</th>
								<th > Action </th>
							</tr>
							<?php
								$customerId=Session::get("customer_id");
								$getOrder=$ct->getOrderProduct($customerId);
								$i=0;
								$sum=0;
								$qty=0;
								if($getOrder){
									while($result=$getOrder->fetch_assoc()){
										$i++;
									

							?>
							
							<tr>

								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['quantity'];?></td>
								<td>$<?php echo $result['price'];?></td>

								<td>$<?php
	
								 	echo $result['price'];
								 ?>
								 
								 </td>

								<td><?php echo $fm->formatDate($result['date']);?></td>
								
							    <td>
									<?php
										if($result['status']=='0'){
											echo "pending";
										}
										else if($result['status']=='1'){
											
											echo "Shifted";
										
										 }
									  	else{
											echo "Ok";
										}
									?>
								</td>
								

								<td>
								<?php
									if($result['status']=='0'){
										echo "N/A";
									}
									elseif($result['status']=='1'){ ?>
									<a href="?customerId=<?php echo $customerId ;?> & price=<?php echo 
											$result['price'];?> & time=<?php echo $result['date'];?>"> Confirm </a>
									<?php } elseif($result['status']=='2'){
										echo "Ok";
									}
										?>
											
								</td>
								
						</tr>

						<?php }}?>

							
							
					</table>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php';?>