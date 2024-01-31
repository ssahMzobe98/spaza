<?php
namespace controller\mmshightech;
use Controller\mmshightech;
class usersPdo{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getUsersInfoAll(){
        $sql="select*from users;";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }

}