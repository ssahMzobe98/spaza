<?php

require_once("../../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\processorNewPdo;
use Controller\mmshightech\productsPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
//use controller\mmshightech\processorDao;
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e="UKNOWN REQUEST!!";
    $processorNewDao = new processorNewPdo(new mmshightech());
    $productsPdo = new productsPdo(new mmshightech());
    $cur_user_row = $processorNewDao->userInfo($_SESSION['user_agent']);
    if(isset($_POST['searchProductTableColumn'],$_POST['queryToSearchOnTable'])){
      $searchProductTableColumn=$processorNewDao->mmshightech->OMO($_POST['searchProductTableColumn']);
      $queryToSearchOnTable=$processorNewDao->mmshightech->OMO($_POST['queryToSearchOnTable']);
      $getSearchData = $productsPdo->getSearchData($searchProductTableColumn,$queryToSearchOnTable);
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
                        if(empty($getSearchData)){
                          echo'
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"> Search '.$queryToSearchOnTable.' data not found.</td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                                <td style="color:#000000;"></td>
                              ';
                        }
                        foreach($getSearchData as $product){
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
              </table>
      <?php
    }
    else{
      echo"UKNOWN REQUEST!!.";;
    }
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../../../");
  </script>

  <?php
}

?>