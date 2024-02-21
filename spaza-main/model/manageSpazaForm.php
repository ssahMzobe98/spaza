<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\spazaPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    // require_once("../controller/mmshightech/spazaPdo.php");
    $mmshightech=new mmshightech();
    $spazaDao=new spazaPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN){
        date_default_timezone_set('Africa/Johannesburg');
        $spaza_details = $spazaDao->getSpazaInfoAll();
        ?>
        <div class="orderDataSet">
            <div class="orderDataSetHeader">
                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
                    <input type="search" id="FindSpazaSearch" class="searchSpazaBynameOrOwner" oninput="maKhathiOrdersSearchInput()" placeholder="Find Spaza...">
                </div>
                <div class="processing" hidden></div>
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
            <div class="spazaDisplay" style="width:100%;">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>id #</th>
                        <th>Spaza</th>
                        <th>nationality</th>
                        <th>delivery address</th>
                        <th>phone number</th>
                        <th>email address</th>
                        <th>Active Orders</th>
                        <th>Pending Orders</th>
                        <th>Delivered Orders</th>
                        <th>Status</th>
                        <th>Owner</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($spaza_details as $spazaDetails){
                        ?>
                        <tr  class="removeSpaza'<?php echo $spazaDetails['spaza_id'];?>'">
                            <td onclick="getSpazaInfo('<?php echo $spazaDetails['spaza_id'];?>')" style="color:#000000;cursor: pointer;"><?php echo $spazaDetails['spaza_id'];?></td>
                            <td onclick="getSpazaInfo('<?php echo $spazaDetails['spaza_id'];?>')" style="color:#000000;cursor: pointer;"><?php echo $spazaDetails['spaza_name'];?></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['nationality'];?></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['delivery_address'];?></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['phone'];?></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['email'];?></td>
                            <td style="color:#000000;"><span class="badge badge-primary text-white text-center"><?php echo $spazaDetails['active_orders'];?></span></td>
                            <td style="color:#000000;"><span class="badge badge-warning text-white text-center"><?php echo $spazaDetails['pending_orders'];?></span></td>
                            <td style="color:#000000;"><span class="badge badge-success text-white text-center"><?php echo $spazaDetails['delivered_orders'];?></span></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['spaza_status'];?></td>
                            <td style="color:#000000;"><?php echo $spazaDetails['owner_name'];?></td>
                            <td>
                                <a onclick="removeSpazaPermanetly('<?php echo $spazaDetails['spaza_id'];?>')" class="badge badge-danger text-white text-center"> <i style="font-size: 20px;color: #dddddd;" class="fa fa-trash-o" aria-hidden="true"></i></a>

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
                        <th></th>
                        <th style="font-size:9px;">Displaying 3 to 30 of 500</th>
                        <th></th>
                        <th></th>
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