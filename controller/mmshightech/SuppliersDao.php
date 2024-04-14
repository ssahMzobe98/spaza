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
    public function createNewSupplier(?string $storeName=null,?string $storePhone=null,?string $storeNationality=null,?string $storeProvince=null,?string $storeAddress=null,?string $storeRegNo=null,?string $storeAdminName=null,?string $storeAdminSurname=null,?int $storeAdminIDNo=null,?string $storeEmployeeCode=null,?string $storeAdminEmail=null,?string $storePassword=null,?string $filename=null,?int $adminID):Response{
        $sql="INSERT into store_suppliers(store_name,store_address,store_registration_no,provice,store_admin_name,store_admin_surname,email,password,phone,img,store_admin_id_no  ,store_admin_employee_code,status,date_added,added_by,store_nationality)values(?,?,?,?,?,?,?,?,?,?,?,?,'A',NOW(),?,?)";
        $params = [$storeName,$storeAddress,$storeRegNo,$storeProvince,$storeAdminName,$storeAdminSurname,$storeAdminEmail,$storePassword,$storePhone,$filename,$storeAdminIDNo,$storeEmployeeCode,$adminID,$storeNationality];
        return $this->mmshightech->postDataSafely($sql,'ssssssssssssss',$params);
    }

}