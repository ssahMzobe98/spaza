<?php

namespace Controller\mmshightech;

use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\response\Response;
class productsPdo
{
    private mmshightech $mmshightech;
    private $response;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->response=new Response();
    }
    public function getSpecialProducts(?int $store=null,?int $min,?int $limit):array{
        $sql="select p.*, 
            if(c.quantity='',0,c.quantity) as cart_quantity,
            if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.product_discountable = 'Y' and (now() > p.promo_start_date and now() < p.promo_end_date) and p.is_instock='Y' and p.product_status='A' and p.store_id=? limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',[$store,$min, $limit])??[];
    }
    public function getProductTotalCount():int{
        $sql = "select id from products where product_status='A'";
        return $this->mmshightech->numRows($sql,'',[])??0;
    }
    public function getProducts(?int $store=null,?int $min,?int $limit):array{
        $sql="select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.is_instock='Y' and p.product_status='A' and p.store_id=? limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',[ $store,$min, $limit])??[];
    }
    public function getProductsForDisplay(?int $min,?int $limit):array{
        $sql="select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.product_status='A' order by product_title ASC limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
    }
    public function getProductOfCategory(?int $categoryID,int $min=0,int $limit=100):array{
        $sql="select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.is_instock='Y' and p.product_status='A' and p.menu_catalogue_id = ? limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',[$categoryID,$min, $limit])??[];
    }
    public function getCartProducts(?int $user_id):array
    {
        $sql="select 
                    c.id as cartId,
                    c.user_id as user_id,
                    c.store_id as store_id,
                    c.product_id as id,
                    c.quantity as quantity,
                    p.product_description as product_description,
                    p.product_thumbnail as product_thumbnail,
                    p.product_weight as product_weight,
                    p.product_thumbnail as img,
                    p.is_instock as is_instock,
                    (if(p.product_discountable='Y' and (now() > p.promo_start_date and now() < p.promo_end_date),'Y','N')) as product_discountable,
                    p.price_usd as price_usd,
                    p.promo_price as promo_price
                from cart as c
                    left join products as p on p.id=c.product_id
              where c.user_id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])??[];
    }
    public function isCategoryIdExist(?int $categoryID):bool{
        $sql = "select id from menu_category_ids where id=?";
        $results=$this->mmshightech->getAllDataSafely($sql,'s',[$categoryID])[0]??[];
        return (count($results)==1 && !empty($results['id']) && $results['id']==$categoryID);
    }
    public function getCartProductsTotal(?int $user_id):array{
        $sql = "select 
                    sum(c.quantity * p.price_usd) as sub_total 
                from cart as c 
                    left join products as p on p.id=c.product_id
                where c.user_id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])[0]??[];
    }
    public function getAllAvailableCategoties(){
        $sql = "select id,menu,description,bg_color from menu_category_ids";
        return $this->mmshightech->getAllDataSafely($sql,'',[])??[];
    }
    public function getSearchData(?string $searchProductTableColumn,?string $queryToSearchOnTable,int $min=0,int $limit=20):array{
        $sql = "select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.product_status='A' and p.{$searchProductTableColumn} like ? limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',["%".$queryToSearchOnTable."%",$min, $limit])??[];
    }
    public function productExists(?int $productUid){
        $sql="select id from products where id=?";
        $re= $this->mmshightech->getAllDataSafely($sql,'s',[$productUid])[0]??[];
        return (empty($re)?
                false:
                ($re['id']===$productUid))?
                    true:
                    false;
    }
    public function getDataOnThisProduct(?int $productUid):array{
        if(!$this->productExists($productUid)){
            return ['error'=>$productUid." Not found."];
        }
        $sql="SELECT p.*,
                    mci.menu as category
        from products as p 
            left join menu_category_ids as mci on mci.id=p.menu_catalogue_id
        where p.id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$productUid])[0]??[];
    }
    public function getCategory(int $menu_id=0):array{
        $sql = "select id,menu from menu_category_ids where id != ?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$menu_id])??[];
    }
    public function productPicked(?int $order_id=null,?int $product_id=null):bool{
        $sql = "SELECT is_picked from order_details where order_id=? and product_id=?";
        $results = $this->mmshightech->getAllDataSafely($sql,'ss',[$order_id,$product_id])[0]??[];
        if(empty($results['is_picked'])){
            return false;
        }
        return ($results['is_picked']===Constants::SUCCESS_YES);
    }
    public function updateProductInfo(
             int|string|array|float|null $amend_label=null
            ,int|string|array|float|null $amend_sub_label=null
            ,int|string|array|float|null $amend_description=null
            ,int|string|array|float|null $amend_manufacture=null
            ,int|string|array|float|null $amend_brand=null
            ,int|string|array|float|null $amend_category=null
            ,int|string|array|float|null $amend_seling_unit=null
            ,int|string|array|float|null $amend_qantity=null
            ,int|string|array|float|null $amend_content_uom=null
            ,int|string|array|float|null $amend_ean_code=null
            ,int|string|array|float|null $amend_alt_ean=null
            ,int|string|array|float|null $amend_alt_ean2=null
            ,int|string|array|float|null $amend_code_single=null
            ,int|string|array|float|null $amend_start_date=null
            ,int|string|array|float|null $amend_end_date=null
            ,int|string|array|float|null $amend_price=null
            ,int|string|array|float|null $amend_label_promo_price=null
            ,int|string|array|float|null $amend_percentage_discount=null
            ,int|string|array|float|null $amend_discount_amount=null
            ,?int $product_id=null):Response{
        $sql="UPDATE products set 
                product_title=?,
                product_subtitle=?,
                product_description=?,
                manufacture=?,
                brand=?,
                menu_catalogue_id=?,
                product_weight=?,
                available_quantiy=?,
                uom=?,
                variant_barcode=?,
                variant_barcode_alt=?,
                variant_barcode_alt2=?,
                product_hs_code=?,
                promo_start_date=?,
                promo_end_date=?,
                price_usd=?,
                promo_price=?,
                promo_percentage=?,
                discount_amount=?
        where id=?";
        return $this->mmshightech->newPostDataSafely($sql,'ssssssssssssssssssss',[$amend_label,$amend_sub_label,$amend_description,$amend_manufacture,$amend_brand,$amend_category,$amend_seling_unit,$amend_qantity,$amend_content_uom,$amend_ean_code,$amend_alt_ean,$amend_alt_ean2,$amend_code_single,$amend_start_date,$amend_end_date,$amend_price,$amend_label_promo_price,$amend_percentage_discount,$amend_discount_amount,$product_id]);
    }
    public function updatePromoStockIssue(?int $productCodeToAttendToData=null,?string $fieldToAttendTOData=Constants::IS_INSTOCK_TABLE_COL):Response{
        $setter=Constants::IS_PRODUCT_DISCOUNTABLE_TABLE_COL."=?";
        
        if($fieldToAttendTOData===Constants::IS_INSTOCK_TABLE_COL){
            $setter = Constants::IS_INSTOCK_TABLE_COL."=?";
        }
        $value = $this->getValueOf($fieldToAttendTOData,$productCodeToAttendToData);
        if(empty($value)){
            return $this->response->failureSetter()->messagerSetter("Failed to process due to empty value")->messagerArraySetter(['error'=>"Failed to process due to empty value.",'Error_list'=>[]]);
        }
        if($value===Constants::SUCCESS_YES){
            $value = Constants::SUCCESS_NO;
        }
        else{
            $value=Constants::SUCCESS_YES;
        }
        $sql="UPDATE products set  {$setter} where id = ?";
        return $this->mmshightech->newPostDataSafely($sql,'ss',[$value,$productCodeToAttendToData]);
    }
    public function getValueOf(?string $fieldToAttendTOData=Constants::IS_INSTOCK_TABLE_COL,?int $productCodeToAttendToData=null):string{
        $sql="SELECT {$fieldToAttendTOData} from products where id=?";
        $results = $this->mmshightech->getAllDataSafely($sql,'s',[$productCodeToAttendToData])[0]??[];
        if(empty($results)){
            return '';
        }
        $data=$results[Constants::IS_INSTOCK_TABLE_COL]??'';
        if(empty($data)){
            $data=$results[Constants::IS_PRODUCT_DISCOUNTABLE_TABLE_COL]??'';
        }
        return $data;

    }
    public function getProductFromSpaza(?int $current_spaza=null):array{
        $sql="SELECT 
                    sp.product_quantity as in_stock,
                    sp.spaza_id as spaza,
                    sp.out_of_stock as is_in_stock,
                    sp.id as spaza_product_id,
                    mci.menu as menu,
                    p.product_title as title,
                    p.product_description as description,
                    p.product_thumbnail as img,
                    p.product_weight as weight,
                    p.product_hs_code as hs_code,
                    p.variant_barcode as barcode,
                    sp.selling_price as price
                from 
                spaza_product as sp 
                left join products as p on p.id=sp.product_id
                left join menu_category_ids as mci on mci.id=p.menu_catalogue_id
                where sp.spaza_id=? and sp.status='A'
             ";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$current_spaza])??[];
    }
}
