<?php include 'inc/header.php'; ?>

 <?php
        $login=session::get("customer_login");
        if($login==true){
        	header("location:order.php");
        	}
   ?>
<?php 
    
   	 if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['login'])){
        $customerlogin=$cmr->customerLogin($_POST);
    	}
  ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	<?php
    			if(isset($customerlogin)){
    				echo $customerlogin;
    			}

    		?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST">
                	<input  type="text"      name="email"    placeholder="Email"/>
                    <input  type="password"  name="password"   placeholder="Password"/>
                     <div class="buttons">
                    	<div>
                    		<button class="grey" name="login">Sign In</button>
                    	</div>
                    </div>
            </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

        </div>

          <?php 
             $cmr=new Customer();
   			 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
        			$customerReg=$cmr->customerRegistration($_POST);

    		}
    		?>
    		<div class="register_account">
    		<?php
    			if(isset($customerReg)){
    				echo $customerReg;
    			}

    		?>

    		<h3>Register New Account</h3>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email" >
							</div>
		    			</td>
		    			<td>
							<div>
								<input type="text" name="address" placeholder="Address">
							</div>
								
		    				<div>
								<input type="text" name="country" placeholder="Country">
				 			</div>		        
	
		          	    	<div>
		          		  		 <input type="text" name="phone" placeholder="Phone">
		               		</div>
				  
				  			<div>
					 			 <input type="text" name="password" placeholder="Password">
							</div>
		           		</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Register</button></div></div>
		   
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>