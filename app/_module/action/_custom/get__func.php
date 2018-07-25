<?php
namespace app\_module\action\_custom;

use Mr\Abstracts\Action as _abstract;

class get__func extends _abstract implements \Mr\Interfaces\Action
{
	protected $var3 = "MyClass_var";

    //也可以在这里引用，不区分继承关系
    //use MyTrait;
    function _go()
    {
		echo "c".PHP_EOL;
    }
	
	function _default()
    {
        print_r([__METHOD__, __LINE__, __FILE__]);
    }
	
	function _action()
    {
        print_r([__METHOD__, __LINE__, __FILE__]);
    }
}
