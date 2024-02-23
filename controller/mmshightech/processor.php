<?php
require_once("../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\processorNewPdo;
use Classes\payment_integration\paymentPdo;
use Controller\mmshightech\OrderPdo;
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e="UKNOWN REQUEST!!";
    $processorNewDao = new processorNewPdo(new mmshightech());
    $paymentPdo = new paymentPdo(new mmshightech());
    $orderPdo = new OrderPdo(new mmshightech());
    $userPdo = PDOFactoryOOPClass::make(Constants::USER,[new mmshightech()]);
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
                    if(move_uploaded_file($fileData['tmp_name'],$dir.basename($dir.$filename))){
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
    elseif (isset($_POST['spazaShopsDisplay'],$_POST['spazaShopsDisplayClientId'],$_POST['orderTomakeUpdateOn'])){
        $spazaShopsDisplay = $processorNewDao->mmshightech->OMO($_POST['spazaShopsDisplay']);
        $spazaShopsDisplayClientId = $processorNewDao->mmshightech->OMO($_POST['spazaShopsDisplayClientId']);
        $orderTomakeUpdateOn=$processorNewDao->mmshightech->OMO($_POST['orderTomakeUpdateOn']);
        $e = $processorNewDao->spazaUpdater($spazaShopsDisplay,$spazaShopsDisplayClientId,$orderTomakeUpdateOn);
        
    }
    elseif(isset($_POST['spazaOwnerId'],$_POST['userEmailAddress'],
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
            $_POST['spaza'],$_POST['spazaOwnerId']
        ]);
        $userPhoneNo=$cleanData['1'];
        $userDOB = $cleanData['2'];
        $gender = $cleanData['3'];
        $country = $cleanData['4'];
        $id_passport = $cleanData['5'];
        $lname = $cleanData['6'];
        $fname = $cleanData['7'];
        $spaza = $cleanData['8'];
        $spazaOwnerId = $cleanData['9'];
        $userEmailAddress=$cleanData['0'];
        $response = $processorNewDao->addNewSpazaDetails($spazaOwnerId,$userPhoneNo,$userDOB,$gender,$country,$id_passport,$lname,$fname,$spaza,$userEmailAddress,$cur_user_row['id']);
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
            if(!in_array($ext[1],['PDF','pdf','png','PNG','JPG','jpg'])){
                $errorLog[]=$ext[1]." Not Supported. Please upload .pdf";
                $break = true;
                break;
            }
            $newFileName =$tmp[$i]."_".rand(0,99999).'.'.$ext[1];
            $i++;
            if(!move_uploaded_file($file['tmp_name'],$dir.basename($dir.$newFileName))){
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
    elseif (isset($_POST['spazaLegalDocumentId'],$_FILES)){
        $spazaLegalDocumentId = $processorNewDao->mmshightech->OMO($_POST['spazaLegalDocumentId']);
        $port = ['photo',
            'spazaAddress',
            'residentalAddress',
            'countryOfOriginAddress'];
        $i=0;
        $break=false;
        $errorLog=[];
        $newNames=[];
        foreach ($_FILES as $file){
            $ext = explode(".",$file['name']);
            if(!in_array($ext[1],['PDF','pdf','png','PNG','JPG','jpg'])){
                $errorLog[]=$ext[1]." Not Supported. Please upload .pdf";
                $break = true;
                break;
            }
            $newFileName = $port[$i].'_'.$_POST['spazaLegalDocumentId'].'_'.rand(0,99999).".".$ext[1];
            $i++;
            $dir = "../../documents/";
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
            $response = $processorNewDao->saveProcessedLegalDocuments($spazaLegalDocumentId,$newNames);
            if($response['response']=='S'){
                $e=1;
            }
            else{
                $e=$response['data'];
            }
        }
    }
    elseif(isset($_POST['clientIdFromRemoveCardDetails'])){
        $clientIdFromRemoveCardDetails=$processorNewDao->mmshightech->OMO($_POST['clientIdFromRemoveCardDetails']);
        $response = $processorNewDao->updateCardDetailsFromUser($clientIdFromRemoveCardDetails,'','','','','',true);
        if($response['response']=='S'){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif(isset($_POST['clientIdToAddBankDetailsTo'],$_POST['cname'],$_POST['ccnum'],$_POST['expmonth'],$_POST['expyear'],$_POST['cvv'])){
        $clientIdToAddBankDetailsTo=$processorNewDao->mmshightech->OMO($_POST['clientIdToAddBankDetailsTo']);
        $cname=$processorNewDao->mmshightech->OMO($_POST['cname']);
        $ccnum=$processorNewDao->mmshightech->OMO($_POST['ccnum']);
        $expmonth=$processorNewDao->mmshightech->OMO($_POST['expmonth']);
        $expyear=$processorNewDao->mmshightech->OMO($_POST['expyear']);
        $cvv=$processorNewDao->mmshightech->OMO($_POST['cvv']);
        $response = $processorNewDao->updateCardDetailsFromUser($clientIdToAddBankDetailsTo,$cname,$ccnum,$expmonth,$expyear,$cvv,false);
        if($response['response']=='S'){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif(
        isset($_POST['fnameNewUser'],
        $_POST['lnameNewUser'],
        $_POST['nationalityNewUser'],
        $_POST['Passport_idNewUser'],
        $_POST['genderNewUser'],
        $_POST['userDOBNewUser'],
        $_POST['permitNumberNewUser'],
        $_POST['coutryOfOriginAddressNewUser'],
        $_POST['saResidingAddressNewUser'],
        $_POST['userEmailAddressNewUser'],
        $_POST['userPasswordNewUser'],
        $_POST['phoneNumberNewUser'])
    ){
        $fnameNewUser=$processorNewDao->mmshightech->OMO($_POST['fnameNewUser']);
        $lnameNewUser=$processorNewDao->mmshightech->OMO($_POST['lnameNewUser']);
        $nationalityNewUser=$processorNewDao->mmshightech->OMO($_POST['nationalityNewUser']);
        $Passport_idNewUser=$processorNewDao->mmshightech->OMO($_POST['Passport_idNewUser']);
        $genderNewUser=$processorNewDao->mmshightech->OMO($_POST['genderNewUser']);
        $userDOBNewUser=$processorNewDao->mmshightech->OMO($_POST['userDOBNewUser']);
        $phoneNumberNewUser=$processorNewDao->mmshightech->OMO($_POST['phoneNumberNewUser']);
        $permitNumberNewUser=$processorNewDao->mmshightech->OMO($_POST['permitNumberNewUser']);
        $coutryOfOriginAddressNewUser=$processorNewDao->mmshightech->OMO($_POST['coutryOfOriginAddressNewUser']);
        $saResidingAddressNewUser=$processorNewDao->mmshightech->OMO($_POST['saResidingAddressNewUser']);
        $userEmailAddressNewUser=$processorNewDao->mmshightech->OMO($_POST['userEmailAddressNewUser']);
        $userPasswordNewUser=$processorNewDao->mmshightech->OMO($_POST['userPasswordNewUser']);
        if(empty($_FILES['passport_id_certifiedcopyNewUser']) || empty($_FILES['countryOfOriginProofOfAddressNewUser']) || empty($_FILES['facialImageNewUser']) || empty($_FILES['sproofOfResidingAddressNewUser'])){
            $e = $processorNewDao->createNewUser($fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$nationalityNewUser,$Passport_idNewUser,$genderNewUser,$userDOBNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$userEmailAddressNewUser,$userPasswordNewUser,[],$cur_user_row['id']);
        }
        else{
            $newFilesNames= [];
            $terminate = false;
            $error['error']= "!!";
            foreach($_FILES as $file){
                $ext = explode(".",$file['name']);
                if(!in_array($ext[1], ['PDF','pdf','PNG','png','jpg','JPG'])){
                    $error['error']=$ext[1].' Not supported. only PDF,PNG,JPG supported.';
                    $terminate = true;
                    break;
                }
                else{
                    $dir = "../../documents/";
                    $newName = rand(0,9999)."_".$ext[0].'.'.$ext[1];
                    if(!move_uploaded_file($file['tmp_name'], basename($dir.$newName))){
                        $error['error']='Failed to upload due to internet. Please try again.';
                        $terminate = true;
                        break;
                    }
                    $newFilesNames[]=$newName;
                }

            }
            if($terminate){
                $e=['response'=>'F','data'=>$error['error']];
            }
            else{
                if(count($newFilesNames)===4){
                    $e = $processorNewDao->createNewUser($fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$nationalityNewUser,$Passport_idNewUser,$genderNewUser,$userDOBNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$userEmailAddressNewUser,$userPasswordNewUser,$newFilesNames,$cur_user_row['id']);
                }
                else{
                    $e=['response'=>'F','data'=>"Files require un-matching. please check if you added all required files."];
                }
            }
        }
    }
    elseif(isset($_POST['NameOnCard'],$_POST['cardNumber'],$_POST['expiryDate'],$_POST['cvv'],$_POST['client_id_toSave2'])){
        $NameOnCard=$processorNewDao->mmshightech->OMO($_POST['NameOnCard']);
        $cardNumber=$processorNewDao->mmshightech->OMO($_POST['cardNumber']);
        $expiryDate=$processorNewDao->mmshightech->OMO($_POST['expiryDate']);
        $cvv=$processorNewDao->mmshightech->OMO($_POST['cvv']);
        $client_id_toSave2=$processorNewDao->mmshightech->OMO($_POST['client_id_toSave2']);
        $response = $processorNewDao->addaPaymentDetails($NameOnCard,$cardNumber,$expiryDate,$cvv,$client_id_toSave2);
        // print_r($response);
        if($response['response']=='S'){
            $e=1;
        }
        else{
            $e=$response['data'];
        }
    }
    elseif(isset($_POST['client_id2Pay'],$_POST['amountToPayInTotal'],$_POST['order_number_toPay'])){
        $client_id2Pay=$processorNewDao->mmshightech->OMO($_POST['client_id2Pay']);
        $amountToPayInTotal=$processorNewDao->mmshightech->OMO($_POST['amountToPayInTotal']);
        $order_number_toPay=$processorNewDao->mmshightech->OMO($_POST['order_number_toPay']);
        $e = $paymentPdo->paymentGateway($client_id2Pay,$amountToPayInTotal,$order_number_toPay);
    }
    elseif(isset($_POST['order_total_amount'],
                 $_POST['order_total_Vat'],
                 $_POST['order_subTotal_amount'],
                 $_POST['order_deliveryFee'])){
        $order_total_amount=$processorNewDao->mmshightech->OMO($_POST['order_total_amount']);
        $order_total_Vat=$processorNewDao->mmshightech->OMO($_POST['order_total_Vat']);
        $order_subTotal_amount=$processorNewDao->mmshightech->OMO($_POST['order_subTotal_amount']);
        $order_deliveryFee=$processorNewDao->mmshightech->OMO($_POST['order_deliveryFee']);
        $e = $orderPdo->validateOrder($order_total_amount,$order_total_Vat,$order_subTotal_amount,$order_deliveryFee,$cur_user_row['id']);
    }
    elseif(isset($_POST['removeThisProductFromOrder_order_id'],$_POST['removeThisProductFromOrder_product_id'])){
        $removeThisProductFromOrder_order_id=$processorNewDao->mmshightech->OMO($_POST['removeThisProductFromOrder_order_id']);
        $removeThisProductFromOrder_product_id=$processorNewDao->mmshightech->OMO($_POST['removeThisProductFromOrder_product_id']);
        $e = $orderPdo->removeProductFromOrder($removeThisProductFromOrder_order_id,$removeThisProductFromOrder_product_id,$cur_user_row['id']);
    }
    elseif(isset($_POST['markDownPicker_order_id'],$_POST['markDownPicker_product_id'])){
        $markDownPicker_order_id=$processorNewDao->mmshightech->OMO($_POST['markDownPicker_order_id']);
        $markDownPicker_product_id=$processorNewDao->mmshightech->OMO($_POST['markDownPicker_product_id']);
        $e=$orderPdo->pickProduct($markDownPicker_order_id,$markDownPicker_product_id);
        // if($response->responseStatus===Constants::RESPONSE_SUCCESS){

        // }
    }
    elseif(isset($_POST['invoiceOrder_orderNo'])){
        $invoiceOrder_orderNo=$processorNewDao->mmshightech->OMO($_POST['invoiceOrder_orderNo']);
        $e=$orderPdo->invoiceOrder($invoiceOrder_orderNo,$cur_user_row['id']);
    }
    elseif(isset($_POST['acceptOrderId'])){
        $acceptOrderId=$processorNewDao->mmshightech->OMO($_POST['acceptOrderId']);
        $e=$orderPdo->acceptOrder($acceptOrderId,$cur_user_row['id']);
    }
    elseif(isset($_POST['deliverOrder_order_id'])){
        $deliverOrder_order_id=$processorNewDao->mmshightech->OMO($_POST['deliverOrder_order_id']);
        $e=$orderPdo->updateOrderProcessStatus(13,$deliverOrder_order_id);
    }
    elseif(isset($_POST['CancelOrder_order_id'])){
        $CancelOrder_order_id=$processorNewDao->mmshightech->OMO($_POST['CancelOrder_order_id']);
        $orderDetails=$orderPdo->getOrderInfo($CancelOrder_order_id);

        if($orderDetails['process_status']>3){
            $e=['response'=>'F','data'=>'Sorry, Order is INVOICED, Cannot Cancel Order.'];
        }
        else{
            $response=$orderPdo->updateOrderProcessStatus(14,$CancelOrder_order_id);
            if($response['response']==='F'){
                $e=$response;
            }
            else{
                $e=$orderPdo->refundToWallet($CancelOrder_order_id);
            }
        }
            
    }
    elseif(isset($_POST['remove_this_user_id'])){
        $remove_this_user_id = $processorNewDao->mmshightech->OMO($_POST['remove_this_user_id']);
        $e=$userPdo->removeThisUser($remove_this_user_id,$cur_user_row['id']);
    }
    elseif(isset($_POST['LOGOUT'])){
        unset($_SESSION['user_agent'],$_SESSION['var_agent']);
        session_destroy();
        $e=1;
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
