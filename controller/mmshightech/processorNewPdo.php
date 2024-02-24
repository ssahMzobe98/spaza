<?php
namespace controller\mmshightech;
use Controller\mmshightech;
use Controller\mmshightech\csvProcessor;
class processorNewPdo
{
    public mmshightech $mmshightech;
    public $csvProcessor;
    public function __construct(mmshightech $mmshightech)
    {
        //include_once ("../mmshightech.php");
        $this->mmshightech = $mmshightech;
        $this->csvProcessor = new csvProcessor();

    }
    public function userInfo(string $userMail=null):array{
        return $this->mmshightech->userInfo($userMail)??[];
    }
    public function processCSVfileSave(string $filename = '',int $adminId=0):array{
        $sql = "insert into csv_uploads_for_product_creation(csv,time_uploaded,uploaded_by)values(?,NOW(),?)";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$filename,$adminId]);
        if(is_numeric($response)){
            return ['response'=>"S",'data'=>"Success"];
        }
        else{
            return ['response'=>"F",'data'=>$response];
        }
    }
    public function uploadCSVData(string $header = "",array $data=[],int $adminId=0):array{
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
            $response = $this->mmshightech->postDataSafely($sql,$strParams,$params);
            if(!is_numeric($response)){
                $isProcessed=false;
                $error[]=$response;
                break;
            }
        }
        if($isProcessed){
            return ['response'=>"S",'data'=>"Success"];
        }
        return ['response'=>"F",'data'=>$error];
    }

    public function processBackgroundDisplay(int $dome=null,int $user_id=null):array
    {
        $dome = $this->mmshightech->OMO($dome);
        $sql = "update users set background =? where id =?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$dome,$user_id]);;
        if(is_numeric($response)){
            return ['response'=>'S','data'=>'Success'];
        }
        return ['response'=>'F','data'=>$response];
    }
    public function getProductQuantityOnCart(?int $id,?int $productIdToActionOnCart):int{
        $quantity=$this->mmshightech->getAllDataSafely('select  quantity 
                                                        from cart 
                                                        where user_id=? 
                                                        and product_id=?',
                                                        'ss',
                                                        [$id,$productIdToActionOnCart])[0]??[];
        return $quantity['quantity']??0;

    }
    public function cartProcessor(?int $productIdToActionOnCart, ?string $actionType, ?int $id):array
    {
        $currentQuantity = $this->getProductQuantityOnCart($id, $productIdToActionOnCart) ?? 0;

        if (strtolower($actionType) == 'add') {
            if ($currentQuantity == 0) {
                $response = $this->addToCart($id, $productIdToActionOnCart);
            } else {
                $currentQuantity++;
                $response = $this->updateItemOnCart($id, $productIdToActionOnCart, $currentQuantity);
            }
        } else {
            $currentQuantity--;
            if ($currentQuantity < 1) {
                $response = $this->removeFromCart($id, $productIdToActionOnCart);
            } else {
                $response = $this->updateItemOnCart($id, $productIdToActionOnCart, $currentQuantity);
            }
        }

        return $response ?? ['response' => 'F', 'data' => 'Failed to run ' . __FUNCTION__ . ' on line ' . __LINE__];
    }

    private function addToCart(?int $id, ?int $productIdToActionOnCart):array
    {
        $sql = "insert into cart(product_id,user_id,store_id,quantity,time_added)values(?,?,1,1,now())";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$productIdToActionOnCart,$id]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>1];
        }
        return['response'=>'F','data'=>$response];
    }

    private function updateItemOnCart(?int $id, ?int $productIdToActionOnCart, int $currentQuantity):array
    {
        $sql = "update cart set quantity=?,time_added=NOW() where product_id=? and user_id=?";
        $response = $this->mmshightech->postDataSafely($sql,'sss',[$currentQuantity,$productIdToActionOnCart,$id]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$currentQuantity];
        }
        return['response'=>'F','data'=>$response];
    }

    private function removeFromCart(?int $id, ?int $productIdToActionOnCart):array
    {
        $sql = "delete from cart where product_id={$productIdToActionOnCart} and user_id={$id}";
        $response = $this->mmshightech->connection->query($sql);
        if($response){
            return['response'=>'S','data'=>0];
        }
        return['response'=>'F','data'=>$response->error];
    }

    public function getCartUpdates(?int $id):int
    {
        $response=$this->mmshightech->getAllDataSafely(
            'select sum(quantity) as total from cart where user_id=?',
            's',
            [$id]
        )[0]??[];
        return $response['total']??0;
    }

    public function emptyCart(?int $id):array
    {
        $sql = "delete from cart where user_id={$id}";
        $response = $this->mmshightech->connection->query($sql);
        if($response){
            return['response'=>'S','data'=>0];
        }
        return['response'=>'F','data'=>$response->error];
    }

    public function removeProductFromCart(?int $cartIdToRemove, ?int $id):array
    {
        $sql = "delete from cart where id={$cartIdToRemove} and user_id={$id}";
        $response = $this->mmshightech->connection->query($sql);
        if($response){
            return['response'=>'S','data'=>0];
        }
        return['response'=>'F','data'=>$response->error];
    }

    public function spazaUpdater(?int $spazaShopsDisplay,?int $id,?int $orderId):array
    {
        $sql="UPDATE users set current_spaza=? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$spazaShopsDisplay,$id]);
        if(is_numeric($response)){
            $sql="UPDATE orders set spaza_id=? where id=?";
            $response = $this->mmshightech->postDataSafely($sql,'ss',[$spazaShopsDisplay,$orderId]);
            if(is_numeric($response)){
                 return ['response'=>'S','data'=>$response];
            }
           return ['response'=>'F','data'=> $response];
        }
        return ['response'=>'F','data'=> $response];
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
                                       ?string $id):array
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
        $response = $this->mmshightech->postDataSafely($sql,'sssssssssssssssssssssss',$params);
        if(is_numeric($response)){
            return $this->updateUserSpazaId($spazaOwnerId,$response);
        }
        return['response'=>'F','data'=>$response];
    }
    public function updateUserSpazaId(?int $user_id=null,?int $spaza_id=null):array{
        $sql="update users set current_spaza=? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$spaza_id,$user_id]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$spaza_id];
        }
        return['response'=>'F','data'=>$response];
    }
    public function spazaIdToBeRemoved(?int $spaza_id_toBeRemoved):array
    {
        $sql="update spaza_details set status='D' where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'s',[$spaza_id_toBeRemoved]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];

    }

    public function addAddress(?string $countryOfOriginAddress, ?string $map_dir, ?int $spaza_id_to_add_address):array
    {
        $column = 'origin_address';
        if($map_dir=='d'){
            $column = 'spaza_address';
        }
        $sql="update spaza_details set {$column} = ? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$countryOfOriginAddress,$spaza_id_to_add_address]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }

    public function saveProcessedDocuments(?int $spazaVisaDetailsId,?array $newNames,?array $tmp):array
    {
        $visa_number=$tmp[0];
        $permit_number=$tmp[1];
        $visa_passport_number_doc= $newNames[0];
        $permit_number_doc= $newNames[1];
        $sql="update spaza_details set permit_number=?,visa_number=?,copy_of_permit=?,passport_id_copy=? where id =?";
        $response = $this->mmshightech->postDataSafely($sql,'sssss',[$permit_number,$visa_number,$permit_number_doc,$visa_passport_number_doc,$spazaVisaDetailsId]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }

    public function saveProcessedLegalDocuments(?int $spazaLegalDocumentId,?array $newNames):array
    {
        $photo=$newNames[0];
        $spazaAddress=$newNames[1];
        $residentalAddress=$newNames[2];
        $countryOfOriginAddress=$newNames[3];
        $sql="update spaza_details set proof_of_origin_address=?,proof_of_residental_adress=?,proof_of_spaza_address=?,rep_facial_img=? where id =?";
        $response = $this->mmshightech->postDataSafely($sql,'sssss',[$countryOfOriginAddress,$residentalAddress,$spazaAddress,$photo,$spazaLegalDocumentId]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }

    public function removeCardDetailsFromUser(int $clientIdFromRemoveCardDetails):array
    {
        $sql="update users set card_number='',card_expiry_date='',card_name='',card_type='',card_cvv='',card_token='' where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'s',[$clientIdFromRemoveCardDetails]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }

    public function updateCardDetailsFromUser(int $clientIdToAddBankDetailsTo=null, string $cname=null, int $ccnum=null, string $expmonth=null, string $expyear=null, int $cvv=null,bool $remove=false):array
    {
        if($remove){
            return $this->removeCardDetailsFromUser($clientIdToAddBankDetailsTo);
        }
        else{
            $expiry=$expmonth.'/'.$expyear;
            $sql="update users set card_number=?,card_expiry_date=?,card_name=?,card_cvv=? where id=?";
            $response = $this->mmshightech->postDataSafely($sql,'sssss',[$ccnum,$expiry,$cname,$cvv,$clientIdToAddBankDetailsTo]);
            if(is_numeric($response)){
                return['response'=>'S','data'=>$response];
            }
            return['response'=>'F','data'=>$response];
        }

    }
    public function createNewUser($fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$nationalityNewUser,$Passport_idNewUser,$genderNewUser,$userDOBNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$userEmailAddressNewUser,$userPasswordNewUser,array $newFilesNames=[],int $id=0):array{
        if($this->mmshightech->isUserExists($userEmailAddressNewUser)){
            return ['response'=>'F','data'=>'user with this email already exist.'];
        }
        if(empty($newFilesNames)){
            $newFilesNames=[
                0=>'',1=>'',2=>'',3=>''
            ];
        }
        $userPasswordNewUser = $this->mmshightech->lockPassWord($userPasswordNewUser);
        $params = [$userEmailAddressNewUser,$userPasswordNewUser,$fnameNewUser,$lnameNewUser,$phoneNumberNewUser,$userDOBNewUser,$genderNewUser,$nationalityNewUser,$Passport_idNewUser,$permitNumberNewUser,$coutryOfOriginAddressNewUser,$saResidingAddressNewUser,$newFilesNames[0],$newFilesNames[1],$newFilesNames[2],$newFilesNames[3],$id];
        $sql = "insert into users(usermail,
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
                                added_by)values(?,?,?,1,?,'APP',1,'',?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
        $response = $this->mmshightech->postDataSafely($sql,'sssssssssssssssss',$params);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];

    }
    public function addaPaymentDetails(?string $NameOnCard,?string $cardNumber,?string $expiryDate,?string $cvv,?string $client_id_toSave2):array{
        $params=[$NameOnCard,$cardNumber,$expiryDate,$cvv,$client_id_toSave2];
        $sql = "update users set card_name=?,card_number=?,card_expiry_date=?,card_cvv=? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'sssss',$params);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }
}