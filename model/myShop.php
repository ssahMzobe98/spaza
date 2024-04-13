<?php
include("../vendor/autoload.php");
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
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']===Constants::USER_TYPE_APP){
        $productCategories = $productsDao->getAllAvailableCategoties();
        $specials = [];
        $allProducts = [];
        ?>
        <style>
            .dolar-set-block-display{
                width: 100%;
            }
            .flexible-loader{
                width: 100%;
                height: 95%;
                
                display: flex;
            }
            .flexible-loader .leftTag{
                width: 50%;
                height: 100%;
                padding: 5px 5px;
            }
            .flexible-loader .rightTag{
                width: 50%;
                height: 100%;
                padding: 5px 5px;
            }
            .flexible-loader .leftTag .leftTagData{
                height: 100%;
                width: 100%;
            }
            .flexible-loader .rightTag .rightTagData{
                height: 100%;
                width: 100%;
            }
            .flexible-loader .leftTag .leftTagData .InstockProductDisplay,.flexible-loader .rightTag .rightTagData .InvoicingProductDisplay{
                height: 92.8%;
                width: 100%;
                overflow-y: auto;
                hyphens: auto;
                padding: 5px 5px;
/*                border:1px solid red;*/
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }
            .flexible-loader .leftTag .leftTagData .InstockProductDisplay::-webkit-scrollbar{
                width:1px;
            }
            .flexible-loader .leftTag .leftTagData .InstockProductDisplay::-webkit-scrollbar-thumb {
                background: #000000;
                border-radius: 10px;
            }
            .flexible-loader .rightTag .rightTagData .InvoicingProductDisplay::-webkit-scrollbar{
                width:1px;
            }
            .flexible-loader .rightTag .rightTagData .InvoicingProductDisplay::-webkit-scrollbar-thumb {
                background: #000000;
                border-radius: 10px;
            }
        </style>
        <div class="dolar-set-block-display">
            <div class="topicTail">
                <div class="maKhathiSpazaSearch" >
                    <input type="search" class="productSearchCart" placeholder="Search Product...">
                </div>
                
            </div>
            <div class="flexible-loader">
                <div class="leftTag commonTag">
                    <div class="leftTagData box-shadow">
                        <center><h5>Products on Stock</h5></center>
                        <div class="InstockProductDisplay">
                            
                        </div>
                    </div>
                </div>
                <div class="rightTag commonTag">
                    <div class="rightTagData box-shadow">
                        <center><h5>Product To Invoice</h5></center>
                        <div class="InvoicingProductDisplay">
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <script>
            loadAfterQuery('.InstockProductDisplay','../model/loadMyShopProductInStock.php');
        </script>
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