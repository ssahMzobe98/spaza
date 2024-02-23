<?php

namespace controller\mmshightech;

use Controller\mmshightech;
use Classes\constants\Constants;

class productsPdo
{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getSpecialProducts(?int $min,?int $limit):array{
        $sql="select p.*, 
            if(c.quantity='',0,c.quantity) as cart_quantity,
            if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.product_discountable = 'Y' and p.is_instock='Y' and p.product_status='A' limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
    }
    public function getProductTotalCount():int{
        $sql = "select id from products where product_status='A'";
        return $this->mmshightech->numRows($sql,'',[])??0;
    }
    public function getProducts(?int $min,?int $limit):array{
        $sql="select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.is_instock='Y' and p.product_status='A' limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
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
}