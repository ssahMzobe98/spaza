<?php

use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\response\Response;
class ClientPdo
{
    protected mixed $mmshightech;
    public function __construct()
    {
        include_once("../mmshightech.php");
        $this->mmshightech = new mmshightech();

    }
    public function verifyClientId(int $clientId = 0):Response{
        $sql="select id from users where id =?";
        return $this->mmshightech->numRows($sql,'s',[$clientId])==1;
    }
}

?>
