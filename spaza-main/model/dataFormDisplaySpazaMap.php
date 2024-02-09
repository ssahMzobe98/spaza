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
    $spazaPdo=new spazaPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN){
        date_default_timezone_set('Africa/Johannesburg');
        if(isset($_GET['map']) && in_array($_GET['map'],['a','b','c','d','e'],true)&&isset($_GET['spazaID']) && $_GET['spazaID']>0){
            $map = $_GET['map'];
            $spazaID = $mmshightech->OMO($_GET['spazaID']);
            $get_A_Details=$spazaPdo->get_A_Details($spazaID);

            //print_r($get_A_Details);
            ?>
            <style>
                .listAlign{
                    width:100%;
                    padding: 10px 10px;
                    display: flex;
                }
                .okahleinput{
                    padding: 10px 10px;
                    width:100%;
                }
                .okahleinput input{
                    width: 100%;
                }
                .okahleinput .btn{
                    width:12%;
                    padding: 5px 5px;
                    color:white;
                    background: #0A2558;
                    border-radius: 50px;
                    text-align: center;
                }
                .newPhase{
                    height: ;
                }
            </style>
            <?php
            if(empty($get_A_Details)){
                echo"<h5 style='width:100%;text-align: center;'>Details Not Found!!</h5>";
            }
            else{
                if($map=='b'){
                    $block=false;
                    if(!empty($get_A_Details['visa_number'])&&!empty($get_A_Details['permit_number'])&&!empty($get_A_Details['passport_id_copy'])&&!empty($get_A_Details['copy_of_permit'])){
                        $block=true;
                    }
                    echo"<h4 style='text-align: center;'>VISA DETAILS</h4>";
                    $saveVisaDetails='onclick="saveVisaDetails('.$spazaID.')"';
                    ?>
                        <div class="listAlign">
                            <div class="okahleinput">
                                <input class="visa_number form-control" value="<?php echo $get_A_Details['visa_number'];?>" placeholder="Enter Sales Rep Visa Number">
                            </div>
                            <div class="okahleinput">
                                <input class="permit_number form-control" value="<?php echo $get_A_Details['permit_number'];?>" placeholder="Enter Sales Rep Permit Number">
                            </div>
                        </div>
                    <div class="listAlign">
                        <div class="okahleinput">
                            <label>Certified Copy of passport|VISA </label>
                            <input type="file" class="copyOfVisa form-control" value="<?php echo $get_A_Details['passport_id_copy'];?>" id="copyOfVisa">
                        </div>
                        <div class="okahleinput">
                            <label>Certified Copy of Permit </label>
                            <input type="file" class="copyOfPermit form-control" value="<?php echo $get_A_Details['copy_of_permit'];?>" id="copyOfPermit">
                        </div>
                    </div>

                    <div class="okahleinput">
                        <span class="btn save" <?php if(!$block){ echo $saveVisaDetails;}?> >Save</span>
                    </div>
                    <div class="errorNotifier" hidden></div>
                    <?php
                }
                elseif($map=='c'){
                    echo"<h4 style='text-align: center;'>VERIFY ADDRESS</h4>";
                    ?>
                    <div style="height: 40vh;">
                        <div class="newPhase" style="width:100%;height: 100%;"></div>
                    </div>
                    <script>
                        loadAfterQuery('.newPhase','../model/addressForm.php?map=c&spazaID=<?php echo $spazaID;?>');
                    </script>
                    <div class="errorNotifier" hidden></div>
                    <?php
                }
                elseif ($map=='d'){
                    echo"<h4 style='text-align: center;'>VERIFY ADDRESS</h4>";
                    ?>
                        <div style="height: 40vh;">
                            <div class="newPhase" style="width:100%;height: 100%;"></div>
                        </div>
                    <script>
                        loadAfterQuery('.newPhase','../model/addressForm.php?map=d&spazaID=<?php echo $spazaID;?>');
                    </script>
                    <div class="errorNotifier" hidden></div>
                    <?php
                }
                elseif($map=='e'){
                    echo"<h4 style='text-align: center;'>LEGAL DOCUMENTS</h4>";
                    ?>
                    <div class="listAlign">
                        <div class="okahleinput">
                            <label>Proof of Country of Origin Address </label>
                            <input type="file" class="countryOfOriginAddress form-control" id="countryOfOriginAddress">
                        </div>
                        <div class="okahleinput">
                            <label>Proof Of Sales Rep Local Residental Address</label>
                            <input type="file" class="residentalAddress form-control" id="residentalAddress">
                        </div>
                    </div>
                    <div class="listAlign">
                        <div class="okahleinput">
                            <label>Proof Of Spaza local Address</label>
                            <input type="file" class="spazaAddress form-control" id="spazaAddress">
                        </div>
                        <div class="okahleinput">
                            <label>Sales Rep Facial Photo</label>
                            <input type="file" class="photo form-control" id="photo">
                        </div>
                    </div>
                    <div class="okahleinput">
                        <span class="btn save" onclick="saveLegalDocuments('<?php echo $spazaID;?>');">Save</span>
                    </div>
                    <div class="errorNotifier" hidden></div>
                    <?php
                }
                else{
                    echo"<h4 style='color:red;text-align: center;'>MAPPING NOT FOUND!!</h4>";
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