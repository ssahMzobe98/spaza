<?php

use Controller\mmshightech;
use Controller\mmshightech\usersPdo;

include("../controller/mmshightech.php");
include("../controller/mmshightech/usersPdo.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=new mmshightech();
    $user=new usersPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect){
        date_default_timezone_set('Africa/Johannesburg');
        $getUsersInfo= $user->getUsersInfoAll();
        // print_r($getUsersInfo);
        ?>
        <div class="orderDataSet">
            <div class="orderDataSetHeader">
                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
                    <input type="search" id="FindUserSearch" class="maKhathiOrdersSearchInput" placeholder="Find user...">
                </div>
<!--                <center><h3>Manage Users</h3></center>-->
<!--                <div style="padding:10px 10px;">-->
<!--                    <span class="badge badge-success text-white text-center" style="padding:10px 10px;">Active</span>-->
<!--                </div>-->
<!--                <div style="padding:10px 10px;">-->
<!--                    <span class="badge badge-danger text-white text-center" style="padding:10px 10px;">inactive</span>-->
<!--                </div>-->
<!--                <div style="padding:10px 10px;">-->
<!--                    <span class="badge badge-primary text-white text-center" style="padding:10px 10px;">Pending</span>-->
<!--                </div>-->
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id #</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>passport|SA ID</th>
                    <th>nationality</th>
                    <th>SA Residing Address</th>
                    <th>Manage User</th>

                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($getUsersInfo as $user){
                        $dir = '../documents/';
                        $img = $user['facial_image'];
                        if(empty($img)){
                            $img="d.png";
                        }
                        ?>
                        <tr >
                            <td onclick="getUserInfo(<?php echo $user['id']?>)" style="color:#000000; width:1%;"><img style="width:100%;" src="<?php echo $dir.$img;?>"></td>
                            <td onclick="getUserInfo(<?php echo $user['id']?>)" style="color:#000000;"><?php echo $user['name']?></td>
                            <td style="color:#000000;"><?php echo $user['surname']?></td>
                            <td style="color:#000000;"><?php echo $user['usermail']?></td>
                            <td style="color:#000000;"><?php echo $user['phone_number']?></td>
                            <td style="color:#000000;"><?php echo $user['status']?></td>
                            <td style="color:#000000;"><?php echo $user['passport_id_no']?></td>
                            <td style="color:#000000;"><?php echo $user['nationality']?></td>
                            <td style="color:#000000;"><?php echo $user['sa_residing_address']?></td>
                            <td>
                                <a onclick="addNewSpaza(<?php echo $user['id']?>)" class="badge badge-primary text-white text-center" style="font-size: medium;"><i style="font-size: 12px;color: white;" class="fa fa-plus" aria-hidden="true"></i></a>
                                <a onclick="addNewSpaza(<?php echo $user['id']?>)" class="badge badge-success text-white text-center" style="font-size: medium;"><i style="font-size: 12px;color: white;" class="fa fa-eye" aria-hidden="true"></i></a>
                                <a onclick="viewAllMySpazas(<?php echo $user['id']?>)" class="badge badge-danger text-white text-center"> <i style="font-size: 20px;color: white;" class="fa fa-trash-o" aria-hidden="true"></i></a>

                            </td>

                        </tr>


                        <?php
                    }
                ?>

                </tbody>
                <tfoot>
                <tr>
                    <th><div class='button'>
                            <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=1&limit=10');">prev</a>
                        </div>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="font-size:9px;">Displaying 3 to 30 of 500</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><div class='button'>
                            <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=10&limit=10');">next</a>
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>

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