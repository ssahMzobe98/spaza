<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\OrderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  // require_once("../controller/mmshightech.php");
  $mmshightech=new mmshightech();
  $OrderPdo = new OrderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==$userDirect && isset($_POST['request'])){
    $orderData=$OrderPdo->confirmOrderData($cur_user_row['id'],$_POST['request']);
    date_default_timezone_set('Africa/Johannesburg');
 	?>
 		<div class="fullBody-tech">
 			<div class="modal-header">
        <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">ORDER <?php echo $_POST['request'];?></h4>
      </div>
 			<div class="headerTech">
 				
 			</div>
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