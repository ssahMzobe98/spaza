<?php
namespace controller\mmshightech;
use Controller\mmshightech;
class usersPdo{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getUsersInfoAll():array{
        $sql="select*from users;";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }
    public function getUserDetailsForUser(?int $userId=0):array{
        $sql = "select * from users where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$userId])[0]??[];
    }

}
