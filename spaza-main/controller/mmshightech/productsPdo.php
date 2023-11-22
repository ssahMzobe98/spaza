<?php

namespace controller\mmshightech;

use controller\mmshightech;

class productsPdo
{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getSpecialProducts(?int $min,?int $limit):array{
        $sql="select p.*, if(c.quantity='',0,c.quantity) as cart_quantity
            from products as p
                left join cart as c on c.product_id = p.id
            where p.product_discountable = 'Y' limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
    }
    public function getProducts(?int $min,?int $limit):array{
        $sql="select p.*, if(c.quantity='',0,c.quantity) as cart_quantity
            from products as p
                left join cart as c on c.product_id = p.id
            limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
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
}