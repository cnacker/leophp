<?php
namespace app\_module\action;

use Mr\Abstracts\Action as _abstract;
use app\_module\classes\model\com_urlnk\alimama_auction_code;

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
}
