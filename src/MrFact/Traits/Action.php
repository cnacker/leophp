<?php
namespace Mr\Traits;

trait Action
{
    protected $var = "MyTrait_var";
    protected $var1 = "MyTrait_var";

    function __construct()
    {
        # echo $this->var.PHP_EOL;
    }

    function a()
    {
        echo "a".PHP_EOL;
    }
	
	function _notfound()
    {
        print_r([__METHOD__, __LINE__, __FILE__]);
    }
}
