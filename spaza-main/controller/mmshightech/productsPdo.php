<?php

use controller\mmshightech;

class productsPdo{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getSpecialProducts(?int $min,?int $limit):array{
        $sql="select*from products where product_discountable=Y limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
    }
    public function getProducts(?int $min,?int $limit):array{
        $sql="select*from products where product_discountable=N limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$min, $limit])??[];
    }
}

?>