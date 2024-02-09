<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\OrderPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $orderPdo = new OrderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN){
  	$orders = $orderPdo->getAllactiveOrder();
    date_default_timezone_set('Africa/Johannesburg');
 	?>
 	<div class="orderDataSet">
 		<div class="orderDataSetHeader">
 			<div class="maKhathiOrdersSearch" style="padding:10px 10px;">
	            <input type="search" class="findOrderNumberInput" oninput="findOrderNumberInput()" placeholder="Find with order no...">
	        </div>
	        <div style="padding:10px 10px;">
	        	<span onclick="loadAfterQuery('.displayOrderData','../model/loadDeliveredPagination.php?min=0&limit=10')" class="badge badge-success text-white text-center" style="padding:10px 10px;">Delivered</span>
	        </div>
	        <div style="padding:10px 10px;">
	        	<span onclick="loadAfterQuery('.displayOrderData','../model/loadCancelledPagination.php?min=0&limit=10')" class="badge badge-danger text-white text-center" style="padding:10px 10px;">Cancelled</span>
	        </div>
	        <div style="padding:10px 10px;">
	        	<span onclick="loadAfterQuery('.displayOrderData','../model/loadPendingPagination.php?min=0&limit=10')" class="badge badge-primary text-white text-center" style="padding:10px 10px;">Pending</span>
	        </div>
			<center><h3 style="text-align: center;">Manage Orders</h3></center>
 		</div>
 		<div class="displayOrderData" style="width:100%;"></div>
 	</div>
 	<script>
 		loadAfterQuery(".displayOrderData","../model/loadLiveOrdersPagination.php?min=0&limit=10");
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