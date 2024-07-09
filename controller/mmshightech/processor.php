<?php
require_once("../../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\processorNewPdo;
use Classes\payment_integration\paymentPdo;
use Controller\mmshightech\OrderPdo;
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
use Classes\response\Response;
use Classes\logs\ErrorHandler;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $e=new Response();
    // RESPONSE_SUCCESS
    // RESPONSE_FAILED
    $e->responseStatus = Constants::RESPONSE_FAILED;
    $e->responseMessage ="UKNOWN REQUEST!!";
    try{
        $processorNewDao = new processorNewPdo(new mmshightech());
        $paymentPdo = new paymentPdo(new mmshightech());
        $orderPdo = new OrderPdo(new mmshightech());
        $products = PDOFactoryOOPClass::make(Constants::PRODUCT,[new mmshightech()]);
        $invoice = PDOFactoryOOPClass::make(Constants::INVOICE,[new mmshightech(),$products]);
        $userPdo = PDOFactoryOOPClass::make(Constants::USER,[new mmshightech()]);
        
        $SuppliersDao = PDOFactoryOOPClass::make(Constants::SUPPLIER,[new mmshightech]);
        $cur_user_row = $processorNewDao->userInfo($_SESSION['user_agent']);
        if(isset($_POST['dome'])){
            $e = $processorNewDao->processBackgroundDisplay($_POST['dome'],$cur_user_row['id']);
        }
        elseif(isset($_POST['updateSupplierOnSpazaOner'])){
            $updateSupplierOnSpazaOner=$processorNewDao->mmshightech->OMO($_POST['updateSupplierOnSpazaOner']);
            $e=$userPdo->updateSupplierOnSpazaOner($updateSupplierOnSpazaOner,$cur_user_row['id']);

        }
        elseif(isset(
            $_POST['storeName'],
            $_POST['storePhone'],
            $_POST['storeNationality'],
            $_POST['storeProvince'],
            $_POST['storeAddress'],
            $_POST['storeRegNo'],
            $_POST['storeAdminName'],
            $_POST['storeAdminSurname'],
            $_POST['storeAdminIDNo'],
            $_POST['storeEmployeeCode'],
            $_POST['storeAdminEmail'],
            $_POST['storePassword'])){
            if(empty($_FILES['storeLogo'])){
                $e->responseMessage ="Missing Supplier's logo.";
            }
            else{
                $ext= explode('.',$_FILES['storeLogo']['name']);
                $ext = $ext[1];
                if(in_array(strtolower($ext),['png','jpg','jpeg','gif'])){
                    $dir = "../../img/suppliersLogo/";
                    $filename = rand(0,9999).$_FILES['storeLogo']['name'];
                    if(move_uploaded_file($_FILES['storeLogo']['tmp_name'],$dir.basename($dir.$filename))){
                        $storeName=$processorNewDao->mmshightech->OMO($_POST['storeName']);
                        $storePhone=$processorNewDao->mmshightech->OMO($_POST['storePhone']);
                        $storeNationality=$processorNewDao->mmshightech->OMO($_POST['storeNationality']);
                        $storeProvince=$processorNewDao->mmshightech->OMO($_POST['storeProvince']);
                        $storeAddress=$processorNewDao->mmshightech->OMO($_POST['storeAddress']);
                        $storeRegNo=$processorNewDao->mmshightech->OMO($_POST['storeRegNo']);
                        $storeAdminName=$processorNewDao->mmshightech->OMO($_POST['storeAdminName']);
                        $storeAdminSurname=$processorNewDao->mmshightech->OMO($_POST['storeAdminSurname']);
                        $storeAdminIDNo=$processorNewDao->mmshightech->OMO($_POST['storeAdminIDNo']);
                        $storeEmployeeCode=$processorNewDao->mmshightech->OMO($_POST['storeEmployeeCode']);
                        $storeAdminEmail=$processorNewDao->mmshightech->OMO($_POST['storeAdminEmail']);
                        $storePassword=$processorNewDao->mmshightech->OMO($_POST['storePassword']);
                        $e=$SuppliersDao->createNewSupplier($storeName,$storePhone,$storeNationality,$storeProvince,$storeAddress,$storeRegNo,$storeAdminName,$storeAdminSurname,$storeAdminIDNo,$storeEmployeeCode,$storeAdminEmail,$storePassword,$filename,$cur_user_row['id']);
                        if($e->responseStatus===Constants::RESPONSE_SUCCESS){
                            $e=$processorNewDao->createNewUser($storeName,'Supplier',$storePhone,$storeNationality,$storeAdminIDNo,'SUPPLIER STORE',date('Y-m-d'),$storeRegNo,$storeNationality,$storeAddress,$storeAdminEmail,$storePassword,[],$cur_user_row['id'],$e->responseMessage);
                        }
                    }
                    else{
                        $e->responseMessage = "Failed to Upload File, Please try again later.";
                    }
                }
                else {
                    $e->responseMessage = $ext."Not Supported.";
                }
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
                $e->responseMessage="{".implode(",",$failProcess)."} Not supported!. Processing Failed.";
                $e->responseStatus=Constants::FAILED_STATUS;
            }
            else{
                if(sizeof($toProcess)>0){
                    $terminate = false;

                    foreach ($toProcess as $fileData){
                        $dir = "../../csvFiles/";
                        $filename = rand(0,9999).$fileData['name'];
                        print_r($fileData);
                        if(move_uploaded_file($fileData['tmp_name'],$dir.basename($dir.$filename))){
                            $e=$processorNewDao->processCSVfileSave($filename,$cur_user_row['id']);
                            if($e->responseStatus==="S"){
                                $processCSV = $processorNewDao->csvProcessor->processCSV($dir.$filename);


                                $header= $processCSV['header']??'';
                                $data= $processCSV['data']??[];
                                $e=$processorNewDao->uploadCSVData($header,$data,$cur_user_row['id']);
                                if($e->responseStatus==="F"){
                                    $terminate = true;
                                    break;
                                }
                            }
                            else{
                                $e = $response['data'];
                                break;
                            }
                        }
                        else{
                            $e->responseMessage="Failed to upload {$fileData['name']}, Please resend the request";
                            break;
                        }
                    }
                }
                else{
                    $e->responseMessage="Failed to process empty request.";
                }
            }
        }
        elseif (isset($_POST['productIdToActionOnCart'],$_POST['actionType'],$_POST['cartProcessor_supplier_store_id'])){
            $actionType = $processorNewDao->mmshightech->OMO($_POST['actionType']);
            $productIdToActionOnCart = $processorNewDao->mmshightech->OMO($_POST['productIdToActionOnCart']);
            $supplier_store_id = $processorNewDao->mmshightech->OMO($_POST['cartProcessor_supplier_store_id']);
            $e = $processorNewDao->cartProcessor($productIdToActionOnCart,$actionType,$cur_user_row['id'],$supplier_store_id);
            
        }
        elseif (isset($_POST['getCartUpdates'],$_POST['get_supplier_store_id'])){
            $supplier_store_id = $processorNewDao->mmshightech->OMO($_POST['get_supplier_store_id']);
            $e = $processorNewDao->getCartUpdates($cur_user_row['id'],$supplier_store_id);
        }
        elseif (isset($_POST['emptyCart'],$_POST['empty_supplier_store_id'])){
            $supplier_store_id = $processorNewDao->mmshightech->OMO($_POST['empty_supplier_store_id']);
            $e = $processorNewDao->emptyCart($cur_user_row['id'],$supplier_store_id);
            
        }
        elseif (isset($_POST['cartIdToRemove'],$_POST['remove_supplier_store_id'])){
            $supplier_store_id = $processorNewDao->mmshightech->OMO($_POST['remove_supplier_store_id']);
            $cartIdToRemove = $processorNewDao->mmshightech->OMO($_POST['cartIdToRemove']);
            $e = $processorNewDao->removeProductFromCart($cartIdToRemove,$cur_user_row['id'],$supplier_store_id);
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
            $e = $processorNewDao->addNewSpazaDetails($spazaOwnerId,$userPhoneNo,$userDOB,$gender,$country,$id_passport,$lname,$fname,$spaza,$userEmailAddress,$cur_user_row['id']);
        }
        elseif(isset($_POST['spaza_id_toBeRemoved'])){
            $spaza_id_toBeRemoved = $processorNewDao->mmshightech->OMO($_POST['spaza_id_toBeRemoved']);
            $e = $processorNewDao->spazaIdToBeRemoved($spaza_id_toBeRemoved);
        }
        elseif (isset($_POST['countryOfOriginAddress'],$_POST['map_dir'],$_POST['spaza_id_to_add_address'])){
            $countryOfOriginAddress = $processorNewDao->mmshightech->OMO($_POST['countryOfOriginAddress']);
            $map_dir = $processorNewDao->mmshightech->OMO($_POST['map_dir']);
            $spaza_id_to_add_address = $processorNewDao->mmshightech->OMO($_POST['spaza_id_to_add_address']);
            $e = $processorNewDao->addAddress($countryOfOriginAddress,$map_dir,$spaza_id_to_add_address);
        }
        elseif(isset($_POST['visa_number'],$_POST['permit_number'],$_FILES,$_POST['spazaVisaDetailsId'])){
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
                    $e->responseMessage=$ext[1]." Not Supported. Please upload .pdf";
                    $break = true;
                    break;
                }
                $newFileName =$tmp[$i]."_".rand(0,99999).'.'.$ext[1];
                $i++;
                if(!move_uploaded_file($file['tmp_name'],$dir.basename($dir.$newFileName))){
                    $e->responseMessage="Failed to upload file {$file['name']}. Please try again.";
                    $break = true;
                    break;
                }
                $newNames[]=$newFileName;
            }
            if($break){
                $e->responseStatus=Constants::RESPONSE_FAILED;
            }
            else{
                $e = $processorNewDao->saveProcessedDocuments($spazaVisaDetailsId,$newNames,$tmp);
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
                    $e->responseMessage=$ext[1]." Not Supported. Please upload .pdf";
                    $break = true;
                    break;
                }
                $newFileName = $port[$i].'_'.$_POST['spazaLegalDocumentId'].'_'.rand(0,99999).".".$ext[1];
                $i++;
                $dir = "../../documents/";
                if(!move_uploaded_file($file['tmp_name'],$dir.basename($newFileName))){
                    $e->responseMessage="Failed to upload file {$file['name']}. Please try again.";
                    $break = true;
                    break;
                }
                $newNames[]=$newFileName;
            }
            if($break){
                $e->responseStatus=Constants::RESPONSE_FAILED;
            }
            else{
                $e = $processorNewDao->saveProcessedLegalDocuments($spazaLegalDocumentId,$newNames);
            }
        }
        elseif(isset($_POST['clientIdFromRemoveCardDetails'])){
            $clientIdFromRemoveCardDetails=$processorNewDao->mmshightech->OMO($_POST['clientIdFromRemoveCardDetails']);
            $e = $processorNewDao->updateCardDetailsFromUser($clientIdFromRemoveCardDetails,'','','','','',true);
        }
        elseif(isset($_POST['clientIdToAddBankDetailsTo'],$_POST['cname'],$_POST['ccnum'],$_POST['expmonth'],$_POST['expyear'],$_POST['cvv'])){
            $clientIdToAddBankDetailsTo=$processorNewDao->mmshightech->OMO($_POST['clientIdToAddBankDetailsTo']);
            $cname=$processorNewDao->mmshightech->OMO($_POST['cname']);
            $ccnum=$processorNewDao->mmshightech->OMO($_POST['ccnum']);
            $expmonth=$processorNewDao->mmshightech->OMO($_POST['expmonth']);
            $expyear=$processorNewDao->mmshightech->OMO($_POST['expyear']);
            $cvv=$processorNewDao->mmshightech->OMO($_POST['cvv']);
            $e = $processorNewDao->updateCardDetailsFromUser($clientIdToAddBankDetailsTo,$cname,$ccnum,$expmonth,$expyear,$cvv,false);
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
                $error['error']= "";
                foreach($_FILES as $file){
                    $ext = explode(".",$file['name']);
                    if(!in_array($ext[1], ['PDF','pdf','PNG','png','jpg','JPG'])){
                        $e->responseMessage=$ext[1].' Not supported. only PDF,PNG,JPG supported.';
                        $terminate = true;
                        break;
                    }
                    else{
                        $dir = "../../documents/";
                        $newName = rand(0,9999)."_".$ext[0].'.'.$ext[1];
                        if(!move_uploaded_file($file['tmp_name'], basename($dir.$newName))){
                            $e->responseMessage='Failed to upload due to internet. Please try again.';
                            $terminate = true;
                            break;
                        }
                        $newFilesNames[]=$newName;
                    }

                }
                if($terminate){
                    $e->responseStatus=Constants::RESPONSE_FAILED;
                }
                else{
                    if(count($newFilesNames)===4){
                        $e = $processorNewDao->createNewUser($fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$nationalityNewUser,$Passport_idNewUser,$genderNewUser,$userDOBNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$userEmailAddressNewUser,$userPasswordNewUser,$newFilesNames,$cur_user_row['id']);
                    }
                    else{
                        $e->responseStatus=Constants::RESPONSE_FAILED;
                        $e->responseMessage="Files require un-matching. please check if you added all required files.";
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
            $e = $processorNewDao->addaPaymentDetails($NameOnCard,$cardNumber,$expiryDate,$cvv,$client_id_toSave2);
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
                $e=$orderPdo->updateOrderProcessStatus(14,$CancelOrder_order_id);
                if($e->responseStatus==='S'){
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
        elseif(
            isset($_POST['amend_label'],
            $_POST['amend_sub_label'],
            $_POST['amend_description'],
            $_POST['amend_manufacture'],
            $_POST['amend_brand'],
            $_POST['amend_category'],
            $_POST['amend_seling_unit'],
            $_POST['amend_qantity'],
            $_POST['amend_content_uom'],
            $_POST['amend_ean_code'],
            $_POST['amend_alt_ean'],
            $_POST['amend_alt_ean2'],
            $_POST['amend_code_single'],
            $_POST['amend_start_date'],
            $_POST['amend_end_date'],
            $_POST['amend_price'],
            $_POST['amend_label_promo_price'],
            $_POST['amend_percentage_discount'],
            $_POST['amend_discount_amount'])
        ){
            $amend_label=$processorNewDao->mmshightech->OMO($_POST['amend_label']);
            $amend_sub_label=$processorNewDao->mmshightech->OMO($_POST['amend_sub_label']);
            $amend_description=$processorNewDao->mmshightech->OMO($_POST['amend_description']);
            $amend_manufacture=$processorNewDao->mmshightech->OMO($_POST['amend_manufacture']);
            $amend_brand=$processorNewDao->mmshightech->OMO($_POST['amend_brand']);
            $amend_category=$processorNewDao->mmshightech->OMO($_POST['amend_category']);
            $amend_seling_unit=$processorNewDao->mmshightech->OMO($_POST['amend_seling_unit']);
            $amend_qantity=$processorNewDao->mmshightech->OMO($_POST['amend_qantity']);
            $amend_content_uom=$processorNewDao->mmshightech->OMO($_POST['amend_content_uom']);
            $amend_ean_code=$processorNewDao->mmshightech->OMO($_POST['amend_ean_code']);
            $amend_alt_ean=$processorNewDao->mmshightech->OMO($_POST['amend_alt_ean']);
            $amend_alt_ean2=$processorNewDao->mmshightech->OMO($_POST['amend_alt_ean2']);
            $amend_code_single=$processorNewDao->mmshightech->OMO($_POST['amend_code_single']);
            $amend_start_date=$processorNewDao->mmshightech->OMO($_POST['amend_start_date']);
            $amend_end_date=$processorNewDao->mmshightech->OMO($_POST['amend_end_date']);
            $amend_price=$processorNewDao->mmshightech->OMO($_POST['amend_price']);

            $amend_label_promo_price=$processorNewDao->mmshightech->OMO($_POST['amend_label_promo_price']);
            $amend_percentage_discount=$processorNewDao->mmshightech->OMO($_POST['amend_percentage_discount']);
            $amend_discount_amount=$processorNewDao->mmshightech->OMO($_POST['amend_discount_amount']);
            $amend_product_id=$processorNewDao->mmshightech->OMO($_POST['amend_product_id']);
            if($amend_percentage_discount>0){
                $amend_label_promo_price = $amend_price*($amend_percentage_discount/100);
            }
            elseif($amend_percentage_discount>0){
                $amend_label_promo_price = $amend_price-$amend_percentage_discount;
            }
            $e=$products->updateProductInfo(
                 $amend_label
                ,$amend_sub_label
                ,$amend_description
                ,$amend_manufacture
                ,$amend_brand
                ,$amend_category
                ,$amend_seling_unit
                ,$amend_qantity
                ,$amend_content_uom
                ,$amend_ean_code
                ,$amend_alt_ean
                ,$amend_alt_ean2
                ,$amend_code_single
                ,$amend_start_date
                ,$amend_end_date
                ,$amend_price
                ,$amend_label_promo_price
                ,$amend_percentage_discount
                ,$amend_discount_amount,$amend_product_id);

        }

        elseif(isset($_POST['productCodeToAttendToData'],$_POST['fieldToAttendTOData'])){
            $productCodeToAttendToData = $processorNewDao->mmshightech->OMO($_POST['productCodeToAttendToData']);
            $fieldToAttendTOData = $processorNewDao->mmshightech->OMO($_POST['fieldToAttendTOData']);
            $e=$products->updatePromoStockIssue($productCodeToAttendToData,$fieldToAttendTOData);
        }
        elseif(isset($_POST['OrderIdToMarkAsArrived'],$_POST['productIdToMarkAsArrived'],$_POST['current_value'])){
            $OrderIdToMarkAsArrived = $processorNewDao->mmshightech->OMO($_POST['OrderIdToMarkAsArrived']);
            $productIdToMarkAsArrived = $processorNewDao->mmshightech->OMO($_POST['productIdToMarkAsArrived']);
            $current_value = $processorNewDao->mmshightech->OMO($_POST['current_value']);
            $e=$products->markItemAsArrived($OrderIdToMarkAsArrived,$productIdToMarkAsArrived,$current_value);
        }
        elseif(isset($_POST['orderNo_received_by_user'])){
            $orderNo_received_by_user = $processorNewDao->mmshightech->OMO($_POST['orderNo_received_by_user']);
            $e=$orderPdo->receiveOrderByUser($orderNo_received_by_user,$cur_user_row['id']);
        }
        elseif(isset($_POST['product_id_on_spaza'],$_POST['action_type_from_spaza'],$_POST['current_spaza_shop_id'],$_POST['product_id'])){
            $product_id_on_spaza = $processorNewDao->mmshightech->OMO($_POST['product_id_on_spaza']);
            $action_type_from_spaza = $processorNewDao->mmshightech->OMO($_POST['action_type_from_spaza']);
            $current_spaza_shop_id = $processorNewDao->mmshightech->OMO($_POST['current_spaza_shop_id']);
            $product_id = $processorNewDao->mmshightech->OMO($_POST['product_id']);
            $e=$products->actionProductsTOInvoice($product_id_on_spaza,$action_type_from_spaza,$current_spaza_shop_id,$product_id,$cur_user_row['id']);
        }
        elseif(isset($_POST['invoicing_spaza_id'],$_POST['invoicing_spaza_amount'],$_POST['invoicingSpazaInputAmount'])){
            $invoicing_spaza_id = $processorNewDao->mmshightech->OMO($_POST['invoicing_spaza_id']);
            $invoicing_spaza_amount = $processorNewDao->mmshightech->OMO($_POST['invoicing_spaza_amount']);
            $invoicingSpazaInputAmount = $processorNewDao->mmshightech->OMO($_POST['invoicingSpazaInputAmount']);
            if($invoicing_spaza_amount>$invoicingSpazaInputAmount){
                $e->responseStatus = Constants::FAILED_STATUS;
                $e->responseMessage = 'Entered amount is less than '.$invoicing_spaza_amount;
            }
            else{
                $e=$invoice->actionProductsTOInvoice($invoicing_spaza_id,$invoicing_spaza_amount,$invoicingSpazaInputAmount,$cur_user_row['id']);
            }
        }
        elseif(isset(
            $_POST["add_label"],
            $_POST["add_sub_label"],
            $_POST["add_description"],
            $_POST["add_manufacture"],
            $_POST["add_brand"],
            $_POST["add_category"],
            $_POST["add_seling_unit"],
            $_POST["add_qantity"],
            $_POST["add_content_uom"],
            $_POST["add_ean_code"],
            $_POST["add_alt_ean"],
            $_POST["add_alt_ean2"],
            $_POST["add_code_single"],
            $_POST["add_start_date"],
            $_POST["add_end_date"],
            $_POST["add_price"],
            $_POST["add_label_promo_price"],
            $_POST["add_percentage_discount"],
            $_POST["add_discount_amount"],
            // $_POST["add_product_id"],
            $_POST["addPromoToggle"],
            $_POST["addInstockToggle"],
        )){
            if(!empty($cur_user_row['supplier_id'])){
                $add_label=$processorNewDao->mmshightech->OMO($_POST['add_label']);
                $add_sub_label=$processorNewDao->mmshightech->OMO($_POST['add_sub_label']);
                $add_description=$processorNewDao->mmshightech->OMO($_POST['add_description']);
                $add_manufacture=$processorNewDao->mmshightech->OMO($_POST['add_manufacture']);
                $add_brand=$processorNewDao->mmshightech->OMO($_POST['add_brand']);
                $add_category=$processorNewDao->mmshightech->OMO($_POST['add_category']);
                $add_seling_unit=$processorNewDao->mmshightech->OMO($_POST['add_seling_unit']);
                $add_qantity=$processorNewDao->mmshightech->OMO($_POST['add_qantity']);
                $add_content_uom=$processorNewDao->mmshightech->OMO($_POST['add_content_uom']);
                $add_ean_code=$processorNewDao->mmshightech->OMO($_POST['add_ean_code']);
                $add_alt_ean=$processorNewDao->mmshightech->OMO($_POST['add_alt_ean']);
                $add_alt_ean2=$processorNewDao->mmshightech->OMO($_POST['add_alt_ean2']);
                $add_code_single=$processorNewDao->mmshightech->OMO($_POST['add_code_single']);
                $add_start_date=$processorNewDao->mmshightech->OMO($_POST['add_start_date']);
                $add_end_date=$processorNewDao->mmshightech->OMO($_POST['add_end_date']);
                $add_price=$processorNewDao->mmshightech->OMO($_POST['add_price']);
                $add_label_promo_price=$processorNewDao->mmshightech->OMO($_POST['add_label_promo_price']);
                $add_percentage_discount=$processorNewDao->mmshightech->OMO($_POST['add_percentage_discount']);
                $add_discount_amount=$processorNewDao->mmshightech->OMO($_POST['add_discount_amount']);
                // $add_product_id=$processorNewDao->mmshightech->OMO($_POST['add_product_id']);
                $addPromoToggle=$processorNewDao->mmshightech->OMO($_POST['addPromoToggle']);
                $addInstockToggle=$processorNewDao->mmshightech->OMO($_POST['addInstockToggle']);
                $e=$products->addNewProductBySupplier($add_label,$add_sub_label,$add_description,$add_manufacture,$add_brand,$add_category,$add_seling_unit,$add_qantity,$add_content_uom,$add_ean_code,$add_alt_ean,$add_alt_ean2,$add_code_single,$add_start_date,$add_end_date,$add_price,$add_label_promo_price,$add_percentage_discount,$add_discount_amount,$addPromoToggle,$addInstockToggle,$cur_user_row['supplier_id']);

            }
            else{
                $e->responseMessage="Failed to process empty request";
                $e->responseStatus=Constants::FAILED_STATUS;
            }
        }
        elseif (isset($_POST['changeIconImg'],$_POST['productId'])) {
            $productId = $processorNewDao->mmshightech->OMO($_POST['productId']);
            if(empty($_FILES)){
                $e->responseMessage="Failed to process empty request";
                $e->responseStatus=Constants::FAILED_STATUS;
            }
            else{
                // print_r($_FILES);
                $toProcess = [];
                $failProcess = [];
                foreach ($_FILES as $fileData){
                    $ext = explode(".",$fileData['name']);
                    $ext = $ext[1];
                    if(in_array(strtolower($ext),['jpg','gif','jpeg','png'])){
                        $toProcess[]=$fileData;
                    }
                    else {
                        $failProcess[] = $ext;
                    }
                }
                if(sizeof($failProcess)>0){
                    $e->responseMessage="{".implode(",",$failProcess)."} Not supported!. Processing Failed.";
                    $e->responseStatus=Constants::FAILED_STATUS;
                }
                else{

                    $terminate = false;
                    $successFiles=[];
                    $dir = "../../img/";
                    foreach($toProcess as $dataFile){
                        // print_r($dataFile);
                        $newFileName = $productId.'_'.$cur_user_row['supplier_id'].'_'.$cur_user_row['id'].'_'.rand(0,90000).'_'.$dataFile['name'];
                        if(!move_uploaded_file($dataFile['tmp_name'],$dir.basename($newFileName))){
                            $terminate = true;
                            break;
                        }
                        $successFiles[]=$newFileName;
                    }
                    if($terminate){
                        $e->responseMessage="Failed to move file due to network error. Please try again.";
                        $e->responseStatus=Constants::FAILED_STATUS;
                    }
                    else{
                        if(empty($cur_user_row['supplier_id'])){
                            $e->responseMessage="You not a supplier, You cannot have update suppliers data.";
                            $e->responseStatus=Constants::FAILED_STATUS;
                        }
                        else{
                            $e=$products->updateProductIcon($cur_user_row['id'],$cur_user_row['supplier_id'],$successFiles,$productId);
                        }
                    }
                }
            }
        }
    }
    catch(\Exception $error){
        $erroObject= ErrorHandler::exceptionBuiler($error);
        $e->responseStatus = Constants::FAILED_STATUS;
        $e->responseMessage = $error->getMessage();
        ErrorHandler::writelogResponse('../../storage/logs/', $erroObject->issueType, $erroObject->class, $erroObject->method, $erroObject);
    }
    // if($e->responseStatus===Constants::RESPONSE_SUCCESS){
    //     $
    // }
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
