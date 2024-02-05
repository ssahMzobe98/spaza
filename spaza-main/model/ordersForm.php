<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\orderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $orderPdo = new orderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==$userDirect){
  	$orders = $orderPdo->getAllactiveOrder();
    date_default_timezone_set('Africa/Johannesburg');
 	?>
 	<div class="orderDataSet">
 		<div class="orderDataSetHeader">
 			<div class="maKhathiOrdersSearch" style="padding:10px 10px;">
	            <input type="search" class="maKhathiOrdersSearchInput" placeholder="Find with order no...">
	        </div>
	        <div style="padding:10px 10px;">
	        	<span class="badge badge-success text-white text-center" style="padding:10px 10px;">Delivered</span>
	        </div>
	        <div style="padding:10px 10px;">
	        	<span class="badge badge-danger text-white text-center" style="padding:10px 10px;">Cancelled</span>
	        </div>
	        <div style="padding:10px 10px;">
	        	<span class="badge badge-primary text-white text-center" style="padding:10px 10px;">Pending</span>
	        </div>
			<center><h3 style="text-align: center;">Manage Orders</h3></center>
 		</div>
	 	<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Order #</th>
		        <th>Date</th>
		        <th>Cunstomer</th>
		        <th>Payment Status</th>
		        <th>Fulfilment Status</th>
		        <th>Total</th>
		        <th>isInvoiced</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php
		    	foreach($orders as $order){
		    		?>
		    			<tr>
				      		<td onclick="getOrderInfo(<?php echo $order['order_id'];?>)" style="color:#000000;">#<?php echo $order['order_id'];?></td>
				      		<td style="color:#000000;"><?php echo $order['created_date'];?></td>
					        <td style="color:#000000;"><?php echo $order['spaza_name'];?></td>
					        <td style="color:#000000;"><?php echo $order['payment_status'];?></td>
					        <td style="color:#000000;"><?php echo $order['order_status'];?></td>
					        <td style="color:#000000;"><?php echo 'R'.number_format($order['total'],2);?></td>
					        <td style="color:#000000;"><?php echo $order['is_invoiced']=='Y'?'INVOICED':'NOT INVOICED';?></td>
					        
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
			        <th style="font-size:9px;">Displaying 3 to 30 of 500</th>
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