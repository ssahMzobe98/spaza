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
    if(isset($_GET['min'],$_GET['limit'])){
      $ordersCount = $orderPdo->getAllStatusCount(13,7);
      $orders = $orderPdo->getAllStatusOrder(13,7,$_GET['min'],$_GET['limit']);
      $trig = count($orders);
      $min=($_GET['min']-10<0)?0:$_GET['min']-10;
      $limit=($_GET['limit']-10<10)?10:$_GET['limit']-10;
      $minLevel=$_GET['min']+10;
      $limitLevel=$_GET['limit']+10;
      $nav = "loadAfterQuery('.displayOrderData','../model/loadDeliveredPagination.php?min={$minLevel}&limit={$limitLevel}')";
      $btnNext=($trig<10)?"disabled='true'":'onclick="'.$nav.'"';
      date_default_timezone_set('Africa/Johannesburg');
      ?>
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
                    <a onclick="loadAfterQuery('.displayOrderData','../model/loadDeliveredPagination.php?min=<?php echo $min;?>&limit=<?php echo $limit;?>');">prev</a>
                  </div>
              </th>
              <th></th>
              <th></th>
              <th style="font-size:9px;">Displaying <?php echo $_GET['min']." to ".($_GET['min']+$trig).' of '.$ordersCount?></th>
              <th></th>
              <th></th>
              <th><div class='button'>
                    <a <?php echo $btnNext;?> >next</a>
                  </div>
              </th>
          </tr>
         </tfoot>
      </table>
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