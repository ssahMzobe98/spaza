<?php

namespace controller\mmshightech;

use Controller\mmshightech;

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
    public function getProducts(?int $min,?int $limit):array{
        $sql="select p.*, 
                if(c.quantity='',0,c.quantity) as cart_quantity,
                if(now() > p.promo_start_date and now() < p.promo_end_date, p.promo_price,'') as promo_price_to_display
            from products as p
                left join cart as c on c.product_id = p.id
            where p.is_instock='Y' and p.product_status='A' limit ?,?";
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
                    p.product_discountable as product_discountable,
                    p.price_usd as price_usd
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
}