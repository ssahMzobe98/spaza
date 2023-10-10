
<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    include_once ("../controller/mmshightech/ClientPdo.php");
    include_once ("../controller/mmshightech/StorePdo.php");
    include_once ("../controller/mmshightech/MenuCategoryPdo.php");
    $mmshightech=new mmshightech();
    $storePdo = new StorePdo();
    $clientPdo = new ClientPdo();
    $menuPdo = new MenuCategoryPdo();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    if($cur_user_row['user_type']=='app'){
        date_default_timezone_set('Africa/Johannesburg');
        if(isset($_GET['menuId'],$_GET['clientId'],$_GET['storeId'])){
            $cleanData = $mmshightech->cleanAll([$_GET['menuId'],$_GET['clientId'],$_GET['storeId']]);
            $verifyStoreId = $storePdo->verifyStoreId($cleanData[2]);
            $verifyClientId = $clientPdo->verifyClientId($cleanData[1]);
            $verifymenuId = $menuPdo->verifymenuId($cleanData[0]);
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
