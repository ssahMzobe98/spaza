<?php

namespace controller\mmshightech;

use controller\mmshightech;

class spazaPdo
{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }

    public function getSpazaInformation(?int $spazaId):array
    {
        $sql = "select * from spaza_details where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spazaId])[0]??[];
    }

}