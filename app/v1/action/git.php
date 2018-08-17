<?php
namespace app\v1\action;

use Mr\Abstracts\Action as _abstract;
use app\v1\classes\model\com_urlnk\alimama_auction_code;

class _class extends _abstract implements \Mr\Interfaces\Action
{
	protected $var3 = "MyClass_var";

    //也可以在这里引用，不区分继承关系
    //use MyTrait;
    function _func()
    {
		global $Mr;
		// $name = $Mr->request()::get('name', 'value');
		$request = $Mr->request();
		$name = $request::get('name', 'value');
		# $arr = Model::all();
		echo $html = $Mr->template()->render('_skin/_default._default', ['title' => $name]);# 
        # echo "c".PHP_EOL;
    }
	
	function _func_get()
    {
		# echo 'haha';
		echo $html = $GLOBALS['Mr']->template()->render('_skin/_class/_func_get', ['title' => 'hi']);# 
	}
	
	function hooks()
	{
		header('Content-Type: application/json; charset=utf-8');
		# print_r($GLOBALS);
		
		$hooks = [
			'git-oschina-hook' => 'Gitee',
			'GitHub-Hookshot' => 'GitHub',
		];
		$class = '';
		if (preg_match('/^([a-z\-]+)\/(.*)/i', $_SERVER['HTTP_USER_AGENT'], $matches)) {
			$key = $matches[1];
			$class = isset($hooks[$key]) ? $hooks[$key] : '';
		}
		
		
		$php_input = file_get_contents('php://input');
		
		// 写入日志
		$path = 'log/';
		$put = file_put_contents($path . time() . '.txt', print_r($GLOBALS, true));
		$log = file_put_contents($path . date('nj') . '.log', $php_input . PHP_EOL, FILE_APPEND);
		
		
		if (!$class) {
			$this->_json(1, 'test', $_SERVER);
			exit;
		}
		
		$class = '\app\_module\classes\service\\' . $class;
		$obj = new $class;
		$result = $obj->result;
		if (0 !== $obj->cmp) {
			http_response_code(404);
		}
		
		unset($php_input);
		$this->_json(0, 'test', get_defined_vars());
	}
}
