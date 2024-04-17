<?php

namespace Classes\logs;
use Classes\iclass\ISErrorHandle;

class ErrorHandler implements ISErrorHandle
{
    private static $connectionManager;
    private static $configs;
    private static $default_settings=[
        'type'=>'error'
    ];
    private static array $logFiles=[];
    public static function writelogResponse(string $dir='./',string $logType='Error',string $class='ErrorLog',string $method='No method provided',?object $data=null):void{
        self::logResponse2Disk($dir,$logType,$class,$method,$data);
    }
    private static function logResponse2Disk(string $dir='./', string $logType='Error', string $class='errorLog', string $method='No method provided', ?object $data=null):void{
        $class.='_'.date("Y-m");
        $logMessage = "[" . date('Y-m-d H:i:s') . "] [$logType] [$class::$method] ";
        $logMessage .= is_scalar($data) ? $data : json_encode($data,JSON_PRETTY_PRINT);
        $logMessage .= PHP_EOL;
        $logFilePath = rtrim($dir, '/') . '/' . str_replace('\\', '_', $class) . '_log.log';
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }
    public static function exceptionBuiler($e):object{
        $logType = self::$default_settings['type'];
        $file = $e->getFile();
        $method = __METHOD__;
        $class = __CLASS__;
        $line = $e->getLine();
        $code =$e->getCode();
        $data = $e->getMessage();
        $stackTrace = $e->getTrace();
        $previousException = $e->getPrevious();
        return (object)[
            'time'=>date('Y-m-d H:m:si'),
            'ErrorCode'=>$code,
            'issueType'=>$logType,
            'file'=>$file,
            'class'=>$class,
            'method'=>$method,
            'line'=>$line,
            'errorMessage'=>$data,
            'StakeTraceObject'=>(object)[
                'stackTrace'=>$stackTrace,
                'previous'=>(object)[
                    'previousStackTrace'=>$previousException
                ]
            ]
        ];
    }
}