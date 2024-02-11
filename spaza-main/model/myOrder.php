<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;
use Controller\mmshightech\OrderPdo;
use Controller\mmshightech\spazaPdo;
use Classes\factory\PDOFactoryOOPClass;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $OrderPdo = PDOFactoryOOPClass::make(Constants::ORDER,[$mmshightech]);
    $spazaPdo = PDOFactoryOOPClass::make(Constants::SPAZA,[$mmshightech]);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==Constants::USER_TYPE_APP){
        date_default_timezone_set('Africa/Johannesburg');
        $orderData = $OrderPdo->getMyOrderDetailsByUser($cur_user_row['id']);
        $spazaDetails=$spazaPdo->spazaDetailsForThisOrder($orderData[0]['order_id']);
        // print_r($spazaDetails);
        $paidBg=($orderData[0]['payment_status']===Constants::PAYMENT_STATUS_PAID)?'badge-success':'badge-danger';
        $OrderStatusBg=($orderData[0]['process_status']===Constants::ORDER_PROSESS_STATUS_WFP)?'badge-danger':'badge-primary';
        $onclickCheckout = 'loadAfterQuery(".makhanyile","../model/checkout.php?order_id='.$orderData[0]['order_id'].'");';
        $paymentString=($orderData[0]['payment_status']===Constants::PAYMENT_STATUS_PAID)?'':"<hr><div style='color:white;background:navy;padding:4px 4px;text-align:center;cursor:pointer;' onclick='{$onclickCheckout}' >MAKE PAYMENT</div>";
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
                
            <div class="headerTech" style="display:flex;width: 100%;">
                <div style="padding:10px 10px;width:30%;">
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
                                   <div><span class="badge <?php echo $OrderStatusBg;?> text-white text-center"><?php echo $orderData[0]['process_status'];?></span><?php echo $paymentString?></div>
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
                                    <th>STATUS</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $orderInvoiceTotal=0;
                                $orderTotal=$orderData[0]['order_total'];
                                $is_paid=$orderData[0]['is_paid'];
                                $is_accepted=$orderData[0]['is_accepted'];
                                $is_invoiced=$orderData[0]['is_invoiced'];
                                $btn = '<a style="color:white;" class="invoiceOrder" onclick="invoiceOrder('.$orderData[0]['order_id'].')">INVOICE ORDER</a>';
                                if($is_paid==='N'){
                                  $btn = '<a style="color:white;" class="invoiceOrder">WAITING FOR PAYMENT</a>';
                                }
                                else{
                                  if($is_accepted==='N'){
                                    $btn = '<a style="color:white;" class="invoiceOrder" onclick="acceptOrder('.$orderData[0]['order_id'].')">ACCEPT ORDER</a>';
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
                                    $status = $summary['status'];
                                    $status = ($status==='A'?'<span class="removeThisProductFromOrder" style="color:green;font-size: x-small;cursor: pointer;" ><i class="fa fa-check" style="pading:10px 10px;font-size:large;"></i></span>':'<span class="removeThisProductFromOrder" style="color:red;font-size: x-small;cursor: pointer;" ><i class="fa fa-close" style="pading:10px 10px;font-size:large;"></i></span>');
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
                                        </td>
                                        <td><input disabled type="radio" '.$is_picked.' style="padding:20px 20px;"></td>
                                        <td>'.$status.'</td>

                                    </tr>
                                    ';
                                }
                                ?>
                                </tbody>
                                
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