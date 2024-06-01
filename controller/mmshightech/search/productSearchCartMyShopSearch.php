<?php
include("../../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
use Classes\constants\Constants;
use Controller\mmshightech\OrderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=new mmshightech();
    $productsDao = new productsPdo($mmshightech);
    $OrderPdo = new OrderPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    // $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']===Constants::USER_TYPE_APP){
      if(isset($_POST['productSearchCartMyShop'])){
        $productFromSpaza = $productsDao->getProductFromSpazaSearch($cur_user_row['current_spaza'],$_POST['productSearchCartMyShop']);
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
                    padding: 5px 5px;

                }
                .ProductReader{
                    padding: 2px 2px;
                    border-radius: 10px;
                    width:110px;
                    height: 150px;
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);

                }
                .reform-format{
                    width: 100%;
                    height: 50%;
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
        <div style="width: 10%;justify-content: right;" class="errorDisplayLog"></div>
        <div class="RandomDisplay">
            <div style="display: flex;width: 100%;">
                <div style="width:90%;">
                    <h3>SPAZA PRODUCTS</h3>
                </div>
                
            </div>
            <div style="padding: 2px 0;width: 100%;display: flex;flex-wrap: wrap;">
                <?php
                if(empty($productFromSpaza)){
                    echo "<h3> Search Product Not Found!!</h3>";
                }
                    foreach ($productFromSpaza as $dataRow){
                        $price = number_format($dataRow['price'],2);
                        $quantity = $dataRow['quantity']??0;
                        $instock = $dataRow['in_stock'];
                        $title = $dataRow['title'];
                        $product = $dataRow['description'];
                        $productId = $dataRow['product_id'];
                        $in_stock=($dataRow['is_out_stock']==='Y')?'<span style="color:darkred;">'.$instock.'</span>':'<span style="color:green;">'.$instock.'</span>';
                        $id=$dataRow['spaza_product_id'];
                        $add ='"add"';
                        // echo $dataRow['is_in_stock'];
                        $addTOprocessing=($dataRow['is_out_stock']==='Y')?"":"onclick='addToSpazaCustomerInvoice({$id},{$productId},{$add},{$cur_user_row['current_spaza']})'";
                        $remove ='"remove"';
                        $removeProductToCart="onclick='addToSpazaCustomerInvoice({$id},{$productId},{$remove},{$cur_user_row['current_spaza']})'";
                        $img = $dataRow['img']??'';
                        $promo_price_to_display = empty($dataRow['price'])?'':number_format($dataRow['price'],2);
                        $displayFormater = empty($promo_price_to_display)?"R".$price:"<span style='color:red;text-decoration: line-through;font-size:8px;'>R{$price}</span> <span style='font-size:8px;'>R{$promo_price_to_display}</span>";
                        echo '
                            <div class="massivBlockDisplay">
                                <div class="ProductReader">
                                    <div class="reform-format">
                                        <div class="img-tag">
                                            <img src="../img/'.$img.'" >
                                        </div>
                                        <div class="Counter-tag">
                                            <div class="dopeIn-ex">
                                                <div title="Add Item to cart"><i '.$addTOprocessing.' class="fa fa-plus-circle" style="cursor:pointer;font-size:20px; " aria-hidden="true"></i></div>
                                                <div title="Quantity of items in cart" style="font-size:8px;padding: 8px 0; text-align: center;" class="itemQuantity'.$id.'">'.$quantity.'</div>
                                                <div title="remove Item from cart"><i '.$removeProductToCart.' class="fa fa-minus-circle" style="cursor:pointer;font-size:20px; " aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ProductBottom">
                                        <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                            <div style="font-size: smaller;width:80%;" class="price-product">'.$displayFormater.'</div>
                                            
                                            <div style="width:30%;" title="in stock">
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
          echo"UKNOWN REQUEST!!";
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