<?php

use controller\mmshightech;
use controller\mmshightech\spazaPdo;
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
                $getSpazaInfo = $spazaPdo->getSpazaInformation(intval($_GET['spazaId']));
                print_r($getSpazaInfo);
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