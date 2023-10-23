<?php

use controller\mmshightech;
use controller\mmshightech\usersPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    require_once("../controller/mmshightech/usersPdo.php");
    $mmshightech=new mmshightech();
    $products = new usersPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==$userDirect){

        ?>
        <style>
            .shippingDetails{
                width:70%;
                border: 2px solid #000000;
                color:#000000;
                border-radius: 10px 10px;
                padding: 5px 5px;
            }
            .paymentDetails{
                width:70%;
                border:2px solid #000000;
                color: #000000;
                border-radius: 10px 10px;
                padding: 5px 5px;
            }
            .divSpaz{
                width:100%;
                border:2px solid #000000;
                border-radius: 10px;

            }
            .divSpaz select{
                width:100%;
                border:none;
                color: #000000;

            }
        </style>
        <div style="width: 100%;display: flex;">
            <div style="width: 50%;">
                <div class="shippingDetails">
                    <h6>Shipping Details</h6>
                    <div class="shippingDetailsReal">
                        <div style="" class="divSpaz">
                            <select class="spazaShopsDisplay">
                                <option value="">-- Select Spaza --</option>
                                <option value="1">Local Spaza</option>
                            </select>
                            <div class="errorDisplaysetter" hidden></div>
                        </div>

                        <div class="spazaAddressDetails"></div>

                    </div>
                </div>
            </div>
            <div style="width: 50%;">
                <div class="paymentDetails">
                    <h6>Payment Details</h6>
                    <div class="paymentDetailsReal">

                    </div>
                </div>
            </div>
        </div>
        <script>
            loadAfterQuery('.spazaAddressDetails','../model/spazaDisplay.php?spazaId=<?php echo $cur_user_row['current_spaza'];?>');
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