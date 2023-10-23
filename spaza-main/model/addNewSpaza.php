<?php

use controller\mmshightech;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect && isset($_POST['request'])){
        date_default_timezone_set('Africa/Johannesburg');
        ?>
        <div class="fullBody-tech">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">Add New Spaza</h4>
            </div>
            <div class="headerTech">
                <div class="modal-body">
                    <div class="inputVals">
                        <input type="text" required class="fname" placeholder="Spaza Name ...">
                    </div>
                    <div class="inputVals">
                        <input type="text" required class="lname" placeholder="Sales Rep Name">
                    </div>
                    <div class="inputVals">
                        <input type="text" required class="lname" placeholder="Sales Rep Surname">
                    </div>
                    <div class="inputVals">
                        <input type="text" required class="lname" placeholder="Valid ID No or Passport No">
                    </div>
                    <div class="inputVals">
                        <select class="gender">
                            <option value="">-- Select Gender--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="inputVals">
                        <input type="date" required class="userDOB" placeholder="Sales Rep date of birth">
                    </div>
                    <div class="inputVals">
                        <input type="number" required class="userPhoneNo" placeholder="Sales Rep Phone No.">
                    </div>
                    <div class="inputVals">
                        <input type="email" required class="userEmailAddress" placeholder="Sales Rep Email Address">
                    </div>
                    <div class="inputVals">
                        <input type="password" required class="userPassword" placeholder="User Password">
                    </div>

                    <br>
                    <div class="inputVals">
                        <center>
                            <span style="padding:10px 10px;border:1px solid #ddd;" class="addMasomaneNewSchool" onclick="maSomaneAddNewSchool()"> Create New User <span style="padding:2px 2px;"><i style="padding:10px 10px;color:green;" class="fa fa-plus"></i></span></span>
                        </center>
                    </div>
                    <div class="errorLogMasoManeAddSchool" hidden></div>

                </div>
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