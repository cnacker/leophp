<?php
namespace Mr;

class Request
{
	public $method = 'GET';
	# public $path = '/hello/world';
	public $uri = '/ni/hao?a=';
	
	public function __construct()
	{
		$this->init();
	}
	
	public function init($config = [])
	{
		$requestUri = $_SERVER['REQUEST_URI'];
		$requestPath = parse_url($requestUri, PHP_URL_PATH);
		
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $requestPath;
	}
	
	public function getMethod()
	{
	}
	
	public function getPath()
	{
		return '/index';
	}
	
	public static function get($name = null, $value = null)
	{
		if (isset($_GET[$name])) {
			$value = $_GET[$name] ? : $value;
		}
		return $value;
	}
	
	public function __destruct()
	{
	}
}
	