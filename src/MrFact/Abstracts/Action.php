<?php
namespace Mr\Abstracts;

abstract class Action
{
    protected $var2 = "MyAbstract_var";

    use \Mr\Traits\Action;

    function b()
    {
        echo "b".PHP_EOL;
    }
}
