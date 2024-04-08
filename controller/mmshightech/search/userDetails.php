<?php

require_once("../../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\processorNewPdo;
use Controller\mmshightech\usersPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
//use controller\mmshightech\processorDao;
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e="UKNOWN REQUEST!!";

    $processorNewDao = new processorNewPdo(new mmshightech());
    $userPdo = new usersPdo(new mmshightech());
    $cur_user_row = $processorNewDao->userInfo($_SESSION['user_agent']);

    if(isset($_POST['FindUserSearch'])){
      $getUsersInfo = $userPdo->getUsersInfoSearchAll($processorNewDao->mmshightech->OMO($_POST['FindUserSearch']));
      ?>
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
                                <td onclick="getUserInfo(<?php echo $user['id']?>)" style="color:#000000; width:1%;"><?php echo $user['id']?></td>
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
                                    <!-- <a onclick="addNewSpaza(<?php //echo $user['id']?>)" class="badge badge-success text-white text-center" style="font-size: medium;"><i style="font-size: 12px;color: white;" class="fa fa-eye" aria-hidden="true"></i></a> -->
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
      <?php
    }
    else{
      echo"UKNOWN REQUEST!!.";;
    }
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../../../");
  </script>

  <?php
}

?>