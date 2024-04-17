<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
use Controller\mmshightech\OrderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=new mmshightech();
    $productsDao = new productsPdo($mmshightech);
    $invoice = PDOFactoryOOPClass::make(Constants::INVOICE,[$mmshightech,$productsDao]);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    // $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']===Constants::USER_TYPE_APP){
        if(isset($_GET['invoice'])&&$_GET['invoice']>0){
            $productFromSpaza = $invoice->getInvoiceFinalReport($_GET['invoice']);
            ?>
            <center>
                <div style="padding: 10px 10px;border: 2px solid #ddd;border-radius: 10px 10px;" class="box-shadow">
                    <div>Invoice Date: <?php echo $productFromSpaza['date_invoice'] .'   Invoice No: '.$productFromSpaza['id'];?></div>
                </div>
                <br>
                <div style="padding: 10px 10px;border: 2px solid #ddd;border-radius: 10px 10px;" class="box-shadow">
                    <div>Total Amount : R<?php echo number_format($productFromSpaza['total_amount'],2);?></div>
                    <div>Total Payment: R<?php echo number_format($productFromSpaza['total_payment'],2);?></div>
                    <div>Total Change : R<?php echo number_format($productFromSpaza['total_change'],2);?></div>
                </div>
            </center>
            <?php
        }
        else{
            echo"UNKNOWN REQUEST!";
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