<?php include 'inc/header.php'; ?>
<?php
        $login=session::get("customer_login");
        if($login==false){
        	header("location:login.php");
        	}
   ?>


  <?php 
    
      $customerid=session::get("customer_id");
        if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
             $customerupdate=$cmr->customerProfileUpdate( $_POST,$customerid);
        }
  ?>
<style >
	.tblone{
		width: 550px;
		margin:0 auto;
		border:2px solid #ddd;
	}
	.tblone tr td{text-align: justify;}
    .tblone input[type="text"]{width:300px;padding: 5px;font-size: 15px}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    		       $id=session::get("customer_id");
    		       $getdata=$cmr->getCustomerData($id);
    		       if($getdata){
    		       	while($result=$getdata->fetch_assoc()){

    		       	?>
            <form action="" method="POST">

    		<table class="tblone">
              
                <?php
                if(isset($customerupdate)){

                     echo "<tr><td colspan='3'>".$customerupdate."</td></tr>";
                        
                    }
                ?>
                
    			<tr>
    				
    				<td colspan="3" style="text-align:center;"><h2>Update Profile Details</h2></td>
    			</tr>
    			<tr>
    				<!--<td width="20%">Name</td>
    				<td width="5%">:</td>-->
                    <td >Name</td>
    				<td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				
    				<td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    			
    			<td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    			
    			<td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
    			</tr>
    			<tr>
    				<td>City</td>
    			
    				<td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
    			</tr>
    			<tr>
    				<td>Zipcode</td>
    			
    			<td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
    			</tr>
    			<tr>
    				<td>Country</td>
    				<td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type="submit" name="submit" value="Save"></td>
    			</tr>
    		</table>
        </from>

    	<?php

    		       	}
    		       }
    		?>
				
 			
 		</div>
 	</div>
	</div>



   <?php include 'inc/footer.php'; ?>