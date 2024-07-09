<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;
use Controller\mmshightech\productsPdo;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $productsPdo = new productsPdo($mmshightech);
    if(Constants::USER_TYPE_ADMIN===$cur_user_row['user_type']  || $cur_user_row['user_type']===Constants::USER_TYPE_SUPPLIER){
        if(isset($_GET['min'],$_GET['max'])){
            date_default_timezone_set('Africa/Johannesburg');
            $maxCount = $productsPdo->getProductTotalCount();
            $isSupplier = $cur_user_row['user_type']===Constants::USER_TYPE_SUPPLIER?$cur_user_row['supplier_id']:false;
            $getProductData = $productsPdo->getProductsForDisplay($_GET['min'],$_GET['max'],$isSupplier);
            ?>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product #</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>variant_barcode</th>
                    <th>isPromo</th>
                    <th>Promo Duration</th>
                    <th>Promo Price</th>
                    <th>Original Price</th>
                    <th>isInstock</th>
                    <th>Instock Quantity</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($getProductData as $product){
                            ?>
                            <tr>
                                <td onclick="productInfo('<?php echo $product['id'];?>')" style="color:#000000;">#<?php echo $product['id'];?></td>
                                <td style="color:#000000;"><?php echo $product['product_title'];?></td>
                                <td style="color:#000000;"><?php echo $product['product_description'];?></td>
                                <td style="color:#000000;"><?php echo $product['variant_barcode'];?></td>
                                <td style="color:#000000;"><?php echo $product['product_discountable'];?></td>
                                <td style="color:#000000;"><?php echo empty($product['promo_start_date'])?"":$product['promo_start_date'] ." => ".$product['promo_end_date'];?></td>
                                <td style="color:#000000;"><?php if($product['promo_price_to_display']==""){echo "";}else{echo "R".number_format($product['promo_price_to_display'],2);}?></td>
                                <td style="color:#000000;"><?php echo "R".number_format($product['price_usd'],2);?></td>
                                <td style="color:#000000;"><?php echo $product['is_instock'];?></td>
                                <td style="color:#000000;"><?php echo $product['available_quantiy'];?></td>
                                
                          </tr>
                          <?php
                        }
                    ?>
                </tbody>
                  <tfoot>
                    <tr>
                        <th>
                            <div class='button'>
                                <a onclick="loadAfterQuery('.dynamicalLoad1','../model/productDynamicLoader.php?start=<?php $min=($_GET['min']-20)<0?0:$_GET['min']-20;echo $min;?>&limit=<?php $max=($_GET['min']<1)?20:$_GET['min'];echo $max;?>');">prev</a>
                            </div>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-size:9px;">Displaying 3 to 30 of <?php echo $maxCount;?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <div class='button'>
                                <a onclick="loadAfterQuery('.dynamicalLoad1','../model/productDynamicLoader.php?start=<?php echo $_GET['max'];?>&limit=<?php echo ($_GET['max']+20);?>');">next</a>
                            </div>
                        </th>
                  </tr>
                 </tfoot>
              </table>
            <?php
        }
        else{
            echo "UNKNOWN REQUEST!!";
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