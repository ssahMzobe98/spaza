<?php
include("../../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\OrderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $orderPdo = new OrderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==$userDirect){
    if(isset($_POST['searchOrderNumber'])){
      $orders = $orderPdo->searchOrderWithId($_POST['searchOrderNumber']);
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
        window.location=("../../../");
      </script>
    <?php
  }
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../../../");
  </script>

  <?php
}
?>