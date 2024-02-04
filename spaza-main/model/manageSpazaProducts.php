<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    if(Constants::USER_TYPE_APP===$cur_user_row['user_type'] ){
        date_default_timezone_set('Africa/Johannesburg');
        ?>
        <style>
            .productCode{
                width:100%;
            }
            .productDisplay{
                width: 100%;
                border: 2px solid #dddddd;
                border-radius: 10px;
                padding: 5px 5px;
            }
            .productSearch{
                padding: 10px 10px;
                border:1px solid #dddddd;
                border-radius: 10px;
            }
        </style>
        <div class="productCode">

            <div style="width: 100%;display: flex;padding: 10px 10px;">
                <span style="padding:10px 10px;font-weight: bolder;">FILTER BY: </span>
                <div style="color: #000;font-weight: bolder;padding: 5px 5px; cursor: pointer" title="Search Products">
                    <input type="search" placeholder="Product title" oninput="ProductSearchByName('product_title')" class="productSearch ProductSearchByName"> 
                    <input type="number" placeholder="Product ID" oninput="ProductSearchByUid('id')" class="productSearch ProductSearchByUid"> 
                    <input type="search" placeholder="Product description" oninput="ProductSearchByDescription('product_description')" class="productSearch ProductSearchByDescription">
                    <input type="number" placeholder="Product Barcode" oninput="ProductSearchByBarcode('variant_barcode')" class="productSearch ProductSearchByBarcode">
                </div>
                <div class="errorDisplay" hidden></div>
            </div>
            <div class="productDisplay"></div>
            <script>
                loadAfterQuery('.productDisplay','../model/productListLoader.php?min=0&max=20');
            </script>
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