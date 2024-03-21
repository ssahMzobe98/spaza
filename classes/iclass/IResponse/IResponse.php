<?php
namespace Classes\iclass\IResponse;
interface IResponse{
	public  function successSetter():Response;
	public  function failureSetter():Response;
	public  function setObjectReturn():Response;
	public  function messagerSetter(String $message=""):Response;
	public  function messagerArraySetter(array $arrayMesssage=[]):Response;
}