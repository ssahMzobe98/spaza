<?php
include("../vendor/autoload.php");
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=PDOFactoryOOPClass::make(Constants::MMSHIGHTECH,[]);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $walletPdo= PDOFactoryOOPClass::make(Constants::WALLET,[$mmshightech,PDOFactoryOOPClass::make(Constants::PRODUCT,[$mmshightech])]);
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==Constants::USER_TYPE_APP){
        $wallet = $walletPdo->getMyWalletInfo($cur_user_row['id']);
        if(empty($wallet)){
        	echo"<h3 style='color:red;text-align:center;width:100%;'>No wallet Account Found</h3>";
        }
        else{
        	?>
	        <div class="orderDataSet">
	            <div class="orderDataSetHeader">
	                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
	                    <input type="search" id="searchByOrderNumber" class="searchByOrderNumber" oninput="searchByOrderNumber()" placeholder="Find with Order Number...">
	                </div>
	                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
	                    <input type="search" id="searchByInvoiceNumber" class="searchByInvoiceNumber" oninput="searchByInvoiceNumber()" placeholder="Find with Invoice Number">
	                </div>
	                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
	                    <span style="font-weight:bolder;color:#000000;">Wallet Amount: R<?php echo number_format($wallet['wallet_amount'],2);?></span>
	                </div>
	            </div>
	            <div class="userDisplay">
	                <table class="table table-striped">
	                    <thead>
	                    <tr>
	                        <th>Date</th>
	                        <th>time</th>
	                        <th>Order</th>
	                        <th>Invoice</th>
	                        <th>Transation</th>
	                        <th>Order Total</th>
	                        <th>Amount Invoiced</th>
	                        <th>Amount Refunded</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        foreach($wallet['wallet_history'] as $wallet){
	                            ?>
	                            <tr>
	                                <td style="color:#000000; width:1%;"><?php echo $wallet['date_added'];?></td>
	                                <td style="color:#000000;"><?php echo $wallet['time_added'];?></td>
	                                <td style="color:#000000;"><?php echo $wallet['order_id'];?></td>
	                                <td style="color:#000000;"><?php echo $wallet['invoice_id'];?></td>
	                                <td style="color:#000000;"><?php echo $wallet['action_2_wallet'];?></td>
	                                <td style="color:#000000;"><?php echo number_format($wallet['invoice_total'],2);?></td>
	                                <td style="color:#000000;"><?php echo number_format($wallet['order_total'],2);?></td>
	                                <td style="color:#000000;"><?php echo number_format($wallet['refund_total'],2);?></td>
	                            </tr>
	                            <?php
	                        }
	                    ?>

	                    </tbody>
	                    <tfoot>
	                    <tr>
	                        <th><div class='button'>
	                                <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=1&limit=10');">prev</a>
	                            </div>
	                        </th>
	                        <th></th>
	                        <th></th>
	                        <th></th>
	                        <th style="font-size:9px;">Displaying 3 to 30 of 500</th>
	                        <th></th>
	                        <th></th>
	                        <th></th>
	                        <th><div class='button'>
	                                <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=10&limit=10');">next</a>
	                            </div>
	                        </th>
	                    </tr>
	                    </tfoot>
	                </table>
	            </div>
	                

	        </div>
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