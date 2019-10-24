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

        // 路由解析
        $route = $Mr->router();
        foreach ($GLOBALS['_CONFIG']['routes'] as $rt) {
            list($handle, $uri, $method) = $rt;
            $route->add($handle, $uri, $method);
        }
        $route->parse();
        $route = $route->on($Request);

        // 模块分析
        $module = $m = self::$moduleDefault;
        $controller = $c = self::$controllerDefault;
        $action = $a = self::$actionDefault;
        foreach ($route->result as $key => $value) {
            foreach ($value as $k => $v) {
                if ($v) {
                    $module = $v[0];
                    $controller = $v[1];
                    $action = $v[2];
                }
            }
        }

        $explode = explode('\\', $controller);
        $count = count($explode) - 1;
        $last = $explode[$count];
        $explode[$count] = 'get_' . $last;
        $method_controller = implode('\\', $explode);
        $method_action = $action . '_' . strtolower($Request->method);

        // 类检测
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

        # $class = "\app\\$module\action\\一整个宇宙的繁星";
        $object = new $class();

        // 执行动作
        $act = '_notfound';
        $exsits = [$method_action, $action, '_action'];
        foreach ($exsits as $key => $value) {
            if (method_exists($object, $value)) {
                $act = $value;
                break;
            }
        }

        $object->$act();
    }

    public static function off()
    {
        $var = get_included_files();
        print_r($var); //$GLOBALS
    }

    public function __destruct()
    {
    }
}