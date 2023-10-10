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
        if(isset($_GET['map'])&&$_GET['map']>0){
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
                    width:150px;
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
                    height: 100%;
                    border-radius: 50px;
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
                }

            </style>
            <div class="RandomDisplay">
                <div style="display: flex;width: 100%;">
                    <div style="width:90%;">
                        <h3>PRODUCTS</h3>
                    </div>
                </div>
                <div style="padding: 2px 0;width: 100%;display: flex;flex-wrap: wrap;">
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <!--                ##################################### remove below -->
                    <!--                ##################################### remove above -->
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div><div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                    <div class="massivBlockDisplay">
                        <div class="ProductReader">
                            <div class="reform-format">
                                <div class="img-tag">
                                    <img src="../img/rice.jpg" >
                                </div>
                                <div class="Counter-tag">
                                    <div class="dopeIn-ex">
                                        <div title="Add Item to cart"><i class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                        <div title="Quantity of items in cart" style="font-size:18px;padding: 8px 0; text-align: center;">22</div>
                                        <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ProductBottom">
                                <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                                    <div style="font-size: smaller;width:80%;" class="price-product">R1222.00</div>
                                    <div style="width:20%;" title="in stock">
                                        <i class="fa fa-check" style="font-size: medium;color:darkgreen;border-radius:100px;border:2px solid darkgreen;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: x-small;text-wrap:wrap;">fsdjhk fgsdf dfdfggfdgfd dfgdfgdfs dfsgfdsjkdsj kfsdfjd lkkjls dflsdj</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            echo"UNKNOWN REQUEST!!";
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