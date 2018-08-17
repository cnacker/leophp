<?php
/* 常量 */
define('APP_PATH', __DIR__  . '/../app');

/**
 * develop 	错误报告、调试信息
 * test		时间、内存
 * product 	日志
 *
 */
require APP_PATH . '/../src/MrFact/console.php';


/*
$Kernel = new Mr\Kernel();
$Kernel->start();
$Kernel->shutdown();
*/
# $test = Astro\Php::getInstance();
# Mr\Kernel::on();
# Mr\Kernel::off();


Mr::php();
# print_r($GLOBALS); 




