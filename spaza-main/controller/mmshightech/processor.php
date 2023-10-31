<?php
require_once("../mmshightech/processorNewPdo.php");
require_once("../mmshightech.php");
use controller\mmshightech;
use controller\mmshightech\processorNewPdo;

if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
//use controller\mmshightech\processorDao;
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e="UKNOWN REQUEST!!";
    $processorNewDao = new processorNewPdo(new mmshightech());
    $cur_user_row = $processorNewDao->userInfo($_SESSION['user_agent']);
    if(isset($_POST['dome'])){
        $dome = $processorNewDao->processBackgroundDisplay($_POST['dome'],$cur_user_row['id']);
        if($dome['response']=='S'){
            $e=1;
        }
        else{
            $e = $dome['data'];
        }
    }
    elseif (isset($_FILES) && isset($_POST['filesUpload'])){
        $toProcess = [];
        $failProcess = [];
        foreach ($_FILES as $fileData){
            $ext = explode(".",$fileData['name']);
            $ext = $ext[1];
            if(in_array(strtolower($ext),['csv','xlsx','xlx'])){
                $toProcess[]=$fileData;
            }
            else {
                $failProcess[] = $fileData['name'];
            }
        }
        if(sizeof($failProcess)>0){
            $e="{".implode(",",$failProcess)."} Not supported!. Processing Failed.";
        }
        else{
            if(sizeof($toProcess)>0){
                $terminate = false;

                foreach ($toProcess as $fileData){
                    $dir = "../../csvFiles/";
                    $filename = rand(0,9999).$fileData['name'];
                    print_r($fileData);
                    if(move_uploaded_file($fileData['tmp_name'],$dir.basename($filename))){
                        $response=$processorNewDao->processCSVfileSave($filename,$cur_user_row['id']);
                        if($response['response']=="S"){
                            $processCSV = $processorNewDao->csvProcessor->processCSV($dir.$filename);


                            $header= $processCSV['header']??'';
                            $data= $processCSV['data']??[];
                            $response=$processorNewDao->uploadCSVData($header,$data,$cur_user_row['id']);
                            if($response['response']=="F"){
                                $terminate = true;
                                $e = $response['data'];
                                break;
                            }
                        }
                        else{
                            $e = $response['data'];
                            break;
                        }
                    }
                    else{
                        $e="Failed to upload {$fileData['name']}, Please resend the request";
                        break;
                    }
                }
            }
            else{
                $e = "Failed to process empty request.";
            }
        }
    }
    elseif (isset($_POST['productIdToActionOnCart'],$_POST['actionType'])){
        $actionType = $processorNewDao->mmshightech->OMO($_POST['actionType']);
        $productIdToActionOnCart = $processorNewDao->mmshightech->OMO($_POST['productIdToActionOnCart']);
        $response = $processorNewDao->cartProcessor($productIdToActionOnCart,$actionType,$cur_user_row['id']);
        if($response['response']=="S"){
            $e=$response['data'];
        }
        else{
            $e=$response['data'];
        }
    }
    elseif (isset($_POST['getCartUpdates'])){
        $e = $processorNewDao->getCartUpdates($cur_user_row['id']);
    }
    elseif (isset($_POST['emptyCart'])){
        $response = $processorNewDao->emptyCart($cur_user_row['id']);
        if($response['response']=="S"){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif (isset($_POST['cartIdToRemove'])){
        $cartIdToRemove = $processorNewDao->mmshightech->OMO($_POST['cartIdToRemove']);
        $response = $processorNewDao->removeProductFromCart($cartIdToRemove,$cur_user_row['id']);
        if($response['response']=="S"){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif (isset($_POST['spazaShopsDisplay'])){
        $spazaShopsDisplay = $processorNewDao->mmshightech->OMO($_POST['spazaShopsDisplay']);
        $response = $processorNewDao->spazaUpdater($spazaShopsDisplay,$cur_user_row['id']);
        if($response['response']=="S"){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif(isset($_POST['userEmailAddress'],
        $_POST['userPhoneNo'],
        $_POST['userDOB'],
        $_POST['gender'],
        $_POST['country'],
        $_POST['id_passport'],
        $_POST['lname'],
        $_POST['fname'],
        $_POST['spaza'])){
        $cleanData = $processorNewDao->mmshightech->cleanAll([$_POST['userEmailAddress'],
            $_POST['userPhoneNo'],
            $_POST['userDOB'],
            $_POST['gender'],
            $_POST['country'],
            $_POST['id_passport'],
            $_POST['lname'],
            $_POST['fname'],
            $_POST['spaza']
        ]);
        $userPhoneNo=$cleanData['1'];
        $userDOB = $cleanData['2'];
        $gender = $cleanData['3'];
        $country = $cleanData['4'];
        $id_passport = $cleanData['5'];
        $lname = $cleanData['6'];
        $fname = $cleanData['7'];
        $spaza = $cleanData['8'];
        $userEmailAddress=$cleanData['0'];
        $response = $processorNewDao->addNewSpazaDetails($userPhoneNo,$userDOB,$gender,$country,$id_passport,$lname,$fname,$spaza,$userEmailAddress,$cur_user_row['id']);
        $e=$response['data'];
    }
    elseif(isset($_POST['spaza_id_toBeRemoved'])){
        $spaza_id_toBeRemoved = $processorNewDao->mmshightech->OMO($_POST['spaza_id_toBeRemoved']);
        $response = $processorNewDao->spazaIdToBeRemoved($spaza_id_toBeRemoved);
        if($response['response']=='S'){
            $e=1;
        }
        else{
            $e=$response['data'];
        }

    }
    elseif (isset($_POST['countryOfOriginAddress'],$_POST['map_dir'],$_POST['spaza_id_to_add_address'])){
        $countryOfOriginAddress = $processorNewDao->mmshightech->OMO($_POST['countryOfOriginAddress']);
        $map_dir = $processorNewDao->mmshightech->OMO($_POST['map_dir']);
        $spaza_id_to_add_address = $processorNewDao->mmshightech->OMO($_POST['spaza_id_to_add_address']);
        $response = $processorNewDao->addAddress($countryOfOriginAddress,$map_dir,$spaza_id_to_add_address);
        if($response['response']=='S'){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif(isset($_POST['visa_number'],$_POST['permit_number'],$_FILES,$_POST['spazaVisaDetailsId'])){
//        $copyOfVisa =$_FILES['copyOfVisa']??'';
//        $copyOfPermit =$_FILES['copyOfVisa']??'';
        $spazaVisaDetailsId = $processorNewDao->mmshightech->OMO($_POST['spazaVisaDetailsId']);
        $visa_number=$processorNewDao->mmshightech->OMO($_POST['visa_number']);
        $permit_number=$processorNewDao->mmshightech->OMO($_POST['permit_number']);
        $tmp=[$visa_number,$permit_number];
        $newNames =[];
        $errorLog=[];
        $break = false;
        $i=0;
        $dir = "../../documents/";
        foreach ($_FILES as $file){
            $ext = explode(".",$file['name']);
            if(!in_array($ext[1],['PDF','pdf'])){
                $errorLog[]=$ext[1]." Not Supported. Please upload .pdf";
                $break = true;
                break;
            }
            $newFileName =$tmp[$i]."_".rand(0,99999).'.'.$ext[1];
            $i++;
            if(!move_uploaded_file($file['tmp_name'],$dir.basename($newFileName))){
                $errorLog[]="Failed to upload file {$file['name']}. Please try again.";
                $break = true;
                break;
            }
            $newNames[]=$newFileName;
        }
        if($break){
            $e=$errorLog[0];
        }
        else{
            $response = $processorNewDao->saveProcessedDocuments($spazaVisaDetailsId,$newNames,$tmp);
            if($response['response']=='S'){
                $e=1;
            }
            else{
                $e=$response['data'];
            }
        }
    }
    echo json_encode($e);
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