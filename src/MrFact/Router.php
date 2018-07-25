<?php
namespace Mr;

class Router
{
	public $rule = [];
	public $req = [];
	public $set = [];
	public $result = [];
	
	public $moduleDefault = '_module';
	public $controllerDefault = '_class';
	public $actionDefault = '_func';
	
	public function __construct()
	{
		self::init();
	}
	
	public static function init($config = [])
	{
		
	}
	
	public function getMethod()
	{
	}
	
	public function add($action = null, $rule = null, $method = null)
	{
		if (!isset($this->rule[$action])) {
			$this->rule[$action] = [];
		}
		
		$no = count($this->rule[$action]);
		$this->rule[$action][$no] = [
			'rule' => $rule,
			'method' => $method
		];
		$no++;
		
		return $this;
	}
	
	public function parse()
	{
		$arr = $this->set;
		foreach ($this->rule as $key => $value) {
			foreach ($value as $val) {
				$method = $val['method'];
				$rule = $val['rule'];
				if (!isset($arr[$method])) {
					$arr[$method] = [						
						'path' => [],
						'super' => [],
						'query' => [],
						'uri' => [],
						'unkown' => [],
					];
				}
				
				$type = 'unkown';
				$config = $rule;
				if (is_string($rule)) {
					$url = "route://parse$rule";
					$url = parse_url($url);
					$hasPath = isset($url['path']);
					$hasQuery = isset($url['query']);
					if ($hasPath && $hasQuery) {
						$type = 'uri';
						$config = $url;
					} elseif ($hasPath) {
						$type = 'path';
						$config = $url['path'];
					} elseif ($hasQuery) {
						$type = 'query';
						$config = $url['query'];
					}
					
				} elseif (is_array($rule)) {
					$count = count($rule);
					if ($count) {
						
						if (isset($rule[0]) && is_array($rule[0])) {
							$type = 'super';
							$config = $rule[0];
							
						} else {
							$type = 'query';
							$config = ['_module', '_controller', '_action'];
							$i = 0;
							foreach ($rule as $k => $v) {
									$config[$i] = [$k => $v];
								$i++;
							}
							# return $config;
						}
					}
				}
				
				if (!isset($arr[$method][$type])) {
					$arr[$method][$type] = [];
				}
				
				if (!isset($arr[$method][$type][$key])) {
					$arr[$method][$type][$key] = [];
				}
				
				$arr[$method][$type][$key][] = $config;
			}
		}
		$this->set = $arr;
		return $this;
	}
	
	public function on($request = null)
	{
		foreach ($request as $key => $value) {
			$this->req[$key] = $value;
		}
		$method = isset($this->req['method']) ? $this->req['method'] : '';
		$uri = isset($this->req['uri']) ? $this->req['uri'] : '/';
		$result = [];
		if ($this->set) {
			if ($method && isset($this->set[$method])) {
				$list = $this->set[$method];
				if ($list['super']) {
					$result[] = $this->super($list['super']);
				}
				if ($list['query']) {
					$result[] = $this->query($list['query']);
				}
				if ($list['path']) {
					$result[] = $this->pathinfo($list['path'], null, $uri, $method);
				}
				if ($list['uri']) {
					$result[] = $this->uri($list['uri'], null, $uri, $method);
				}
			} else {
			}
		}
		$this->result = $result;
		return $this;
	}
	
	public function uri($rule, $action = '', $uri = '', $method = '', $arr = null)
	{
		
		$set = [];
		if (!$arr) {
			# print_r($rule);
			foreach ($rule as $key => $value) {
				$set[] = $this->uri($value, $key, $uri, $method, 1);
			}
			return $set;
		}
		# print_r($rule);
		
		$set = $this->path($rule['path'], $action, $uri, $method, null, '$');
		return $set;
	}
	
	public function pathinfo($rule, $action = '', $uri = '', $method = '', $arr = null)
	{
		
		$set = [];
		if (!$arr) {
			# print_r($rule);
			foreach ($rule as $key => $value) {
				foreach ($value as $k => $v) {
					$set[] = $this->pathinfo($v, $key, $uri, $method, 1);
				}
			}
			return $set;
		}
		# print_r($rule);
		
		if (!$action) {
			$url = "route://parse$uri";
			$url = parse_url($url);
			$action = isset($url['path']) ? $url['path'] : null;
			$action = str_replace('/mr-fact/web/index.php', '', $action);
			$path = pathinfo($action);
			$c = isset($path['dirname']) ? $path['dirname'] : $this->controllerDefault;
			$a = isset($path['filename']) ? $path['filename'] : $this->actionDefault;
			$action = $c . '@' . $a;
			print_r($path);# 
		}
		
		$set = $this->path($rule, $action, $uri, $method);
		return $set;
	}
	
