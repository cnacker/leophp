<?php
namespace Mr;

class Core
{
	public static $instance = [];
	public $inst = [];
	
	public function __construct()
	{
	}
	
	public static function getInstance($name = 'Core', $class = null)
	{
		if (isset(self::$instance[$name]) && null != self::$instance[$name]) {
			return self::$instance[$name];
		}
		$class = $class ? : $name;
		return self::$instance[$name] = new $class();
	}
	
	public function getInst($name = 'Core', $class = null)
	{
		if (isset($this->inst[$name]) && null != $this->inst[$name]) {
			return $this->inst[$name];
		}
		$class = $class ? : $name;
		return $this->inst[$name] = new $class();
	}
	
	public function router()
	{
		return self::getInstance('\Mr\Router');
	}
	
	public function request()
	{
		return self::getInstance('\Mr\Request');
	}
	
	public function template()
	{
		return self::getInstance('\Mr\Template');
	}
	
	public function __destruct()
	{
	}
}
