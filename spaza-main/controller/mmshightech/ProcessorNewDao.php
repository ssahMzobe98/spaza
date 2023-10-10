<?php
class ProcessorNewDao{
    private $mmshightech;
    public $csvProcessor;
    public function __construct()
    {
        include_once ("../mmshightech.php");
        include_once ("csvProcessor.php");
        $this->mmshightech = new mmshightech();
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
}
?>
