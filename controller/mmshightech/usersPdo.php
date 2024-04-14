<?php
namespace controller\mmshightech;
use Controller\mmshightech;
use Classes\response\Response;
class usersPdo{
    private mmshightech $mmshightech;
    private $Response;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->Response = new Response();
    }
    public function getUsersInfoAll():array{
        $sql="SELECT * from users where status='A'";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }
    public function getUserDetailsForUser(?int $userId=0):array{
        $sql = "SELECT * from users where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$userId])[0]??[];
    }
    public function removeThisUser(int $userId=null,?int $adminId=null):Response{
        $sql = "UPDATE users set status='D', removed_by=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$adminId,$userId]);
    }
    public function getUsersInfoSearchAll(string $search=''):array{
        $sql="SELECT * from users where name like ? or surname like ? or usermail like ?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',['%'.$search.'%','%'.$search.'%','%'.$search.'%'])??[];
    }
    public function updateSupplierOnSpazaOner(?int $updateSupplierOnSpazaOner=null,?int $id=null):Response{
        $sql="UPDATE users set supplier_id=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$updateSupplierOnSpazaOner,$id]);

    }
}
