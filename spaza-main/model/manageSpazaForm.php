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
        <div class="orderDataSet">
            <div class="orderDataSetHeader">
                <div class="maKhathiOrdersSearch" style="padding:10px 10px;">
                    <input type="search" id="FindSpazaSearch" class="maKhathiOrdersSearchInput" placeholder="Find Spaza...">
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
                    <th>Spaza</th>
                    <th>Active Orders</th>
                    <th>Pending Orders</th>
                    <th>Delivered Orders</th>
                    <th>Status</th>
                    <th>Owner ID</th>
                    <th>Owner</th>
                    <th>Manage User</th>

                </tr>
                </thead>
                <tbody>
                <tr >
                    <td onclick="getSpazaInfo('124578963')" style="color:limegreen;">#451232</td>
                    <td onclick="getSpazaInfo('124578963')" style="color:limegreen;">Spaza Name</td>
                    <td style="color:limegreen;"><span class="badge badge-primary text-white text-center">456</span></td>
                    <td style="color:limegreen;"><span class="badge badge-warning text-white text-center">233</span></td>
                    <td style="color:limegreen;"><span class="badge badge-success text-white text-center">236</span></td>
                    <td style="color:limegreen;">A</td>
                    <td style="color:limegreen;">25478</td>
                    <td style="color:limegreen;">Spaza Owner Name</td>
                    <td>
                        <a onclick="viewThisSchooInfo('12','1')" class="badge badge-danger text-white text-center"> <i style="font-size: 20px;color: #dddddd;" class="fa fa-trash-o" aria-hidden="true"></i></a>

                    </td>
                </tr>
                <tr>
                    <td onclick="getSpazaInfo('124578963')" style="color:limegreen;">#451232</td>
                    <td onclick="getSpazaInfo('124578963')" style="color:limegreen;">Spaza Name</td>
                    <td style="color:limegreen;"><span class="badge badge-primary text-white text-center">456</span></td>
                    <td style="color:limegreen;"><span class="badge badge-warning text-white text-center">233</span></td>
                    <td style="color:limegreen;"><span class="badge badge-success text-white text-center">236</span></td>
                    <td style="color:limegreen;">A</td>
                    <td style="color:limegreen;">25478</td>
                    <td style="color:limegreen;">Spaza Owner Name</td>
                    <td>
                        <a onclick="viewThisSchooInfo('12','1')" class="badge badge-danger text-dark text-center"> <i style="font-size: 20px;color: #dddddd;" class="fa fa-trash-o" aria-hidden="true"></i></a>

                    </td>
                </tr>


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