	public function path($rule, $action = '', $uri = '', $method = '', $arr = null, $end = null)
	{
		
		$set = [];
		if (!$arr && is_array($rule)) {
			foreach ($rule as $r) {
				$set[] = $this->path($r, $action, $uri, $method, 1, $end);
			}
			return $set;
		}
		
		$path = str_replace('\/', '<%slash%>', $rule);
		$rule = explode('/', $path);
		$val = [];
		$no = 0;
		# print_r($rule);
		$pattern = '[^:]+:[^}]*';
		$pattern = '[^}]*';
		foreach ($rule as $key => $value) {			
			if (preg_match("/{($pattern)}/", $value, $matches)) {
						
				$kv = explode(':', $matches[1], 2);
				$count = count($kv);
				# print_r([$count, $matches]); 
				$v = '';
				if (1 < $count) {				
					$v = $kv[1];
				}
				if (!$v) {
					$v = '[^\/]+';
				}
				
				
				# $path = str_replace('{' . $matches[1] . '}', "($v)", $path);
				$rule[$no] = "($v)";
				$val[] = $kv[0];
			}
			$no++;
		}
		$pattern = implode('\/', $rule);
		$pattern = "/$pattern$end/i";
		if (preg_match($pattern, $uri, $matches)) {
			# print_r($matches);
			array_shift($matches);
			foreach ($matches as $key => $value) {
				$name = $val[$key];
				$param[$name] = $value;
				if (preg_match($pattern, $uri, $matches)) {
				}
			}
			# print_r($param);
			$m = isset($param['_module']) ? $param['_module'] : null;
			$c = isset($param['_controller']) ? $param['_controller'] : null;
			$a = isset($param['_action']) ? $param['_action'] : null;
			foreach ($param as $k => $v) {
				
				$action = str_replace('{' . $k . '}', $v, $action);
				# print_r([$act, $action]);
			}
			$set = $this->info($action, $m, $c, $a);
		}
		/**/
		# print_r([$action, $param, $pattern, $path, $val]);# 
		
		return $set;
	}
	
	public function super($rule, $arr = null)
	{
		
		$set = [];
		if (!$arr) {
			foreach ($rule as $r) {
				$set[] = $this->super($rule, 1);
			}
			return $set;
		}
		
		foreach ($rule as $key => $value) {
			foreach ($value as $k => $v) {
				if (isset($_GET[$k]) && $v == $_GET[$k]) {
					$set = $this->info($key);
				}
			}
		}
		return $set;
	}
	
	public function query($rule, $arr = null)
	{
		
		$set = [];
		if (!$arr) {
			foreach ($rule as $r) {
				$set[] = $this->query($rule, 1);
			}
			return $set;
		}
		# print_r($rule);
		
		foreach ($rule as $key => $value) {
			$module = $this->moduleDefault;
			$controller = $this->controllerDefault;
			$action = $this->actionDefault;
			$count = count($value);
			if ($count) {
				$action = $value[0] ? $value[0] : $action;
				if (1 < $count) {
					$controller = $value[1] ? $value[1] : $controller;
					if (2 < $count) {
						$module = $value[2] ? $value[2] : $module;
					}
				}
			}
			$set = $this->info(
				$key, 
				$this->queryCheck($module, $this->moduleDefault), 
				$this->queryCheck($controller, $this->controllerDefault), 
				$this->queryCheck($action, $this->actionDefault)
			);
		}
		return $set;
	}
	
	public function queryCheck($arr = [], $set = '_default')
	{
		
		if ($arr) {
			foreach ($arr as $key => $value) {
			}
			if (isset($_GET[$key])) {
				$v = $_GET[$key];
				if ($value) {
					
					if (!preg_match("/$value/", $v)) {
						$v = null;
					}
					/**/
				}
				
				$set = $v ? : $set;
				# print_r([$key, $value, $v, $set]);
			}
		}
		return $set;
	}
	
	public function info($name, $m = null, $c = null, $a = null)
	{
		# print_r([$name, $m, $c, $a]);
		
		$name = str_replace('\\', '/', $name);
		
		$module = $m ? : $this->moduleDefault;
		$controller = $c ? : $this->controllerDefault;
		$action = $a ? : $this->actionDefault;
		/**/
		
		
		$at = explode('@', $name);
		$count = count($at);
		if (1 < $count) {
			$name = $at[0];
			$action = $at[1];
		}
		
		$explode = explode('/', $name);
		# print_r([$explode, $m ,$c, $a]);
		$count = count($explode);
		if (preg_match('/^\//', $name)) {
			$module = $explode[1];
			$shift = array_shift($explode);
			$second = array_shift($explode);
		}
		$controller = implode('\\', $explode) ? : $controller;
		# print_r([$controller, $explode]);
		
		$module = str_replace('{_module}', $m, $module);;
		$controller = str_replace('{_controller}', $c, $controller);;
		$action = str_replace('{_action}', $a, $action);;
		# print_r([$name, $module, $controller, $action]);
		return [$module, $controller, $action];
	}
	
	public function __destruct()
	{
	}
}
	