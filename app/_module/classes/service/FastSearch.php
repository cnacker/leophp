<?php

/**
 * 快搜 - 快捷键搜索
 */

namespace app\_module\classes\service;

class FastSearch
{
	public static $funcArgs = [
		'init' => ['object', 'request' => []],
	];

	/**
	 * 构建函数
	 */
	public function __construct()
	{
		/**
		 * 导入请求标识符
		 * 修剪
		 * 分割，赋值快捷键、搜索条件
		 * 分隔，搜索选项
		 * 恢复搜索关键词
		 * 
		 * ---
		 *
		 * 搜索模型
		 * 取来转向模板，替换移去关键词
		 * 协议地址
		 *
		 * ---
		 *
		 * 赋值搜索选项，未定默认选项
		 * 编码关键词 URL，替换
		 * 渲染视图，必须变量
         */

	}

	/**
	 * 初始化
	 * @param $request array 请求数组
	 * @return 
	 */
	public function init()
	{
		$params = self::args(func_get_args(), __FUNCTION__);
		extract($params);
		print_r(get_defined_vars());
	}

	/**
	 * 获取参数值
	 */
	public static function args()
	{
		/**
		 * 函数论点列表
		 * 参数名称、类型、默认值
		 * 表现层、转换层，合并并对应参数名称和值
		 */
		$arg = func_get_args();
        $args = $arg[0];
        $arr = self::$funcArgs[$arg[1]];
        # $types = self::$argTypes[$arg[1]];
        $types = array_shift($arr);
        $types = preg_split('/[,\s]+/', $types);
        $keys = array_keys($arr);
        $max = count($keys);
        $len = count($args);
        if ($len > $max) {
            $len = $max;
        }
        $params = $value = null;
        if ($args) {
            $value = $args[0];
            if (is_string($value) && !in_array('json', $types)) {
                $value = json_decode($value);
                # print_r([__LINE__, __FILE__, $value]);exit;
            } elseif (is_array($value) && in_array('array', $types)) {
                $value = null;

            } elseif (is_object($value) && in_array('object', $types)) {
                $value = null;
            }

            if (is_object($value)) {
                $value = (array) $value;
            }

            if (is_array($value)) {
                $params = [];
                foreach ($value as $key => $val) {
                    if (is_numeric($key)) {
                        $key = $keys[$key];
                    }
                    $params[$key] = $val;
                }
            }
        }
        if (null === $params) {
            $params = [];
            for ($i = 0; $i < $len; $i++) {
                $k = $keys[$i];
                $params[$k] = $args[$i];
            }
        }
        return $params = array_merge($arr, $params);
    }
}