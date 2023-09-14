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
        <div class="body-tag" style="display: flex;">
            <div class="left-tag-set">
                <div class="left-top" style="padding: 10px 10px;width:100%;">
                    <label>Upload product data csv|xls|xlxs</label>
                    <input type="file" class="filesUpload" id="filesUpload" multiple>
                    <div style="padding: 10px 10px;width:100%;" class="displayResponse" hidden></div>
                </div>

            </div>
            <div class="right-tag-set" style="padding: 10px 10px;">
                sdfsdf
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