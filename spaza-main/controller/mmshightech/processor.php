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