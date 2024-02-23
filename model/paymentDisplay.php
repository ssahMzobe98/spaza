<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\spazaPdo;
use Controller\mmshightech\productsPdo;
use Controller\mmshightech\orderPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    // require_once("../controller/mmshightech/spazaPdo.php");
    // require_once("../controller/mmshightech/productsPdo.php");
    $mmshightech=new mmshightech();
    $products = new productsPdo($mmshightech);
    $spazaPdo = new spazaPdo($mmshightech);
    $orderPdo = new orderPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==Constants::USER_TYPE_APP){
        if(isset($_GET['spazaId'],$_GET['order_id'])){
            if(empty($_GET['spazaId'])){
                echo"<h5>NO SPAZA SELECTED!</h5>";
            }
            elseif(empty($_GET['order_id'])){
              echo"<h5>NO ORDER ID FOUND!</h5>";
            }
            elseif(!$orderPdo->isActiveOrder($_GET['order_id'])){
              echo"<h5>This Order({$_GET['order_id']}) does NOT exist, stop fooling your self.</h5>";
            }
            else{ 

              $accountDetails = $spazaPdo->getSpazaPaymentDetails($_GET['order_id']);
              $sub_total = $orderPdo->getOrderTotal($_GET['order_id']);
              $terminate = false;
              $error='';
              $total=0;
              if(isset($sub_total['response'])){
                $terminate=true;
                $error=$sub_total['data'];
              }
              else{
                if($sub_total['total']<1){
                  $terminate=false;
                  $error="Can not read payment of < 0";
                }
                else{
                  $total=$sub_total['total'];
                }
              }
              

              ?>
              <div style="width:100%;padding:0 10px;">
                <div style="width:100%;"><label>Name on card</label>
                  <input type="text" value="<?php echo $accountDetails['card_name']??'';?>" style="width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;" class="form-control NameOnCard" placeholder="Enter name on card">
                </div>
                <div style="width:100%;"><label>Card Number</label>
                  <input type="number" value="<?php echo $accountDetails['card_number']??'';?>" maxlength="16" minlength="13" style="width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;" class="form-control cardNumber" placeholder="4444 4444 4444 4444">
                </div>
                <div style="width:100%;display: flex;">
                    <div style="width:100%;padding: 0 3px;"><label>Expiry Date</label>
                      <input type="month" value="<?php echo $accountDetails['card_expiry_date']??'';?>" style="width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;" class="form-control expiryDate" placeholder="Enter name on card">
                    </div>
                    <div style="width:100%;padding: 0 3px;"><label>CVV</label>
                      <input type="number" maxlength="3" minlength="3" value="<?php echo $accountDetails['card_cvv']??'';?>" style="width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;" class="form-control cvv" placeholder="CVV">
                    </div>
                </div>
                <div class="errorTagDisplay" hidden></div>
                <hr>
                <div style="width:100%;display:flex">
                    <div style="width:100%;"><span onclick="saveCardDetailsFromPayment(<?php echo $accountDetails['owner_id'];?>)" style="padding:10px 10px;border-radius:50px;" class="badge badge-primary text-center text-white">Edit Card Details</span></div>
                    <div style="width:100%;">
                      <?php 
                      if($terminate){
                        ?>
                          <span style="padding:10px 10px;border-radius:50px;" class="badge badge-danger text-center text-white"><?php echo $error;?> </span>
                        <?php
                      }
                      else{
                        ?><span onclick="makePayment(<?php echo $_GET['order_id'];?>,<?php echo $accountDetails['owner_id'];?>,<?php echo $total;?>)" style="padding:10px 10px;border-radius:50px;" class="badge badge-success text-center text-white">Pay R<?php echo number_format($total,2);?></span>
                        <?php
                      }
                        ?>
                    </div>
                </div>
                
                <hr>
                <p style="font-size:8px; color:red;">NOTE : Please save data after you have made changes to your bank details.</p>
                <br>
                <h5>Card Owner Details</h5>
                <style>
                  th{
                    padding: 0 10px;
                  }
                </style>
                <div ></div>
                <table >
                  <tr>
                    <th>Name & Surname </th>
                    <th> : <?php echo $accountDetails['name']." ".$accountDetails['surname'];?> </th>
                  </tr>
                  <tr>
                    <th>Gender & DOB </th>
                    <th> : <?php echo $accountDetails['gender']." - ".$accountDetails['dob'];?> </th>
                  </tr>
                  <tr>
                    <th>Phone </th>
                    <th> : <?php echo $accountDetails['phone'];?> </th>
                  </tr>
                  <tr>
                    <th>Email </th>
                    <th> : <?php echo $accountDetails['email'];?> </th>
                  </tr>
                  <tr>
                    <th>Nationality </th>
                    <th> : <?php echo $accountDetails['nationality'];?> </th>
                  </tr>
                  
                  <tr>
                    <th>SA res-Address </th>
                    <th> : <?php echo $accountDetails['sa_residing_address'];?> </th>
                  </tr>
                </table>
                  
                
              </div>
              <?php
            }
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