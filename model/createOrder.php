<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==$userDirect){
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
                <div class="cart-icon" style="display: flex;color: red;"><i style="font-size: large;cursor:pointer;" class="fa fa-cart-plus"></i><sup><span style="font-size: smaller;" class="cartDisplay">0</span></sup></div>
                <div class="categoryList">
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-dark text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/loadHomeContent.php')"><i style="font-size: large;cursor:pointer;" class="fa fa-home"></i></span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-primary text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=1')">Specials</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-warning text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=1')">Meat, Poultry, Chicken</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-success text-center text-white " onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=1')">Fruits & Vegetables</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-primary text-center text-white" onclick="loadAfterQuery('.flexible-loader','../model/productDynamicLoader.php?map=1')">Drinks</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white">Alcohol</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-success text-center text-white">Bakery</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-primary text-center text-white">Milk, Dairy and Eggs</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white">Personal Care & Health</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-success text-center text-white">Chocolate, Sweet & chips</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-primary text-center text-white">Food Cupboard</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white">Baby</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white">Tools & Appliances</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white">Office & School Stationary</span>
                        </div>
                    </div>
                    <div class="listCategory">
                        <div class="boxInCategory">
                            <span class="badge badge-danger text-center text-white"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flexible-loader"></div>
        </div>
        <script>
            loadAfterQuery('.flexible-loader','../model/loadHomeContent.php');
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