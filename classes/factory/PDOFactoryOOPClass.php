<?php
namespace Classes\factory;

use Classes\constants\Constants;
use Classes\payment_integration\WalletPdo;
use Classes\payment_integration\InvoicePdo;
use Classes\iclass\IPDOFactoryOOPClass;
use Controller\mmshightech\OrderPdo;
use Controller\mmshightech\spazaPdo;
use Controller\mmshightech\usersPdo;
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
use Classes\response\Response;


class PDOFactoryOOPClass implements IPDOFactoryOOPClass
{
    protected static array $data = [
        Constants::INVOICE => InvoicePdo::class,
        Constants::WALLET => WalletPdo::class,
        Constants::ORDER =>OrderPdo::class,
        Constants::SPAZA =>spazaPdo::class,
        Constants::USER=>usersPdo::class,
        Constants::MMSHIGHTECH=>mmshightech::class,
        Constants::PRODUCT=>productsPdo::class,
        Constants::RESPONSE=>Response::class
    ];

    public static function make(?string $classPdo = null, array $array = [])
    {
        $class = self::$data[Constants::USER];
        if (!empty($classPdo) && isset(self::$data[$classPdo])) {
            $class = self::$data[$classPdo];
        }
        return new $class(...$array);
    }
}
?>