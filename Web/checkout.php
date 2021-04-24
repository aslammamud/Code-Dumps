<?php 
$page='single';
include('dynamic-meta.inc.php');
$dynamic_title="Checkout Cart | Stylishvalley.com";
include('header.php');
include('single_nav.php');

if(isset($_SESSION['eb_lgn']) AND $_SESSION['eb_lgn'] == true){
    
    $_SESSION['unloggeduser'] = false;
	unset($_SESSION['unloggeduser']);
	
    }else{
       $_SESSION['unloggeduser'] = true;
       echo reloader('login_page',0);
       die();
    }

  if(isset($_SESSION['CurrentCartSession']) && $_SESSION['CurrentCartSession'] != null){
	$cart_session = $_SESSION['CurrentCartSession']; 
	$grand_total = 0;

	$sql = "SELECT product_price AS prodPrice,qty,product_name , total_price FROM cart WHERE cart_session = '$cart_session'";
	$result = mysqli_query($con,$sql);

	$count = mysqli_num_rows($result);
	if($count>0){
	  while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];

	}
	}else{
		echo reloader('cart',0);
		exit();
		die();
	}
  }
  
  // Checkout and save order in the orders table
	if (isset($_POST['submit'])) {
	        
	        $amount_to_pay = get_safe_value($con,htmlspecialchars($_POST['amount_to_pay']));
            $shipping_area = htmlspecialchars($_POST['shipping_area']);
            $customerid = get_safe_value($con,htmlspecialchars($_POST['customerid']));
            $address = get_safe_value($con,htmlspecialchars($_POST['address']));
            $pmode = get_safe_value($con,htmlspecialchars($_POST['pmode']));
    
            $coupon_code = htmlspecialchars($_POST['true_coupon']);
            
            $query_coupon = "SELECT * FROM coupon WHERE coupon_code = '$coupon_code'";
            $result_coupon = mysqli_query($con, $query_coupon);
            $coupon_data = mysqli_fetch_assoc($result_coupon);
            $count_coupon = mysqli_num_rows($result_coupon);
            
            if($count_coupon > 0 ){
                $coupon_id = $coupon_data['id'];
                $discount = $coupon_data['coupon_discount'];
                $coupon_type = $coupon_data['coupon_type'];

                $user_limit = $coupon_data['user_limit'];
            }
            
            
            
            
		
		
		if(isset($_SESSION['CurrentCartSession']) && $_SESSION['CurrentCartSession'] != null){
            $cart_session = $_SESSION['CurrentCartSession'];
            $date = date("Y-m-d");
            $order_status = "Pending";
            
            if(isset($coupon_id)){

               $insert_order_query = "INSERT INTO orders (customer_id,coupon_id,order_token,order_date,address,shipping_area,pmode,amount_to_pay,order_status) VALUES('$customerid','$coupon_id','$cart_session','$date','$address','$shipping_area','$pmode','$amount_to_pay','$order_status')";
                
            }else{
                $insert_order_query = "INSERT INTO orders (customer_id,order_token,order_date,address,shipping_area,pmode,amount_to_pay,order_status) VALUES('$customerid','$cart_session','$date','$address','$shipping_area','$pmode','$amount_to_pay','$order_status')";
            }
		  
                 $result_order_insert = mysqli_query($con,$insert_order_query);
                $_SESSION['CurrentCartSession'] = generateRandomString();
                $_SESSION['InvoiceGenerate'] = true;

                echo '<script>
                   asAlertMsg({
        				  type: "success",
        				  title: "Your order has been taken!",
        				  message: "Thank You For Shopping in Stylishvalley.",
        				});
        				
        			</script>';
                echo reloader('invoice',1200);
                exit();
                die();

		} 
			
	}
  
?>

<style>
 .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
  border-radius: 5px;
  margin-left: 18px;
  margin-top: 20px;
  padding: 20px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

 .bd-clipboard {
	 position: relative;
	 float: right;
	 display: block;
 }
 .btn-clipboard {
	 position: absolute;
	 top: .4rem;
	 right: .5rem;
	 z-index: 10;
	 display: block;
	 padding: .25rem .5rem;
	 cursor: pointer;
	 pointer-events: none;
	 border: none;
	 border-radius: .25rem;
 }

