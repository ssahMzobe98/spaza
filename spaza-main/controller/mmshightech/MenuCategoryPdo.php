<?php
class MenuCategoryPdo
{
    public function __construct()
    {
        include_once("../mmshightech.php");
        $mmshightech = new mmshightech();
        $this->connection = $mmshightech->connection;
    }
    public function verifymenuId(int $menuId = 0){
        $sql="select id from menu_category_ids where id =?";
        return $this->mmshightech->numRows($sql,'s',[$menuId])==1;
    }
}

?>