<?php

use Controller\mmshightech;
use Controller\mmshightech\spazaPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    require_once("../controller/mmshightech/spazaPdo.php");
    $mmshightech=new mmshightech();
    $spazaPdo = new spazaPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==$userDirect){
        if(isset($_GET['spazaId'])){
            if(empty($_GET['spazaId'])){
                echo"<h5>NO SPAZA SELECTED!</h5>";
            }
            else{
                $getSpazaInfo = $spazaPdo->getSpazaInformationForOrderProcessing(intval($_GET['spazaId']));
                echo"<pre>";
                print_r($getSpazaInfo);
                echo"</pre>";
                ?>
                    <h2>SPAZA SHIPPING DETAILS</h2>
                    <label>Spaza</label>
                <select class="form-control spazaSelected">
                    <option value="<?php echo $_GET['spazaId'];?>"><?php echo $getSpazaInfo['spaza_name'];?></option>
                </select>
                <h5>More details...</h5>
                <div style="width:100%;padding: 5px 5px; border-radius: 10px;border: 1px solid #dddddd;display: flex;">
                    <div style="padding: 5px 5px;">
                        <div><label>Delivery Address</label></div>
                        <div><label>Sales Rep Name</label></div>
                        <div><label>Sales Rep Passport|ID</label></div>
                        <div><label>Gender</label></div>
                        <div><label>Nationality</label></div>
                        <div><label>Email Address</label></div>
                        <div><label>Phone Number</label></div>
                        <hr>
                        <h5><label>Owner's</label></h5>
                        <div><label>Name & Surname</label></div>
                        <div><label>Email Address</label></div>
                        <div><label>Phone Number</label></div>
                    </div>
                    <div style="padding: 5px 5px;">
                        <div><label><?php echo $getSpazaInfo['delivery_address'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['rep_name'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['rep_passp_id'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['gender'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['nationality'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['email'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['phone'];?></label></div>
                        <hr>
                        <h5><label>Details</label></h5>
                        <div><label><?php echo $getSpazaInfo['owner_name'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['owner_email'];?></label></div>
                        <div><label><?php echo $getSpazaInfo['owner_phone'];?></label></div>
                    </div>
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