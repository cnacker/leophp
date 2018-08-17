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
		$name = $Mr->request()::get('name', 'value');
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
		
		$php_input = file_get_contents('php://input');
		
		// 写入日志
		$path = 'log/';
		$put = file_put_contents($path . time() . '.txt', print_r($GLOBALS, true));
		$log = file_put_contents($path . date('nj') . '.log', $php_input . PHP_EOL, FILE_APPEND);
		
		# unset($secret, $php_input, $payload, $json);
		$this->_json(0, 'test', get_defined_vars());
	}
}
