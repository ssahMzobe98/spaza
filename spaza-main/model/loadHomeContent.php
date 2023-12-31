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
        $getProducts=$products->getProducts(0,100);
        $getSpecialProducts=$products->getSpecialProducts(0,50);

        ?>
        <style>
            .specialsDisplay{
                width: 100%;
                padding: 0 10px;
            }
            .displaySpecialsInline{
                width: 100%;
                display: flex;
                overflow-x: auto;
                hyphens: auto;
                padding: 0 10px;

            }
            .displaySpecialsInline::-webkit-scrollbar{
                height:1px;
            }
            .displaySpecialsInline::-webkit-scrollbar-thumb {
                background: #000000;
                border-radius: 10px;
            }
            .massivBlockDisplay{
                padding: 10px 10px;
            }
            .ProductReader{
                padding: 2px 2px;
                border-radius: 10px;
                width:147px;
                height: 180px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);

            }
            .reform-format{
                width: 100%;
                height: 60%;
                display: flex;
            }
            .reform-format .img-tag{
                width:80%;
                height: 100%;
            }
            .reform-format .img-tag img{
                width: 100%;
                height: 100%;
            }
            .reform-format .Counter-tag{
                width: 20%;
                padding: 1px 1px;
            }
            .reform-format .Counter-tag .dopeIn-ex{
                width: 100%;
                height: 95%;
                border-radius: 50px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
            }

        </style>
        <?php
        if (!empty($getSpecialProducts)) { ?>
        <div class="specialsDisplay">
            <h3>SPECIALS

            <div class="displaySpecialsInline">
                <?php
                    foreach ($getSpecialProducts as $dataRow){
                        $price = number_format($dataRow['price_usd'],2);
                        $title = $dataRow['product_subtitle'];
                        $product = $dataRow['product_description'];
                        $in_stock=($dataRow['is_instock']=='Y')?'<i class="fa fa-check" style="font-size: medium;color:#000000;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                            ':'<i class="fa fa-times" style="font-size: medium;color:darkred;border-radius:100px;border:2px solid darkred;" aria-hidden="true"></i>
                                            ';
                        $id=$dataRow['id'];
                        $cartQuantity = $dataRow['cart_quantity']??0;
                        $add ='"add"';
                        $addProductToCart=($dataRow['is_instock']=='N')?"":"onclick='addProductToCart({$id},{$add})'";
                        $remove ='"remove"';
                        $removeProductToCart="onclick='removeProductToCart({$id},{$remove})'";

                        echo '
                            <div class="massivBlockDisplay">
                                <div class="ProductReader">
                                    <div class="reform-format">
                                        <div class="img-tag">
                                            <img src="../img/rice.jpg" >
                                        </div>
                                        <div class="Counter-tag">
                                            <div class="dopeIn-ex">
                                                <div title="Add Item to cart"><i '.$addProductToCart.' class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                                <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;" class="itemQuantity'.$id.'">'.$cartQuantity.'</div>
                                                <div title="remove Item from cart"><i '.$removeProductToCart.' class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ProductBottom">
                                        <div style="font-size: medium;width:100%; display:flex;padding: 2px 2px;">
                                            <div style="font-size: medium;width:80%;" class="price-product">R'.$price.'</div>
                                            <div style="width:20%;" title="promo item">
                                                <i class="fa fa-star" style="font-size: medium;color:blue;border-radius:100px;border:2px solid blue;" aria-hidden="true"></i>
                                            </div>
                                            <div style="width:20%;" title="in stock">
                                                '.$in_stock.'
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: x-small;text-wrap:wrap;">'.$product.'</p>
                                </div>
                            </div>
                        ';
                    }
               ?>

         </div>
         <?php } ?>
        <div class="RandomDisplay">
            <div style="display: flex;width: 100%;">
                <div style="width:90%;">
                    <h3>PRODUCTS</h3>
                </div>
                <div style="width: 10%;justify-content: right;">
                    <h6 style="font-size: x-small;cursor:pointer;"
                        onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=1')">
                        View More
                    </h6>
                </div>
            </div>
            <div style="padding: 2px 0;width: 100%;display: flex;flex-wrap: wrap;">
                <?php
                    foreach ($getProducts as $dataRow){
                        $price = number_format($dataRow['price_usd'],2);
                        $title = $dataRow['product_subtitle'];
                        $product = $dataRow['product_description'];
                        $in_stock=($dataRow['is_instock']=='Y')?'<i class="fa fa-check" style="font-size: medium;color:#000000;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                            ':'<i class="fa fa-times" style="font-size: medium;color:darkred;border-radius:100px;border:2px solid darkred;" aria-hidden="true"></i>
                                            ';
                        $id=$dataRow['id'];
                        $add ='"add"';
                        $addProductToCart=($dataRow['is_instock']=='N')?"":"onclick='addProductToCart({$id},{$add})'";
                        $remove ='"remove"';
                        $cartQuantity = $dataRow['cart_quantity']??0;
                        $removeProductToCart="onclick='removeProductToCart({$id},{$remove})'";
                        $promo = ($dataRow['product_discountable']=='Y')?'<div style="width:20%;" title="promo item">
                                                <i class="fa fa-star" style="font-size: medium;color:blue;border-radius:100px;border:2px solid blue;" aria-hidden="true"></i>
                                            </div>':'';
                        echo '
                            <div class="massivBlockDisplay">
                                <div class="ProductReader">
                                    <div class="reform-format">
                                        <div class="img-tag">
                                            <img src="../img/rice.jpg" >
                                        </div>
                                        <div class="Counter-tag">
                                            <div class="dopeIn-ex">
                                                <div title="Add Item to cart"><i '.$addProductToCart.' class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                                <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;" class="itemQuantity'.$id.'">'.$cartQuantity.'</div>
                                                <div title="remove Item from cart"><i '.$removeProductToCart.' class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ProductBottom">
                                        <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                            <div style="font-size: smaller;width:80%;" class="price-product">R'.$price.'</div>
                                            '.$promo.'
                                            <div style="width:20%;" title="in stock">
                                                '.$in_stock.'
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: x-small;text-wrap:wrap;">'.$product.'</p>
                                </div>
                            </div>
                        ';
                    }
               ?>

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