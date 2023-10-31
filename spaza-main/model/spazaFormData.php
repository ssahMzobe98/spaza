<?php

use controller\mmshightech;
use controller\mmshightech\spazaPdo;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    require_once("../controller/mmshightech/spazaPdo.php");
    $mmshightech=new mmshightech();
    $spazaPdo=new spazaPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect){
        date_default_timezone_set('Africa/Johannesburg');
        if(isset($_POST['request']) && $_POST['request']>0){
            $spazaID =$mmshightech->OMO($_POST['request']);
            $spazaDetails = $spazaPdo->getSpazaInformation($spazaID);
            if(empty($spazaDetails)){
                echo"<h5>SPAZA NOT FOUND</h5>";
            }
            else{
                if($spazaDetails['is_veryfied']==1){
                    echo 'display verified data';
                }
                else{
                    ?>
                        <style>
                            .unverifiedData{
                                width: 100%;
                                padding: 10px 10px;
                                display: flex;
                            }
                            .leftDisplay,.rightDisplay{
                                width:50%;
                                padding: 10px 10px;
                            }
                            .rightDisplay .launchData{
                                width:100%;
                                border:1px solid #dddddd;
                                border-radius:10px;
                                padding: 10px 10px;
                            }
                            .leftDisplay .defaultControlledData{
                                width: 100%;
                                border-radius: 10px;
                                border:1px solid #dddddd;
                                padding: 10px 10px;

                            }
                            .RunFault{
                                width:100%;
                                padding: 10px 10px;

                            }
                            .visaDetails{
                                width:100%;
                                padding: 10px 10px;
                                background: green;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .CountryOfOriginAddress{
                                width:100%;
                                padding: 10px 10px;
                                background: purple;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .spazaLocalAddress{
                                width:100%;
                                padding: 10px 10px;
                                background: rebeccapurple;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .visaLegalDocuments{
                                width:100%;
                                padding: 10px 10px;
                                background: red;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                        </style>
                    <center>
                        <h3 style="width: 100%;text-align: center;">SPAZA IS NOT VERIFIED</h3>
                    </center>
                    <div class="unverifiedData">
                        <div class="leftDisplay">
                            <div class="defaultControlledData">
                                <h5 style="width:100%;text-align: center;" onclick="ShowMissingDataForm('a',<?php echo $spazaID;?>)">Missing DATA</h5>
                                <div class="RunFault">
                                    <div class="visaDetails" onclick="ShowMissingDataForm('b',<?php echo $spazaID;?>)">VISA DETAILS</div>
                                </div>
                                <div class="RunFault">
                                    <div class="CountryOfOriginAddress" onclick="ShowMissingDataForm('c',<?php echo $spazaID;?>)">COUNTRY OF ORIGIN ADDRESS</div>
                                </div>
                                <div class="RunFault">
                                    <div class="spazaLocalAddress" onclick="ShowMissingDataForm('d',<?php echo $spazaID;?>)">SPAZA LOCAL ADDRESS</div>
                                </div>
                                <div class="RunFault">
                                    <div class="visaLegalDocuments" onclick="ShowMissingDataForm('e',<?php echo $spazaID;?>)">VISA & LEGAL DOCUMENTS</div>
                                </div>

                            </div>
                        </div>
                        <div class="rightDisplay">
                            <div class="launchData"></div>
                        </div>
                    </div>

                    <?php
                }
            }
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