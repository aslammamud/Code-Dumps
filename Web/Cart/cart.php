<?php
$page='single';
$page_title = 'Shopping Cart';
include ('header.php');
$grand_total = 0;
?>
  
  <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          
         <div class="page-content page-order"><div class="page-title">
            <h2>Shopping Cart</h2>
          </div>
			<div class="order-detail-content">
              <div class="table-responsive">
                <table class="table table-bordered cart_summary">
                  <thead>
                    <tr>
                      <th class="cart_product">Product</th>
                      <th class="text-left">Description</th>
                      <th>Avail.</th>
                      <th>Unit price</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th  class="action"> <button id="cart_all_delete" style="background:#ff0000;" class="badge p-1"><i class="fa fa-trash-o"></i> Clear</button></th>
					</tr>
					
					<!-- before delete sweetalert code start -->
                    <script>
                      $(document).ready(function(){
                        $('#cart_all_delete').click(function(){
                          
                          Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't to clear your cart!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, clear it'
                          }).then((result) => {
                            if (result.isConfirmed) {
                                if(window.location.href = "cart-action?clear=all"){
                                  Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'This cart is clear!',
                                    showConfirmButton: false,
                                    timer: 2000,
                                  })
                                }
                            }
                          });

                        });
                      });
                    </script>
                    <!-- before delete sweetalert code End -->
					
                  </thead>
                  <tbody>
                    <?php
                    if(isset($_SESSION['CurrentCartSession']) && $_SESSION['CurrentCartSession'] != null){
                    $cart_session = $_SESSION['CurrentCartSession'];
                    $stmt = $con->prepare("SELECT * FROM cart WHERE cart_session = '$cart_session'");
                    $stmt->execute();
                    $result = $stmt->get_result();						
                    while ($row = $result->fetch_assoc()):
                    $code = $row['product_id'];
                    $product_s = "SELECT * FROM products WHERE product_id = '$product_id'"; 
                    $result_p_s = mysqli_query($con,$product_s);
                    $product = mysqli_fetch_assoc($result_p_s);
                    ?>
                    <tr>
                    <input type="hidden" class="product_id" value="<?= $row['id'] ?>">
                    <input type="hidden" class="product_price" value="<?= $row['product_price'] ?>">
                      <td class="text-left cart_product"><a href="#"><img src="admin/images/product_image/<?= $product['product_image'] ?>" alt="Product"></a></td>
                      <td class="text-left cart_description"><p class="product-name"><a href="#"><?= $product['product_name'] ?></a></p>
                      <small><a href="#">Brand : <?= $product['product_brand'] ?></a></small>
                      <small><a href="#">Rating : <?= $product['product_review'] ?></a></small></td>
                    <?php if($product['product_status']== 1){
                      echo '<td class="availability in-stock"><span class="label">In stock</span></td>';
                      }else{
                      echo '<td class="availability out-of-stock"><span class="label">Out of stock</span></td>';
                      } 
                    ?>
                      <td><span><?= number_format($row['product_price'],2); ?>  ৳ </span></td>
                      
                      <td class="product_quantity">
                          <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                        </td>
                      <td><span><?= number_format($row['total_price'],2); ?>  ৳ </span></td>
                      <td class="action">
							<input type="hidden" class="cart_item_delete_id" value="<?= $row['id'] ?>">
							<input type="hidden" class="cart_item_delete_name" value="<?= $row['product_name'] ?>">
							<a style="color:red;" href="javascript:void(0)" class="cart_item_delete_button"><i class="icon-close"></i></a>
						  </td>
                    </tr>        
                    <?php $grand_total += $row['total_price']; ?>
                    <?php endwhile; ?>			
                    <?php } ?>
                  </tbody>
				  
				  product_id
				  product_price
				  product_quantity
				  
                  <tfoot>
                   <!-- <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Total (products tax incl.)</td>
                      <td colspan="2"><?= number_format($grand_total,2); ?>  ৳ </td>
                    </tr>-->
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3"><strong>Cart Total</strong></td>
                      <td style="padding-left: 20px;" class="text-left" colspan="2"><strong><?= number_format($grand_total,2); ?>  ৳ </strong></td>
                    </tr>					
                  </tfoot>
                </table>
              </div>
              <div>
<style>
 .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
  border-radius: 5px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.card-body{
    padding: 15px;
}

