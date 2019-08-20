<?php include 'inc/header.php'; ?>
<?php
        $login=session::get("customer_login");
        if($login==false){
        	header("location:login.php");
        	}
   ?>
<style>
    .psuccess{ width: 500px;min-height:200px;text-align:center;border: 1px solid #ddd ;margin:0 auto;padding:20px; }
    .psuccess h2{
                border-bottom: 1px solid #ddd;
                margin-bottom: 20px;
                padding-bottom: 10px;
    }
    
    .psuccess p{
        line-height: 25px;
        font-size: 18px;
        text-align: left;
    }
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="psuccess">

            <h2>Success</h2>
             <?php
                $customerId=Session::get("customer_id");
                $amount=$ct->payableAmount($customerId);
                if($amount){ 
                $sum = 0;           
                while($result=$amount->fetch_assoc()) {
                        $price=$result['price'];
                        $sum=$sum+$price;
                    }
                     
                 
                
             ?>

             <p style="color:red">Total Payable Amount(Includeing Vat):  </p> 
                <?php  
                    $vat=$sum * 0.1;
                    $total=$sum + $vat;
                    echo  '$'.$total;
                    } 
                ?>
            
           
           
           
              <p>Thaks for purchase.Receive your order successfully.We will contact with you ASAP with delivery details.Here is your order details..... <a href="order.php"> Visit here </a> </p>

           

            </div>
 			
 		</div>
 	</div>
	</div>



   <?php include 'inc/footer.php'; ?>