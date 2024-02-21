<?php
namespace Classes\factory;

use Classes\constants\Constants;
use Classes\payment_integration\WalletPdo;
use Classes\payment_integration\InvoicePdo;
use Classes\iclass\IPDOFactoryOOPClass;
use Controller\mmshightech\OrderPdo;
use Controller\mmshightech\spazaPdo;
use Controller\mmshightech\usersPdo;

class PDOFactoryOOPClass implements IPDOFactoryOOPClass
{
    protected static array $data = [
        Constants::INVOICE => InvoicePdo::class,
        Constants::WALLET => WalletPdo::class,
        Constants::ORDER =>OrderPdo::class,
        Constants::SPAZA =>spazaPdo::class,
        Constants::USER=>usersPdo::class
    ];

    public static function make(?string $classDao = null, array $array = [])
    {
        $class = self::$data[Constants::INVOICE];
        if (!empty($classDao) && isset(self::$data[$classDao])) {
            $class = self::$data[$classDao];
        }
        return new $class(...$array);
    }
}
?>