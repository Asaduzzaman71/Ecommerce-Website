<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php    
  
     $filepath=realpath(dirname(__FILE__));
     include_once($filepath.'/../classes/Cart.php');
     include_once($filepath.'/../helpers/Format.php');
     $ct=new Cart();
	 $fm=new Format();

?>
<?php 
	if(isset($_GET['shifted'])){
		$id=$_GET['shifted'];
		$date=$_GET['time'];
		$price=$_GET['price'];
		$shift=$ct->productShifted($id,$date,$price);

	}

	if(isset($_GET['delproid'])){
		$id=$_GET['delproid'];
		$date=$_GET['time'];
		$price=$_GET['price'];
		$delorder=$ct->delShiftedProduct($id,$date,$price);

	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                   if(isset($shift)){
                   	echo $shift;
                   }
                ?>

                 <?php
                   if(isset($delorder)){
                   	echo $delorder;
                   }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Order Time </th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer Id</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							
							$getOrder=$ct->getAllOrderProduct();
							if($getOrder){
								while($result=$getOrder->fetch_assoc()){
						?>

						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><?php echo $result['customerId']; ?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId']; ?>">View Details</a></td>
							<?php
							if($result['status']=='0'){?>
								<td><a href="?shifted=<?php echo $result['customerId'];?> & price=<?php echo $result['price'];?> & time=<?php echo $result['date'];?>"> Shifted </a></td>
							<?php } else if($result['status']=='1'){ ?>
								<td>Pending</td>
							   <?php } else{?>

							   		<td><a href="?delproid=<?php echo $result['customerId'];?> & price=<?php echo $result['price'];?> & time=<?php echo $result['date'];?>">Remove </a></td>


							   <?php } ?>
							
							
						</tr>

						<?php }} ?>
					
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