</style>

<section class="checkout bg-white">
    <div class="container">
        <h3 style="margin-top: 30px;" class="page-title">Checkout</h3>      
            <div class="row" id="order">
			 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">				
			  
                <div class="col-md-4 col-sm-12">                    
                    <?php
					if(isset($_SESSION['eb_lgn']) AND $_SESSION['eb_lgn'] == true){
                        $select_query = "SELECT * FROM user WHERE user_id = '$eb_user_id'";
						$user_info = mysqli_fetch_assoc(mysqli_query($con, $select_query));
						
						echo '<div class="page-section">
                        <div class="section-head">
                            <h4 style="margin-top: 20px; margin-bottom: 20px; "><span> </span>Customer Information</h4>
                        </div>
                        <div class="address">
                            <div class="form-group">
                                <input class="form-control" name="name" type="text" placeholder="Customer Name*" value="'.$user_info['user_name'].'" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Customer Email*" value="'.$user_info['user_email'].'" readonly>
                            </div>
                           <div class="form-group">
                                  <div class="text-center">
            					 <div class="bd-clipboard">
                                    <button id="myTooltip" type="button" class="btn-clipboard btn btn-success" data-toggle="tooltip" data-placement="top">Verified</button>
                                 </div>
                                   <input type="tel"  name="phone" class="form-control" placeholder="Customer Phone*" value="'.$user_info['user_phone'].'" readonly>
                                 </div>
                            </div>                            
                        </div>
						
						<div class="section-head">
                                    <h4 style="margin-top: 30px; margin-bottom: 10px;"> Delivery</h4>
                                </div>
                            <h6>Delivery Location</h6>             
							<div>
                                <select name="shipping_area" id="shipping" onchange="getSelectValue()" class="form-control">
                                    <option value="Inside Dhaka" selected>Inside Dhaka</option>
                                    <option value="Outside Dhaka">Outside Dhaka</option>
                                </select>
                            </div>
                            
                            <br>
							<label style="margin-bottom:15px;">
                                 <p class="text-muted">*Inside Daka Delivery Charge - 60 ৳<br>
								 *Outside Dhaka Courier Charge - 120 ৳</p>
								
                            </label>
                            <div class="form-group">
                              <textarea class="form-control" name="address" rows="4" placeholder="Shiping Address*" required>'.$user_info['user_location'].'</textarea>
                            </div>
						</div>';
						
					}
						?>
					
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row row-payment-delivery-order">
                        <div class="col-md-8 col-sm-12 payment-methods">
							 <div class="page-section">
								<div class="section-head">
									<h4 style="margin-top: 20px; margin-bottom: 20px;"><span> </span>Payment Method</h4>
								</div>
								<div class="accepted-logo">
								  <div class="form-group">
									<select name="pmode" id="inputGetway" onchange="getSelectdPayMethodValue()" class="form-control">
										<option value="Cash On Delivery" selected>Cash On Delivery</option>
										<option value="Bkash">Bkash</option>
									</select>
								  </div>

								</div>
								<!--<div class="input-group">
                                 <input type="text" name="voucher" placeholder="Gift Voucher" id="input-voucher" class="form-control">
                                 <span class="input-group-btn"><button type="button" id="button-voucher" data-loading-text="Loading..." class="btn btn-warning">Apply Voucher</button></span>
                                 </div>-->
								<br>
											<!--<div class="input-group">-->
                           <!--             <input type="text" class="form-control" placeholder="Promo or Coupon Code" id="input_coupon" name="coupon">-->
                           <!--             <span class="input-group-btn">-->
                           <!--                 <button type="submit" name="submit_coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-success">Apply Coupon Code</button>-->
                           <!--             </span>-->
                           <!--         </div>-->
								<div class="input-group">
                                    <input type="text" class="form-control coupon_item_input" placeholder="Promo or Coupon Code" id="input_coupon" name="coupon">
                                    <input type="hidden" name="true_coupon" id="true_coupon" value="">
                                    <input type="hidden" name="coupon_discount" id="set_coupon_discount" value="">
                    				<span class="input-group-btn">
                    				    <a style="color:white;" id="applied_coupon" href="javascript:void(0)" class="btn btn-primary apply_coupon_btn">Apply Coupon Code</a>
                    				    </span>
                                </div>
                                <div id="couponmsg"></div>
							</div>
                        </div>
                        
                        <script>
                            var CouponChecker = document.getElementById("true_coupon").value;
                            if(CouponChecker == true){
                                var ThePrice = document.getElementById("grand_total_price").value;
                                
                                document.getElementById("grand_t_p").innerHTML = Number(grandTotalOriginal + 120)+" ৳";
                                document.getElementById("grand_total_price").value = Number(grandTotalOriginal + 120);
                            }
                        
                                function getSelectValue(){
                                    
                                    var selectedValue = document.getElementById("shipping").value;
                                    var selectdPayMethodValue = document.getElementById("inputGetway").value;
                                    var grandTotal = Number(document.getElementById("grand_total_price").value);
                                    var grandTotalReset = Number(document.getElementById("grand_total_remain_same").value);
                                    var bkash =  Number((grandTotalReset*2)/100);
                                    
                                    
                                    if(selectedValue == "Inside Dhaka" && selectdPayMethodValue == "Bkash"){
                                        grandTotal = grandTotalReset;
                                        
                                        document.getElementById("set_shipping").innerHTML = "60 ৳";
                                        document.getElementById("grand_t_p").innerHTML = Number(grandTotal + 60 + bkash)+" ৳";
                                        document.getElementById("grand_total_price").value = Number(grandTotal + 60 + bkash);
                                    
                                        
                                    } else if(selectedValue == "Inside Dhaka" && selectdPayMethodValue == "Cash On Delivery"){
                                        grandTotal = grandTotalReset;
                                        
                                        document.getElementById("set_shipping").innerHTML = "60 ৳";
                                        document.getElementById("grand_t_p").innerHTML = Number(grandTotal + 60)+" ৳";
                                        document.getElementById("grand_total_price").value = Number(grandTotal + 60);
                                    
                                        
                                    } else if(selectedValue == "Outside Dhaka" && selectdPayMethodValue == "Bkash"){
                                        grandTotal = grandTotalReset;
                                        
                                        document.getElementById("set_shipping").innerHTML = "120 ৳";
                                        document.getElementById("grand_t_p").innerHTML = Number(grandTotal + 120 + bkash)+" ৳";
                                        document.getElementById("grand_total_price").value = Number(grandTotal + 120 + bkash);
                                        
                                    }else if(selectedValue == "Outside Dhaka" && selectdPayMethodValue == "Cash On Delivery"){
                                        grandTotal = grandTotalReset;
                                        
                                        document.getElementById("set_shipping").innerHTML = "120 ৳";
                                        document.getElementById("grand_t_p").innerHTML = Number(grandTotal + 120)+" ৳";
                                        document.getElementById("grand_total_price").value = Number(grandTotal + 120);
                                    }
                                }

                                function getSelectdPayMethodValue(){
                                    
                                        var selectedValue = document.getElementById("shipping").value;
                                        var selectdPayMethodValue = document.getElementById("inputGetway").value;
                                        var grandTotalOriginal = Number(document.getElementById("grand_total_remain_same").value);
                                        var bkash =  Number((grandTotalOriginal*2)/100);
                                        
                                        
                                        if(selectdPayMethodValue == "Bkash" && selectedValue == "Inside Dhaka"){
                                            document.getElementById("grand_t_p").innerHTML = Number(grandTotalOriginal + 60 + bkash)+" ৳";
                                            document.getElementById("grand_total_price").value = Number(grandTotalOriginal + 60 + bkash);
                                            
                                        }else if(selectdPayMethodValue == "Bkash" && selectedValue == "Outside Dhaka"){
                                             document.getElementById("grand_t_p").innerHTML = Number(grandTotalOriginal + 120 + bkash)+" ৳";
                                             document.getElementById("grand_total_price").value = Number(grandTotalOriginal + 120 + bkash);
                                            
                                        }else{
                                            
                                            var selectedValue = document.getElementById("shipping").value;
        
                                            if(selectedValue == "Inside Dhaka"){
                                                document.getElementById("grand_t_p").innerHTML = Number(grandTotalOriginal + 60)+" ৳";
                                                document.getElementById("grand_total_price").value = Number(grandTotalOriginal + 60);
                                            }else if(selectedValue == "Outside Dhaka"){
                                                document.getElementById("grand_t_p").innerHTML = Number(grandTotalOriginal + 120)+" ৳";
                                                document.getElementById("grand_total_price").value = Number(grandTotalOriginal + 120);
                                            }
                                            
                                        }
                                    }
                        </script>

                        <div class="bg-info col-md-12 col-sm-12 card">
                            <div class="page-section">
                                <div class="section-head">
                                    <h2 style="color:#14b04f; margin-top: 5px; margin-bottom: 20px;">Order Overview</h2>
                                </div>
                                <table style="width: 95%;" class="koyla-table bg-white checkout-data">
                                    <thead>
                                      <tr>
                                        <td style="font-weight: 100px !important; font-size:18px; color: #4608ad;" style="font-weight: 0px !important; font-size:18px" class="text-left" colspan="3" style="margin-top: 10px; margin-bottom: 10px;">Products</td>
                                        <td style="font-weight: 100px !important; font-size:18px; color: #4608ad;"  class="text-right" style="margin-top: 10px; margin-bottom: 10px;">Quantity</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($result as $row){
                                            echo '<tr><td style="font-weight: 0px !important; font-size:15px;" class="text-left" colspan="3" class="name">'.$row['product_name'].'</td>
                                            <td style="font-weight: 0px !important; font-size:15px;" class="text-right">'.$row['qty'].'&nbsp &nbsp&nbsp &nbsp</td>
                                            </tr>';
                                        }
                                    
                                    ?>
                                       
                                    <tr><td>&nbsp</td></tr>
                                    <tr>
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;" style="font-weight: 0px !important; font-size:18px" style="font-weight: 0px !important; font-size:18px" style="font-weight: 0px !important; font-size:18px" class="text-left" colspan="3">Sub-Total:</td>
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;" style="font-weight: 0px !important; font-size:18px" style="font-weight: 0px !important; font-size:18px" class="text-right"><?= $grand_total ?> ৳</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;" style="font-weight: 0px !important; font-size:18px" class="text-left" colspan="3">Shipping Rate:</td>
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;"class="text-right" id="set_shipping">60 ৳</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;" class="text-left" colspan="3">Total:</td>
                                        <input type="hidden" name = "amount_to_pay" id = "grand_total_price" value="<?= $grand_total+60 ?>">
                                        <input type="hidden" id = "grand_total_remain_same" value="<?= $grand_total ?>">
                                        <td style="font-weight: 0px !important; font-size:18px; color: #4608ad;" class="text-right" id = "grand_t_p"><?= $grand_total+60 ?> ৳</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right" style="margin-top: 20px">
                              I have read and agree to the 
                              <a href="###" target="_blank"><b>Terms and Conditions (Warranty Policy)</b></a>, 
                              <a href="###" target="_blank"><b>Privacy Policy</b></a> and 
                              <a href="###" target="_blank"><b>Refund and Return Policy</b></a>                                                                
                              <input type="checkbox" name="agree" value="1" checked="checked">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
				<div class="cart_navigation"> <a class="continue-btn" href="cart"><i class="fa fa-arrow-left"> </i>&nbsp; Back To Cart</a>  

				<input style="margin-bottom: 30px;"  class="btn submit-btn pull-right btn-primary" type="submit" name="submit" value="Confirm Order">
				
				</div>
				
			  <input type="hidden" name="customerid" value="<?php echo $eb_user_id; ?>">
            </form>
            

            
		</div>
    </div>
    
</section>

<?php 
include('footer.php');
?>
