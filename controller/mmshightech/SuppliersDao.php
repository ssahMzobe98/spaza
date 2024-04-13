<?php

namespace Controller\mmshightech;

use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\response\Response;
class SuppliersDao
{
	private mmshightech $mmshightech;
    private $response;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->response=new Response();
    }
    public function getSuppliers():array{
    	$sql="select store_name,id from store_suppliers";
    	return $this->mmshightech->getAllDataSafely($sql,'',[])??[];
    }
    public function getThisSupplier(?int $supplier_id):array{
    	$sql="select store_name,id from store_suppliers where id=?";
    	return $this->mmshightech->getAllDataSafely($sql,'s',[$supplier_id])[0]??[];
    }

}