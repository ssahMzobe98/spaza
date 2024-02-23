<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\spazaPdo;
use Controller\mmshightech\usersPdo;
use Controller\mmshightech\orderPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    // require_once("../controller/mmshightech/usersPdo.php");
    // require_once("../controller/mmshightech/spazaPdo.php");

    $mmshightech=new mmshightech();
    $spazaPdo = new spazaPdo($mmshightech);
    $products = new usersPdo($mmshightech);
    $orderPdo = new orderPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==Constants::USER_TYPE_APP){
        if(isset($_GET['order_id'])){
            if($orderPdo->isActiveOrder($_GET['order_id'])){
                $getOtherSpazas=$spazaPdo->getOtherSpazas($cur_user_row['id']);
                ?>
                <style>
                    .shippingDetails{
                        width:70%;
                        border: 2px solid #ddd;
                        color:#000000;
                        border-radius: 10px 10px;
                        padding: 5px 5px;
                    }
                    .paymentDetails{
                        width:70%;
                        border:2px solid #ddd;
                        color: #000000;
                        border-radius: 10px 10px;
                        padding: 5px 5px;
                    }
                    .divSpaz{
                        width:100%;
                        border:2px solid #ddd;
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
                                    <input type="hidden" class="orderTomakeUpdateOn" value="<?php echo $_GET['order_id'];?>">
                                    <select class="spazaShopsDisplay">
                                        <option value="">-- Select Spaza --</option>
                                        <?php
                                        $defaultSpaza= $spazaPdo->getSpazaByOrderId($_GET['order_id']);
                                        if(!empty($getOtherSpazas)){
                                            foreach ($getOtherSpazas as $spaza){

                                                ?>
                                                <option value="<?php echo $spaza['spaza_id'];?>"><?php echo $spaza['spaza_name'];?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="errorDisplaysetter" hidden></div>
                                </div>

                                <div class="spazaAddressDetails"></div>

                            </div>
                        </div>
                    </div>
                    <div style="width: 50%;">
                        <div class="paymentDetails">
                            <h6>Payment Details for ORDER: <?php echo $_GET['order_id'];?> </h6>
                            <div class="paymentDetailsReal">

                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    loadAfterQuery('.spazaAddressDetails','../model/spazaDisplay.php?spazaId=<?php echo $defaultSpaza;?>');
                    loadAfterQuery('.paymentDetailsReal','../model/paymentDisplay.php?spazaId=<?php echo $defaultSpaza;?>&order_id=<?php echo $_GET['order_id'];?>');
                </script>
            <?php
            }
            else{
                echo"This Order does NOT exist, stop fooling your self.";
            }  
        }
        else{
            echo "UNKNOWN REQUEST!";
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