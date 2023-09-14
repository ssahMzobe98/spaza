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
                    <th>Version</th>
                    <th>User Type</th>
                    <th>Manage User</th>

                </tr>
                </thead>
                <tbody>
                <tr >
                    <td onclick="getUserInfo('124578963')" style="color:limegreen;">#451232</td>
                    <td onclick="getUserInfo('124578963')" style="color:limegreen;">Thobani</td>
                    <td style="color:limegreen;">Mkhize</td>
                    <td style="color:limegreen;">mkhize.thobani@gmail.com</td>
                    <td style="color:limegreen;">0365214587</td>
                    <td style="color:limegreen;">A</td>
                    <td style="color:limegreen;">1.0.1</td>
                    <td style="color:limegreen;">ADMIN</td>
                    <td>
                        <a onclick="addNewSpaza('124578963')" class="badge badge-primary text-white text-center" style="font-size: medium;">SPAZA <i style="font-size: 15px;color: #dddddd;" class="fa fa-plus" aria-hidden="true"></i></a>

                        <a onclick="viewThisSchooInfo('12','1')" class="badge badge-danger text-white text-center"> <i style="font-size: 20px;color: #dddddd;" class="fa fa-trash-o" aria-hidden="true"></i></a>

                    </td>
                </tr>
                <tr>
                    <td onclick="getUserInfo('124578963')" style="color:limegreen;">#451232</td>
                    <td onclick="getUserInfo('124578963')" style="color:limegreen;">Thobani</td>
                    <td style="color:limegreen;">Mkhize</td>
                    <td style="color:limegreen;">mkhize.thobani@gmail.com</td>
                    <td style="color:limegreen;">0365214587</td>
                    <td style="color:limegreen;">A</td>
                    <td style="color:limegreen;">1.0.1</td>
                    <td style="color:limegreen;">ADMIN</td>
                    <td>
                        <a onclick="addNewSpaza('124578963')" class="badge badge-primary text-white text-center" style="font-size: medium;">SPAZA <i style="font-size: 15px;color: #dddddd;" class="fa fa-plus" aria-hidden="true"></i></a>
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