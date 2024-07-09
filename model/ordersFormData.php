<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\factory\PDOFactoryOOPClass;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $OrderPdo = PDOFactoryOOPClass::make(Constants::ORDER,[$mmshightech]);
  $spazaPdo = PDOFactoryOOPClass::make(Constants::SPAZA,[$mmshightech]);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if(($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN  || $cur_user_row['user_type']===Constants::USER_TYPE_SUPPLIER) && isset($_POST['request']) ){
    $orderData=$OrderPdo->orderSummary($_POST['request']);
    $spazaDetails=$spazaPdo->spazaDetailsForThisOrder($orderData[0]['order_id']);
    date_default_timezone_set('Africa/Johannesburg');
    $paidBg=($orderData[0]['payment_status']===Constants::PAYMENT_STATUS_PAID)?'badge-success':'badge-danger';
    $OrderStatusBg=($orderData[0]['process_status']===Constants::ORDER_PROSESS_STATUS_WFP)?'badge-danger':'badge-primary';
    $onclickCheckout = 'loadAfterQuery(".makhanyile","../model/checkout.php?order_id='.$orderData[0]['order_id'].'");';
    //$paymentString=($orderData[0]['payment_status']===Constants::PAYMENT_STATUS_PAID)?'':"<hr><div style='color:white;background:navy;padding:4px 4px;text-align:center;cursor:pointer;' onclick='{$onclickCheckout}' >MAKE PAYMENT</div>";
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
        <div style="padding:10px 10px;width:25%;">
            <div style="padding: 5px 5px; border-radius:10px;border:2px solid #ddd;">
               <center><h3 style="text-align:center;text-decoration-line: underline;text-decoration-color: #dddddd;text-decoration-style: solid;text-decoration-thickness: 2px;">Order Details</h3></center>
               <div style="padding:0 10px;width: 100%;border:2px solid #ddd;">
                   <span><h6 style="font-weight:bolder;">ORDER NO: <?php echo $orderData[0]['order_id'];?></h6></span>
                   <div style="text-align:center;border-bottom: 2px solid #ddd;width:100%;">STATUSES</div>
                   <div style="display:flex;">
                       <div style="border-right: 1px solid #ddd;padding:3px 3px;text-align: center;width:40%;">
                           <div><span>Payment</span></div>
                           <div><span class="badge <?php echo $paidBg;?> text-white text-center"><?php echo $orderData[0]['payment_status'];?></span></div>
                       </div>
                       <div style="border-left: 1px solid #ddd;padding:3px 3px;text-align: center;">
                           <div><span>Order</span></div>
                           <div><span class="badge <?php echo $OrderStatusBg;?> text-white text-center"><?php echo $orderData[0]['process_status'];?></span><?php //if($orderData[0]['process_status']!==Constants::PROCESS_STATUS_FAILED){ echo $paymentString;}?></div>
                           <!-- <div >Total: R<span class="priceDisplay"></span></div> -->
                       </div>
                   </div>
               </div>
               <br>
               <div style="width:100%;border:2px solid #ddd;">
                   <h6 style="text-align:center;text-decoration-line:underline;text-decoration-color:#dddddd;text-decoration-style:solid;text-decoration-thickness:2px;">SPAZA DETAILS-<?php echo empty($spazaDetails['spaza_name'])?'NOT FOUND':$spazaDetails['spaza_name'];?></h6>
                   <style>
                       th{
                        padding: 5px 5px;
                        border-bottom: 2px solid #ddd;
                       }
                   </style>
                   <?php 
                    if(empty($spazaDetails['spaza_name'])){
                        echo"<span style='color:red;text-align:center;'>SPAZA NOT PROVIDED</span>";
                    }
                    else{
                        ?>
                        <table>
                           <tr>
                                <th>Sales Rep</th>
                                <th><?php echo ": ".$spazaDetails['rep_name'];?></th>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <th><?php echo ": ".$spazaDetails['phone'];?></th>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <th><?php echo ": ".$spazaDetails['email'];?></th>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <th><?php echo ": ".$spazaDetails['nationality'];?></th>
                            </tr>
                            <tr>
                                <th>Delivery Address</th>
                                <th><?php echo ": ".$spazaDetails['delivery_address'];?></th>
                            </tr>
                       </table>

                        <?php
                    }
                   ?>
               </div>
               <br>
               <div style="width:100%;border:2px solid #ddd;">
                   <h6 style="text-align:center;text-decoration-line:underline;text-decoration-color:#dddddd;text-decoration-style:solid;text-decoration-thickness:2px;">SPAZA OWNER DETAILS</h6>
                   <style>
                       th{
                        padding: 5px 5px;
                        border-bottom: 2px solid #ddd;
                       }
                   </style>
                   <table>
                       <tr>
                            <th>Name & Surname</th>
                            <th><?php echo ": ".$cur_user_row['name']." ".$cur_user_row['name'];?></th>
                        </tr>
                        <tr>
                            <th>DOB</th>
                            <th><?php echo ": ".$cur_user_row['dob'];?></th>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <th><?php echo ": ".$cur_user_row['gender'];?></th>
                        </tr>
                        <tr>
                            <th>Nationality</th>
                            <th><?php echo ": ".$cur_user_row['nationality'];?></th>
                        </tr>
                        <tr>
                            <th>Nationality Addr</th>
                            <th><?php echo ": ".$cur_user_row['country_of_origin_address'];?></th>
                        </tr>
                        <tr>
                            <th>SA Residing Addr</th>
                            <th><?php echo ": ".$cur_user_row['sa_residing_address'];?></th>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <th><?php echo ": ".$cur_user_row['usermail'];?></th>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <th><?php echo ": ".$cur_user_row['phone_number'];?></th>
                        </tr>
                   </table>

               </div>
            </div>
        </div>
 				<div style="padding:10px 10px;width:75%;">
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
                        // echo $orderData[0]['payment_status'].' lflsdjflsdfjsdlf';
                        if($orderData[0]['process_status']===Constants::PROCESS_STATUS_FAILED){
                            $btn = '<a style="color:white;" class="invoiceOrder">'.$orderData[0]['process_status'].'</a>';
                        }
                        elseif($orderData[0]['process_status']===Constants::PROCESS_STATUS_DELIVERED){
                            $btn = '<a style="color:white;" class="invoiceOrder">'.$orderData[0]['process_status'].'</a>';
                        }
                        else{
                            if($is_paid==='N'){
                              $btn = '<a style="color:white;" class="invoiceOrder">WAITING FOR PAYMENT</a>';
                            }
                            else{
                              if($is_accepted==='N'){
                                $btn = '<a style="color:white;" class="invoiceOrder" onclick="acceptOrder('.$_POST['request'].')">ACCEPT ORDER</a>';
                              }
                              else{
                                if($is_invoiced==='Y'){
                                  $btn = '<a style="color:white;" class="invoiceOrder">'.$orderData[0]['process_status'].'</a>';
                                }
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
                                <td><input type="radio" onclick="markDownPicker('.$order_id.','.$product.')" '.$is_picked.' style="padding:20px 20px;"></td>
                                <td><input type="number" class="OOS_val_'.$product.'" style="padding:2px 2px;width:90px;border-radius:10px;"></td>

                            </tr>
                            ';
                        }
                        $vat=$orderInvoiceTotal*0.15;
                        $deliveryFee = 20.50;
                        $invoiceTotal=$orderInvoiceTotal+$vat+$deliveryFee;
                        $refundTotal = $orderTotal-$invoiceTotal;
                        $cancelOrder = ($orderData[0]['order_status']<4)?'onclick="CancelOrder('.$_POST['request'].')"':'title="ORDER CAN`T BE CANCELLED"';
                        $deliverOrder = ($is_paid===Constants::SUCCESS_YES & $is_accepted===Constants::SUCCESS_YES & $is_invoiced===Constants::SUCCESS_YES)? 'onclick="deliverOrder('.$_POST['request'].')"':"title='ORDER CANNOT BE DELIVERED YET'";
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
                            <th>
                                <div class='button' title="Mark order as CANCELLED">
                                  <a style="color:white;background: red;" class="CancelOrder" <?php echo $cancelOrder;?>><i class="fa fa-trash-o"></i></a>
                                </div>
                            </th>
                            <th title="Mark order as delivered!">
                                <div class='button' style="">
                                  <a style="color:white;background: seagreen;" class="deliverOrder" <?php echo $deliverOrder;?>><i class="fa fa-truck"></i></a>
                                </div>
                            </th>
                            <th>
                                <div hidden class="displayResponseOrder"></div>
                            </th>
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