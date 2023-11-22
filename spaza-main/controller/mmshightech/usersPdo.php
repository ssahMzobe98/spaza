<?php
namespace controller\mmshightech;
use controller\mmshightech;
class usersPdo{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }

}