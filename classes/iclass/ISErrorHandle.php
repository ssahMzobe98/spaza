<?php

namespace Classes\iclass;
interface ISErrorHandle
{
    public static function writelogResponse(string $dir='./',string $logType='Error',string $class='ErrorLog',string $method='No method provided',?object $data=null):void;
    public static function exceptionBuiler($e):object;
}