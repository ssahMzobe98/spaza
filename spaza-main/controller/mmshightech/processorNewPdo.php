<?php

namespace controller\mmshightech;
include_once ("./csvProcessor.php");
use controller\mmshightech;
//use controller\mmshightech\csvProcessor;
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
        $currentQuantity = $this->getProductQuantityOnCart($id,$productIdToActionOnCart)??0;
        if($actionType.strtolower('add')){
            if($currentQuantity==0){
                $response = $this->addTOCart($id,$productIdToActionOnCart);
            }
            else{
                $currentQuantity++;
                $response = $this->updateItemOnCart($id,$productIdToActionOnCart,$currentQuantity);
            }
        }
        else{
            $currentQuantity--;
            if($currentQuantity==0){
                $response = $this->removeFromCart($id,$productIdToActionOnCart);
            }
            else{
                $response = $this->updateItemOnCart($id,$productIdToActionOnCart,$currentQuantity);
            }
        }
        return $response??['response'=>'F','data'=>'Failed to run'.__FUNCTION__.' on line '.__LINE__];
    }

    private function addTOCart(?int $id, ?int $productIdToActionOnCart):array
    {
        $sql = "insert into cart(product_id,user_id,store_id,quantity,time_added)values(?,?,NULL,1,now())";
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

    public function spazaUpdater(?int $spazaShopsDisplay,?int $id):array
    {
        $sql="update users set current_spaza=? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$spazaShopsDisplay,$id]);
        if(is_numeric($response)){
            return['response'=>'S','data'=>$response];
        }
        return['response'=>'F','data'=>$response];
    }
}