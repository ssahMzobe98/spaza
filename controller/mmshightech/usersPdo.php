<?php
namespace controller\mmshightech;
use Controller\mmshightech;
class usersPdo{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getUsersInfoAll():array{
        $sql="SELECT * from users where status='A'";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }
    public function getUserDetailsForUser(?int $userId=0):array{
        $sql = "SELECT * from users where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$userId])[0]??[];
    }
    public function removeThisUser(int $userId=null,?int $adminId=null):array{
        $sql = "UPDATE users set status='D', removed_by=? where id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$adminId,$userId]);
        if(is_numeric($response)){
            return ['response'=>"S",'data'=>$response];
        }
        return ['response'=>'F','data'=>$response];
    }
    public function getUsersInfoSearchAll(string $search=''):array{
        $sql="SELECT * from users where name like ? or surname like ? or usermail like ?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',['%'.$search.'%','%'.$search.'%','%'.$search.'%'])??[];
    }
}
