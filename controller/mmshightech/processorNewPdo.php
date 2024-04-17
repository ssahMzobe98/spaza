<?php
namespace controller\mmshightech;
use Controller\mmshightech;
use Controller\mmshightech\csvProcessor;
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
use Classes\response\Response;
class processorNewPdo
{
    public mmshightech $mmshightech;
    public $csvProcessor;
    private $wallet;
    private $Response;
    // RESPONSE_SUCCESS
    // RESPONSE_FAILED 
    public function __construct(mmshightech $mmshightech)
    {
        $this->mmshightech = $mmshightech;
        $this->csvProcessor = new csvProcessor();
        $this->wallet = PDOFactoryOOPClass::make(Constants::WALLET,[$mmshightech,PDOFactoryOOPClass::make(Constants::PRODUCT,[$mmshightech])]);
        $this->Response = new Response();

    }
    public function userInfo(string $userMail=null):array{
        return $this->mmshightech->userInfo($userMail)??[];
    }
    public function processCSVfileSave(string $filename = '',int $adminId=0):Response{
        $sql = "insert into csv_uploads_for_product_creation(csv,time_uploaded,uploaded_by)values(?,NOW(),?)";
        return $this->mmshightech->postDataSafely($sql,'ss',[$filename,$adminId]);
    }
    public function uploadCSVData(string $header = "",array $data=[],int $adminId=0):Response{
        $sql = "insert into products (product_handle,
                                      product_title,
                                      product_subtitle,
                                      product_description,
                                      product_status,
                                      product_thumbnail,
                                      product_weight,
                                      product_length,
                                      product_width,
                                      product_height,
                                      product_hs_code,
                                      product_origin_country,
                                      product_material,
                                      product_collection_title,
                                      product_collection_handle,
                                      product_type,
                                      product_tags,
                                      product_discountable,
                                      product_profile_name,
                                      product_profile_type,
                                      variant_title,
                                      variant_sku,
                                      variant_barcode,
                                      variant_inventory_quantity,
                                      variant_manage_inventory,
                                      price_usd,
                                      option_1_name,
                                      option_1_value,
                                      option_2_name,
                                      option_2_value,
                                      sales_channel_1_name,
                                      time_added,
                                      query_by	
                                    )values(
                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?
                                    )";
        $strParams = "ssssssssssssssssssssssssssssssss";
        $isProcessed = true;
        $error=[];
        foreach ($data as $d){
            $params = $d;
            $params[]=$adminId;
            $this->Response = $this->mmshightech->postDataSafely($sql,$strParams,$params);
            if(!is_numeric($response)){
                $isProcessed=false;
                break;
            }
        }
        return  $this->Response;
    }

    public function processBackgroundDisplay(int $dome=null,int $user_id=null):Response
    {
        $dome = $this->mmshightech->OMO($dome);
        $sql = "update users set background =? where id =?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$dome,$user_id]);;
    }
    public function getProductQuantityOnCart(?int $id,?int $productIdToActionOnCart,?int $supplier_store_id=null):int{
        $response = $this->mmshightech->getAllDataSafely('select  quantity 
                                                        from cart 
                                                        where user_id=?
                                                        and store_id=? 
                                                        and product_id=?',
                                                        'sss',
                                                        [$id,$supplier_store_id,$productIdToActionOnCart,])[0]??[];
        return $response['quantity']??0;
    }
    public function cartProcessor(?int $productIdToActionOnCart, ?string $actionType, ?int $id,?int $supplier_store_id=null):Response
    {
        $currentQuantity = $this->getProductQuantityOnCart($id, $productIdToActionOnCart,$supplier_store_id) ?? 0;

        if (strtolower($actionType) == 'add') {
            if ($currentQuantity == 0) {
                $this->Response = $this->addToCart($id, $productIdToActionOnCart,$supplier_store_id);
            } else {
                $currentQuantity++;
                $this->Response = $this->updateItemOnCart($id, $productIdToActionOnCart, $currentQuantity,$supplier_store_id);
            }
        } else {
            $currentQuantity--;
            if ($currentQuantity < 1) {
                $this->Response = $this->removeFromCart($id, $productIdToActionOnCart,$supplier_store_id);
            } else {
                $this->Response = $this->updateItemOnCart($id, $productIdToActionOnCart, $currentQuantity,$supplier_store_id);
            }
        }
        if($this->Response->responseStatus===Constants::RESPONSE_SUCCESS){
            $this->Response->responseMessage = $this->getProductQuantityOnCart($id, $productIdToActionOnCart,$supplier_store_id)??0;
        }

        return  $this->Response;
    }

    private function addToCart(?int $id, ?int $productIdToActionOnCart,?int $supplier_store_id=null):Response
    {
        $sql = "insert into cart(product_id,user_id,store_id,quantity,time_added)values(?,?,?,1,now())";
        return $this->mmshightech->postDataSafely($sql,'sss',[$productIdToActionOnCart,$id,$supplier_store_id]);
    }

    private function updateItemOnCart(?int $id, ?int $productIdToActionOnCart, int $currentQuantity,?int $supplier_store_id=null):Response
    {
        $sql = "update cart set quantity=?,time_added=NOW() where product_id=? and user_id=? and store_id=?";
        return $this->mmshightech->postDataSafely($sql,'ssss',[$currentQuantity,$productIdToActionOnCart,$id,$supplier_store_id]);
    }

    private function removeFromCart(?int $id, ?int $productIdToActionOnCart,?int $supplier_store_id=null):Response
    {
        $sql = "delete from cart where product_id={$productIdToActionOnCart} and user_id={$id} and store_id={$supplier_store_id}";
        return $this->mmshightech->connection->query($sql);
    }

    public function getCartUpdates(?int $id,?int $supplier_store_id=null):int
    {
        $response=$this->mmshightech->getAllDataSafely(
            'select sum(quantity) as total from cart where user_id=? and store_id=?',
            'ss',
            [$id,$supplier_store_id]
        )[0]??[];
        return $response['total']??0;
    }

    public function emptyCart(?int $id,?int $supplier_store_id=null):Response
    {
        $sql="";
        if($supplier_store_id!==null){
            $sql=" and store_id={$supplier_store_id}";
        }
        $sql = "delete from cart where user_id={$id} ".$sql;
        $response = $this->mmshightech->connection->query($sql);
         $this->Response->responseStatus=Constants::RESPONSE_FAILED;
        if($response){
            $this->Response->responseStatus=Constants::RESPONSE_SUCCESS;
        }
        $this->Response->responseMessage=$response;
        return $this->Response;
    }

    public function removeProductFromCart(?int $cartIdToRemove, ?int $id,?int $supplier_store_id=null):Response
    {
        $sql = "delete from cart where id={$cartIdToRemove} and user_id={$id} and store_id={$supplier_store_id}";
        $response = $this->mmshightech->connection->query($sql);
        $this->Response->responseStatus=Constants::RESPONSE_FAILED;
        if($response){
            $this->Response->responseStatus=Constants::RESPONSE_SUCCESS;
        }
        $this->Response->responseMessage=$response;
        return $this->Response;
    }

    public function spazaUpdater(?int $spazaShopsDisplay,?int $id,?int $orderId):Response
    {
        $sql="UPDATE users set current_spaza=? where id=?";
        $this->Response = $this->mmshightech->postDataSafely($sql,'ss',[$spazaShopsDisplay,$id]);
        if($this->Response->responseStatus===Constants::RESPONSE_SUCCESS){
            $sql="UPDATE orders set spaza_id=? where id=?";
            $this->Response = $this->mmshightech->postDataSafely($sql,'ss',[$spazaShopsDisplay,$orderId]);
        }
        return $this->Response;
    }

    public function addNewSpazaDetails(?int $spazaOwnerId,
                                       ?string $userPhoneNo,
                                       ?string $userDOB,
                                       ?string $gender,
                                       ?string $country,
                                       ?string $id_passport,
                                       ?string $lname,
                                       ?string $fname,
                                       ?string $spaza,
                                       ?string $userEmailAddress,
                                       ?string $id):Response
    {
        $params=[$spazaOwnerId,$spaza,$fname,
            $lname, $userPhoneNo,
            $userEmailAddress, $id_passport,
            null, null,
            $gender, $country,
            null, null, null,
            null, null, null,
            null, null,
            0, null, $id,null];
        $sql = "insert into spaza_details(spaza_owner_id,
                                            spaza_name,
                                            rep_name,
                                            rep_surname,
                                            phone_number,
                                            email_address,
                                            id_passport_number,
                                            permit_number,
                                            visa_number,
                                            gender,
                                            country_of_origin,
                                            origin_address,
                                            spaza_address,
                                            passport_id_copy,
                                            proof_of_origin_address,
                                            proof_of_residental_adress,
                                            copy_of_permit,
                                            proof_of_spaza_address,
                                            rep_facial_img,
                                            is_veryfied,
                                            time_added,
                                            time_verified,
                                            added_by,
                                            verified_by	
                                        )values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?)";
        return $this->mmshightech->postDataSafely($sql,'sssssssssssssssssssssss',$params);
    }
    public function updateUserSpazaId(?int $user_id=null,?int $spaza_id=null):Response{
        $sql="update users set current_spaza=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$spaza_id,$user_id]);
    }
    public function spazaIdToBeRemoved(?int $spaza_id_toBeRemoved):Response
    {
        $sql="update spaza_details set status='D' where id=?";
        return $this->mmshightech->postDataSafely($sql,'s',[$spaza_id_toBeRemoved]);
    }

    public function addAddress(?string $countryOfOriginAddress, ?string $map_dir, ?int $spaza_id_to_add_address):Response
    {
        $column = 'origin_address';
        if($map_dir=='d'){
            $column = 'spaza_address';
        }
        $sql="update spaza_details set {$column} = ? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$countryOfOriginAddress,$spaza_id_to_add_address]);
    }

    public function saveProcessedDocuments(?int $spazaVisaDetailsId,?array $newNames,?array $tmp):Response
    {
        $visa_number=$tmp[0];
        $permit_number=$tmp[1];
        $visa_passport_number_doc= $newNames[0];
        $permit_number_doc= $newNames[1];
        $sql="update spaza_details set permit_number=?,visa_number=?,copy_of_permit=?,passport_id_copy=? where id =?";
        return $this->mmshightech->postDataSafely($sql,'sssss',[$permit_number,$visa_number,$permit_number_doc,$visa_passport_number_doc,$spazaVisaDetailsId]);
    }

    public function saveProcessedLegalDocuments(?int $spazaLegalDocumentId,?array $newNames):Response
    {
        $photo=$newNames[0];
        $spazaAddress=$newNames[1];
        $residentalAddress=$newNames[2];
        $countryOfOriginAddress=$newNames[3];
        $sql="update spaza_details set proof_of_origin_address=?,proof_of_residental_adress=?,proof_of_spaza_address=?,rep_facial_img=? where id =?";
        return $this->mmshightech->postDataSafely($sql,'sssss',[$countryOfOriginAddress,$residentalAddress,$spazaAddress,$photo,$spazaLegalDocumentId]);
    }

    public function removeCardDetailsFromUser(int $clientIdFromRemoveCardDetails):Response
    {
        $sql="update users set card_number='',card_expiry_date='',card_name='',card_type='',card_cvv='',card_token='' where id=?";
        return $this->mmshightech->postDataSafely($sql,'s',[$clientIdFromRemoveCardDetails]);
    }

    public function updateCardDetailsFromUser(int $clientIdToAddBankDetailsTo=null, string $cname=null, int $ccnum=null, string $expmonth=null, string $expyear=null, int $cvv=null,bool $remove=false):Response
    {
        if($remove){
            return $this->removeCardDetailsFromUser($clientIdToAddBankDetailsTo);
        }
        else{
            $expiry=$expmonth.'/'.$expyear;
            $sql="update users set card_number=?,card_expiry_date=?,card_name=?,card_cvv=? where id=?";
            return $this->mmshightech->postDataSafely($sql,'sssss',[$ccnum,$expiry,$cname,$cvv,$clientIdToAddBankDetailsTo]);
        }

    }
    public function createNewUser($fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$nationalityNewUser,$Passport_idNewUser,$genderNewUser,$userDOBNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$userEmailAddressNewUser,$userPasswordNewUser,array $newFilesNames=[],int $id=0,?int $storeSupplierId=null):Response{
        if($this->mmshightech->isUserExists($userEmailAddressNewUser)){
            $this->Response->responseStatus='F';
            $this->Response->responseMessage='user with this email already exist.';
            return $this->Response;
        }
        if(empty($newFilesNames)){
            $newFilesNames=[
                0=>'',1=>'',2=>'',3=>''
            ];
        }
        $userPasswordNewUser = $this->mmshightech->lockPassWord($userPasswordNewUser);
        $params = [$storeSupplierId,$userEmailAddressNewUser,$userPasswordNewUser,$fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$userDOBNewUser,$genderNewUser,$nationalityNewUser,$Passport_idNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$newFilesNames[0],$newFilesNames[1],$newFilesNames[2],$newFilesNames[3],$id];
        $app="APP";
        if($storeSupplierId!==null){
            $app="SUPPLIER";
        }
        $sql = "insert into users(supplier_id,usermail,
                                security,
                                name,
                                background,
                                surname,
                                user_type,
                                store_id,
                                app_version,
                                phone_number,
                                dob,
                                gender,
                                nationality,
                                passport_id_no,
                                permit_no,
                                country_of_origin_address,
                                sa_residing_address,
                                passport_id_copy,
                                country_of_origin_proof_of_address,
                                facial_image,
                                proof_of_residental_address_sa,
                                time_added,
                                added_by)values(?,?,?,?,1,?,'{$app}',1,'',?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
        $this->Response=$this->mmshightech->postDataSafely($sql,'ssssssssssssssssss',$params);
        if($this->Response->responseStatus===Constants::RESPONSE_FAILED){
            return $this->Response;
        }
        return $this->wallet->createWallet($this->Response->responseMessage);
    }
    public function addaPaymentDetails(?string $NameOnCard,?string $cardNumber,?string $expiryDate,?string $cvv,?string $client_id_toSave2):array{
        $params=[$NameOnCard,$cardNumber,$expiryDate,$cvv,$client_id_toSave2];
        $sql = "update users set card_name=?,card_number=?,card_expiry_date=?,card_cvv=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'sssss',$params);
    }
}