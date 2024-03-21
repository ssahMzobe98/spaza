<?php
namespace Classes\Trait;
use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\response\Response;
public class PDOConnectionTrait{
	private $mmshightech;
	private $Response;
	public function __construct(mmshightech|null $mmshightech=null){
		if(is_null($mmshightech)){
			$mmshightech = PDOFactoryOOPClass::make(Constants::MMSHIGHTECH,[]);
		}
		$this->mmshightech = $mmshightech;
		$this->Response = PDOFactoryOOPClass::make(Constants::RESPONSE,[]);
	}
}
?>