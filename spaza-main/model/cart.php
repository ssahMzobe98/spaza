<?php

use controller\mmshightech;
use controller\mmshightech\productsPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    require_once("../controller/mmshightech/productsPdo.php");
    $mmshightech=new mmshightech();
    $products = new productsPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==$userDirect){
        $getProducts=$products->getCartProducts($cur_user_row['id']);

        ?>
            <style>
                .dataCart{
                    width:100%;
                }
                .dataCartDisplay{
                    width: 100%;
                    border: 2px solid #dddddd;
                    border-radius: 10px;
                    padding: 5px 5px;
                }
                .quantity{
                    display: flex;
                }
                .addQuantity,.itemQuantity,.removeQuantity{
                    padding: 10px 10px;
                }
            </style>
            <div class="dataCart">

                <div style="width: 100%;display: flex;padding: 10px 10px;">
                    <div style="color: #000000;font-size: medium;font-weight: bolder;padding: 5px 5px;">Shopping Cart</div>
                    <div style="color: red;font-size: large;font-weight: bolder;padding: 5px 5px; cursor: pointer" title="Empty your cart"><i onclick="emptyCart();" class="fa fa-trash"></i></div>
                    <div class="errorDisplay" hidden></div>
                    <div style="width:10px;"></div>
                    <div style="margin-top: 0.8%;font-weight: lighter;font-size: x-small;" > After amending Product quantity please
                        <span style="padding: 5px 5px;cursor:pointer;border:2px solid #000000;color: #000000;font-weight: bolder;border-radius: 10px;" onclick="loadAfterQuery('.flexible-loader','../model/cart.php')">refresh</span></div>
                </div>
                <div class="dataCartDisplay">
                    <?php
                    if(empty($getProducts)){
                        $load = 'loadAfterQuery(".makhanyile","../model/createOrder.php")';
                        echo"<div style='padding: 10px 10px;width:100%;text-align: center;'>Cart i empty. <span style='color:darkblue;cursor: pointer;' onclick='".$load."'>Start Shopping</span></div>";
                    }
                    else{
                    ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Product Details</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $deliveryFee = 200.50;
                        $subTotal = $deliveryFee;
                        $tax = 0.15;
                        foreach ($getProducts as $product){
                            $price = $product['price_usd']*$product['quantity'];
                            $subTotal += $price;
                            $id=$product['id'];
                            $add ='"add"';
                            $addProductToCart=($product['is_instock']=='N')?"":"onclick='addProductToCart({$id},{$add})'";
                            $remove ='"remove"';
                            $removeProductToCart="onclick='removeProductToCart({$id},{$remove})'";
                            echo'
                            <tr >
                                <td style="color:#000000;">
                                    <img src="../img/rice.jpg" style="width:20%;">
                                </td>
                                <td style="color:#000000;">'.$product['product_description'].'</td>
                                <td style="color:#000000;">
                                    <div class="quantity">
                                        <div class="addQuantity"><i '.$addProductToCart.' class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div class="itemQuantity itemQuantity'.$product['id'].'">'.$product['quantity'].'</div>
                                        <div class="removeQuantity"><i '.$removeProductToCart.' class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </td>
                                <td style="color:#000000;">R'.number_format($product['price_usd'],2).'</td>
                                <td style="color:#000000;">
                                    <div>
                                        R'.number_format($price,2).'
                                    </div>
                                    <span style="color:red;font-size: x-small;cursor: pointer;" onclick="removeThisProduct('.$product['cartId'].')">Remove Product</span>
                                </td>

                            </tr>
                            ';
                        }
                        $Vat=$subTotal*$tax;
                        $total = $subTotal+$Vat;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th >
                            </th>

                            <th></th>
                            <th ></th>
                            <th></th>

                            <th>
                                <table>
                                    <tr>
                                        <th><h6>Sub Total</h6></th>
                                        <th style="justify-items: flex-end;justify-content: flex-end;text-align: right;"><h6>R<?php echo number_format($subTotal,2);?></h6></th>
                                    </tr>
                                    <tr>
                                        <th><h6>VAT</h6></th>
                                        <th style="justify-items: flex-end;justify-content: flex-end;text-align: right;"><h6>R<?php echo number_format($Vat,2);?></h6></th>
                                    </tr>
                                    <tr>
                                        <th><h6>Delivery Fee</h6></th>
                                        <th style="justify-items: flex-end;justify-content: flex-end;text-align: right;"><h6>R<?php echo number_format($deliveryFee,2);?></h6></th>
                                    </tr>
                                    <tr>
                                        <th><h6>TOTAL</h6></th>
                                        <th style="justify-items: flex-end;justify-content: flex-end;text-align: right;"><h6>R<?php echo number_format($total,2);?></h6></th>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <th></th>
                                        <th><div class='button' onclick="loadAfterQuery('.makhanyile','../model/checkout.php');">
                                                <a>CHECKOUT - R<?php echo number_format($total,2);?></a>
                                            </div>
                                        </th>

                                    </tr>

                                </table>

                            </th>
                        </tr>

                        </tfoot>
                    </table>

                    <?php
                    }
                    ?>
                    <div style="width: 100%;padding: 5px 5px;display: flex;">
                        <div style="padding: 5px 5px;cursor:pointer;border:2px solid #000000;color: #000000;font-weight: bolder;border-radius: 10px;">
                            <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=1&limit=10');">prev</a>
                        </div>
                        <div style="width:100%;text-align: center;">Displaying 1 to 10 of 50</div>
                        <div  style="padding: 5px 5px;cursor:pointer;border:2px solid #000000;color: #000000;font-weight: bolder;border-radius: 10px;">
                            <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=10&limit=10');">next</a>
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