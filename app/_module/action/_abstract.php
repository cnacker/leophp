<?php
namespace app\_default\action;

abstract class _abstract
{
    protected $var2 = "MyAbstract_var";

    use \Mr\Traits\Action;

    function b()
    {
        echo "b".PHP_EOL;
    }
}
