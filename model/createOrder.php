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
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $productsDao = new productsPdo($mmshightech);
    $OrderPdo = new OrderPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==Constants::USER_TYPE_APP){
        $productCategories = $productsDao->getAllAvailableCategoties();
        
        $specials = [];
        $allProducts = [];
        ?>
        <style>
            .dolar-set-block-display{
                width: 100%;

            }
            .topicTail{
                display: flex;
                width:100%;
                height: 8%;
            }
            .cart-icon{
                padding: 10px 10px;
            }
            .categoryList{
               justify-content: left;
                justify-items: left;
                width: 60%;
                max-width: 60%;
                min-width: 60%;
                display: flex;
                overflow-x: auto;
                hyphens: auto;

            }
            .categoryList::-webkit-scrollbar{
                height:1px;
            }
            .categoryList::-webkit-scrollbar-thumb {
                background: #000000;
                border-radius: 10px;
            }
            .categoryList .listCategory{
                padding: 10px 10px;
                margin-top: -1.8%;

            }
            .categoryList .listCategory span{
                padding: 8px 8px;
            }
            .flexible-loader{
                width: 100%;
                height: 95%;
                overflow-y: auto;
                hyphens: auto;
            }
            .flexible-loader::-webkit-scrollbar{
                width:1px;
            }
            .flexible-loader::-webkit-scrollbar-thumb {
                background: #000000;
                border-radius: 10px;
            }
        </style>
        <div class="dolar-set-block-display">
            <div class="topicTail">
                <div class="maKhathiSpazaSearch" >
                    <input type="search" class="productSearchCart" placeholder="Search Product...">
                </div>
                <div onclick="loadAfterQuery('.flexible-loader','../model/cart.php')" class="cart-icon" style="display: flex;color: red;"><i  style="font-size: large;cursor:pointer;" class="fa fa-cart-plus"></i><sup><span style="font-size: smaller;" class="cartDisplay">0</span></sup></div>
                <div class="categoryList">
                    <div class="boxInCategory">
                        <span class="badge badge-dark text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/loadHomeContent.php')"><i style="font-size: large;cursor:pointer;" class="fa fa-home"></i></span>
                    </div>
                    <?php
                    foreach($productCategories as $cartegory){
                        $cartegoryMenu = implode("_", explode(" ",$cartegory['menu']));
                        ?>
                        <div class="listCategory">
                            <div class="boxInCategory">
                                <span class="badge <?php echo $cartegory['bg_color'];?> text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=<?php echo $cartegory['id'];?>&identifier=<?php echo $cartegoryMenu;?>')"><?php echo $cartegory['menu'];?></span>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="flexible-loader"></div>
        </div>
        <script>
            loadAfterQuery('.flexible-loader','../model/loadHomeContent.php');
            getCartUpdate();
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