.float-container {
    padding: 20px;
}

.float-child {
    width: 50%;
    float: left;
    padding: 20px;
}

</style>
            <div class="float-container">
                <div class="float-child">
                      <div class="card">
                         <div class="bg-info card-body">
                        <h2 style="color:#ee284b;" class="card-title">Extra Payment Details</h2>
                      </div>
                    </div>
                    <div class="card">
                         <div class="bg-info card-body">
                        <h4 class="text-primary card-subtitle mb-2 text-muted">Cash On Delivery</h4>
                        <p class="card-text">Inside Daka Delivery Charge - 60 ৳<br>Outside Dhaka Courier Charge - 120 ৳</p>
                      </div>
                    </div>
                    <div class="card">
                      <div class="bg-info card-body">
                        <h4 class="text-primary card-subtitle mb-2 text-muted">Pay With Bkash</h4>
                        <p class="card-text">Payment Instructions: 
                        <br>Mobile Number: <strong>017********</strong>
                        <br> You have to pay via Bkash SEND MONEY</p>
                        <p style="color:#ee284b;">* Standard Bkash SEND MONEY Charges Applicable</p>
                        
                      </div>
                    </div> 
                </div>

               <div class="float-child">
                      <div class="card">
                         <div class="bg-info card-body">
                        <h2 style="color:#5cb85c;" class="card-title">Discount Offers</h2>
                      </div>
                    </div>
                    
                    <div class="card">
                         <div class="bg-info card-body">
                        <h4 class="text-primary card-subtitle mb-2 text-muted">Flat Discount On Sale</h4>
                        <p class="card-text">Buy more than 2000 ৳ products and get discount upto 199 ৳ </p>
                      </div>
                    </div>
                    
                    <div class="card">
                      <div class="bg-info card-body">
                        <h4 class="text-primary card-subtitle mb-2 text-muted">Coupons</h4>
                        <p class="card-text">Apply coupons and instantly get discount.</p>
                      </div>
                    </div>
                </div>
                      
                      <div class="cart_navigation"> <a class="continue-btn" href="index.php"><i class="fa fa-arrow-left"> </i>&nbsp; Continue shopping</a> <a class="checkout-btn" href="checkout.php"><i class="fa fa-check"></i> Proceed to checkout</a> </div>
              </div>
             </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
    <!-- service section -->
  <div class="jtv-service-area">
    <div class="container">
      <div class="row">
        <div class="col col-md-3 col-sm-6 col-xs-12">
          <div class="block-wrapper ship">
            <div class="text-des">
              <div class="icon-wrapper"><i class="fa fa-paper-plane"></i></div>
              <div class="service-wrapper">
                <h3>All Bangladesh Shipping</h3>
                <p>On order over ৳ 999</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-md-3 col-sm-6 col-xs-12 ">
          <div class="block-wrapper return">
            <div class="text-des">
              <div class="icon-wrapper"><i class="fa fa-rotate-right"></i></div>
              <div class="service-wrapper">
                <h3>30 Days Return</h3>
                <p>Moneyback guarantee </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-md-3 col-sm-6 col-xs-12">
          <div class="block-wrapper support">
            <div class="text-des">
              <div class="icon-wrapper"><i class="fa fa-umbrella"></i></div>
              <div class="service-wrapper">
                <h3>Support 24/7</h3>
                <p>Call us: ( +123 ) 456 789</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-md-3 col-sm-6 col-xs-12">
          <div class="block-wrapper user">
            <div class="text-des">
              <div class="icon-wrapper"><i class="fa fa-tags"></i></div>
              <div class="service-wrapper">
                <h3>Monthly Discount</h3>
                <p>25% on order over ৳ 1499</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  
  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".product_quantity").on('change', function() {
      var $el = $(this).closest('tr');

      var product_id = $el.find(".product_id").val();
      var pprice = $el.find(".pprice").val();
      var product_quantity = $el.find(".product_quantity").val();
      location.reload(true);
      $.ajax({
        url: 'cart-action.php',
        method: 'post',
        cache: false,
        data: {
          product_quantity: product_quantity,
          product_id: product_id,
          product_price: product_price
        },
        success: function(response) {
          console.log(response);
        }
      });
    });
  });
  </script>
  
<!-- JS --> 
<?php
include ('footer.php');
?>