<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6782591a8daa1528848618dbd69ec81a
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'controller\\' => 11,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'controller\\mmshightech\\csvProcessor' => __DIR__ . '/../..' . '/controller/mmshightech/csvProcessor.php',
        'controller\\mmshightech\\processorNewPdo' => __DIR__ . '/../..' . '/controller/mmshightech/processorNewPdo.php',
        'controller\\mmshightech\\productsPdo' => __DIR__ . '/../..' . '/controller/mmshightech/productsPdo.php',
        'controller\\mmshightech\\spazaPdo' => __DIR__ . '/../..' . '/controller/mmshightech/spazaPdo.php',
        'controller\\mmshightech\\usersPdo' => __DIR__ . '/../..' . '/controller/mmshightech/usersPdo.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6782591a8daa1528848618dbd69ec81a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6782591a8daa1528848618dbd69ec81a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6782591a8daa1528848618dbd69ec81a::$classMap;

        }, null, ClassLoader::class);
    }
}
