<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    date_default_timezone_set('Africa/Johannesburg');
    if($cur_user_row['user_type']==$userDirect){
        $specials = [];
        $allProducts = [];
        ?>



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
