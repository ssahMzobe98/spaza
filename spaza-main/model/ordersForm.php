<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==$userDirect){
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
		        <th>Manage Order</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		      		<td onclick="getOrderInfo('124578963')" style="color:limegreen;">#451232</td>
		      		<td style="color:limegreen;">2023-06-12</td>
			        <td style="color:limegreen;">Adams Spaza</td>
			        <td style="color:limegreen;">PAID</td>
			        <td style="color:limegreen;">PICKING</td>
			        <td style="color:limegreen;">R1 253.00</td>
			        <td>
			        	<a onclick="viewThisSchooInfo('12','1')" class="badge badge-danger text-dark text-center">Cancel <i class="fa fa-times" aria-hidden="true"></i></a> 
			        	
			        </td>
		      </tr>
		      <tr>
		      		<td onclick="getOrderInfo('124578963')" style="color:#ddd;">#451232</td>
		      		<td style="color:#ddd;">2023-06-12</td>
			        <td style="color:#ddd;">Adams Spaza</td>
			        <td style="color:#ddd;">PAID</td>
			        <td style="color:#ddd;">PICKING</td>
			        <td style="color:#ddd;">R1 253.00</td>
			        <td>
			        	<a onclick="viewThisSchooInfo('12','1')" class="badge badge-danger text-dark text-center">Cancel <i class="fa fa-times" aria-hidden="true"></i></a> 
			        	
			        </td>
		      </tr>
			  
		     
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