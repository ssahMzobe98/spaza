<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\OrderPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $OrderPdo = new OrderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN && isset($_POST['request'])){
    $orderData=$OrderPdo->orderSummary($_POST['request']);
    date_default_timezone_set('Africa/Johannesburg');
 	?>
  <style>
    .button a{
      color: white;
    background: #0A2558;
    padding: 4px 12px;
    font-size: 15px;
    font-weight: 400;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    }
  </style>
 		<div class="fullBody-tech">
 			<div class="modal-header">
        <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">ORDER <?php echo $_POST['request'];?></h4>
      </div>
 			<div class="headerTech" style="display:flex;width: 100%;">
        <div style="padding:10px 10px;width:30%;">
            <div style="padding: 5px 5px; border-radius:10px;border:2px solid #ddd;">
               <center><h3 style="text-align:center;text-decoration-line: underline;text-decoration-color: #dddddd;text-decoration-style: solid;text-decoration-thickness: 2px;">Order Details</h3></center>
            </div>
        </div>
 				<div style="padding:10px 10px;width:70%;">
              <div style="padding: 5px 5px; border-radius:10px;border:2px solid #ddd;">
                 <center><h3 style="text-align:center;text-decoration-line: underline;text-decoration-color: #dddddd;text-decoration-style: solid;text-decoration-thickness: 2px;">Order Summary</h3></center>
                 <div style="padding:0 10px;width: 100%;">
                  <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product Details</th>
                            <th>Quantity</th>
                            <th>Comments</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Picked</th>
                            <th>OOS Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $orderInvoiceTotal=0;
                        $orderTotal=$orderData[0]['order_total'];
                        $is_paid=$orderData[0]['is_paid'];
                        $is_accepted=$orderData[0]['is_accepted'];
                        $is_invoiced=$orderData[0]['is_invoiced'];
                        $btn = '<a style="color:white;" class="invoiceOrder" onclick="invoiceOrder('.$_POST['request'].')">INVOICE ORDER</a>';
                        if($is_paid==='N'){
                          $btn = '<a style="color:white;" class="invoiceOrder">WAITING FOR PAYMENT</a>';
                        }
                        else{
                          if($is_accepted==='N'){
                            $btn = '<a style="color:white;" class="invoiceOrder" onclick="acceptOrder('.$_POST['request'].')">ACCEPT ORDER</a>';
                          }
                          else{
                            if($is_invoiced==='Y'){
                              $btn = '<a style="color:white;" class="invoiceOrder">ORDER INVOICED</a>';
                            }
                          }
                        }
                        //echo"<pre>";print_r($orderData);echo"</pre>";
                        foreach($orderData as $summary){
                            $order_id=$summary['order_id'];
                            $product=$summary['product_id'];
                            $label=$summary['label'];
                            $price=$summary['price'];
                            $quantity=$summary['quantity'];
                            $total_price = $price*$quantity;
                            $orderInvoiceTotal+=$total_price;
                            $is_instock=$summary['is_instock'];
                            $is_picked=($summary['is_picked']=='Y')?"checked":"";
                            $comments=$summary['comments'];
                            echo'
                            <tr >
                                <td style="color:#000000;">'.$label.'</td>
                                <td style="color:#000000;">'.$quantity.'</td>
                                <td>'.$comments.'</td>
                                <td style="color:#000000;">R'.number_format($price,2).'</td>
                                <td style="color:#000000;">
                                    <div>
                                        R'.number_format($total_price,2).'
                                    </div>
                                    <span class="removeThisProductFromOrder" style="color:red;font-size: x-small;cursor: pointer;" onclick="removeThisProductFromOrder('.$order_id.','.$product.')">Remove Product</span>
                                </td>
                                <td><input type="radio" oninput="markDownPicker('.$order_id.','.$product.')" '.$is_picked.' style="padding:20px 20px;"></td>
                                <td><input type="number" class="OOS_val_'.$product.'" style="padding:2px 2px;width:90px;border-radius:10px;"></td>

                            </tr>
                            ';
                        }
                        $vat=$orderInvoiceTotal*0.15;
                        $deliveryFee = 20.50;
                        $invoiceTotal=$orderInvoiceTotal+$vat+$deliveryFee;
                        $refundTotal = $orderTotal-$invoiceTotal;
                        ?>
                        </tfoot>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th>Delivery Fee R<?php echo number_format($deliveryFee,2);?></th>
                            <th>VAT R<?php echo number_format($vat,2);?></th>
                            <th>refund Total R<?php echo number_format($refundTotal,2);?></th>
                            <th>Order Total R<?php echo number_format($orderTotal,2);?></th>
                            <th>Invoice Total R<?php echo number_format($invoiceTotal,2);?></th>
                          </tr>
                          <tr>
                            <th><div class='button'>
                                  <?php echo $btn;?>
                                </div>
                            </th>
                            <th></th>
                            <th><div class="invoiceOrderErrorCatch" hidden></div></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><!-- <div class='button subtitutions' hidden>
                                  <a style="color:white;" onclick="requestSubtitutions()">SUBTITUTES</a>
                                </div> -->
                            </th>
                          </tr>
                        </tfoot>
                    </table>
                 </div>
              </div> 
        </div>
 			</div>
 		</div>
 	<?php
  }
  else{
    session_destroy();
    ?>
      <script>
        window.location=("../");
      </script>
    <?php
  }
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../");
  </script>

  <?php
}
?>