<?php
namespace Mr;

class Kernel extends Core
{
    public static $moduleDefault = '_module';
    public static $controllerDefault = '_class';
    public static $actionDefault = '_func';

    public function __construct()
    {
    }

    public function on($config = [])
    {
        $GLOBALS['Mr'] = $Mr = $this->getInstance('\Mr\Kernel');
        $Request = $Mr->request();
        # echo $Request->getPath();

        $route = $Mr->router();
        foreach ($GLOBALS['_CONFIG']['routes'] as $rt) {
            list($handle, $uri, $method) = $rt;
            $route->add($handle, $uri, $method);
        }
        $route->parse();
        $route = $route->on($Request);
        # print_r($route);exit;

        $module = $m = self::$moduleDefault;
        $controller = $c = self::$controllerDefault;
        $action = $a = self::$actionDefault;
        foreach ($route->result as $key => $value) {
            foreach ($value as $k => $v) {
                # print_r($v);
                if ($v) {
                    $module = $v[0];
                    $controller = $v[1];
                    $action = $v[2];
                }
            }
        }

        /*
        if ($Request->uri == '/v1/git/hooks') {
            $module = 'v1';
            $controller = 'git';
            $action = 'hooks';
        }
        */

        $explode = explode('\\', $controller);
        $count = count($explode) - 1;
        $last = $explode[$count];
        $explode[$count] = 'get_' . $last;
        $method_controller = implode('\\', $explode);
        $method_action = $action . '_' . strtolower($Request->method);

        $class = "\app\\$m\action\\$c";

        $exsits = [
            "\app\\$module\action\\$method_controller",
            "\app\\$module\action\\$controller",
            "\app\\$module\action\\$c",
        ];
        foreach ($exsits as $key => $value) {
            if (class_exists($value)) {
                $class = $value;
                break;
            }
        }

        # print_r(get_defined_vars());exit;
        # $class = "\app\\$module\action\\一整个宇宙的繁星";
        $object = new $class();

        $act = '_notfound';
        $exsits = [$method_action, $action, '_action'];
        foreach ($exsits as $key => $value) {
            if (method_exists($object, $value)) {
                $act = $value;
                break;
            }
        }

        $object->$act();
        /*$Router->on();
        */
    }

    public static function off()
    {
        $var = get_included_files();
        print_r($var); //$GLOBALS
    }

    public function start($config = [])
    {
        # $GLOBALS['Mr'] = $this->getInst();
        $GLOBALS['Mr'] = $this;
        # $Kernel = $this->getInst('\Mr\Kernel');
        $Request = $this->getInst('\Mr\Request');
        echo $Request->getPath();
        /*
        $Router = self::getInstances('Router');
        $Router->add($Request, 'app\_default\action\_default');
        $Router->on();
        */
    }

    public function shutdown()
    {
        print_r($GLOBALS);
    }

    public function __destruct()
    {
    }
}