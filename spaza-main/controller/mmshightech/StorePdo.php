<?php
class StorePdo
{
    public function __construct()
    {
        include_once("../mmshightech.php");
        $mmshightech = new mmshightech();
        $this->connection = $mmshightech->connection;
    }
    public function verifyStoreId(int $storeId = 0){
        $sql="select id from Stores where id =?";
        return $this->mmshightech->numRows($sql,'s',[$storeId])==1;
    }
}

?>