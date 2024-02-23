<?php

require_once("../../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\processorNewPdo;
use Controller\mmshightech\spazaPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
//use controller\mmshightech\processorDao;
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e="UKNOWN REQUEST!!";

    $processorNewDao = new processorNewPdo(new mmshightech());
    $spazaPdo = new spazaPdo(new mmshightech());
    $cur_user_row = $processorNewDao->userInfo($_SESSION['user_agent']);

    if(isset($_POST['searchSpazaBynameOrOwner'])){
      $spaza_details = $spazaPdo->getSpazaInfoSearchAll($processorNewDao->mmshightech->OMO($_POST['searchSpazaBynameOrOwner']));
      ?>
        <table class="table table-striped">
                <thead>
                <tr>
                    <th>id #</th>
                    <th>Spaza</th>
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