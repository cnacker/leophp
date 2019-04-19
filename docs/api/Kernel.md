# Class Mr\Kernel

源码 https://gitee.com/netjoin/mr-fact/blob/master/src/MrFact/Kernel.php



## 公共属性

| # | 属性 | 类型 | 默认值 | 描述 |
| -- | --- | -- | --- | --- |
| 1 | $moduleDefault | string | _module | 默认模块名 |
| 2 | $controllerDefault | string | _class | 默认控制器名 |
| 3 | $actionDefault | string | _func | 默认动作名 |



## 公共方法

| #    | 方法          | 返回值 | 描述 |
| ---- | ------------- | ------ | ---- |
| 1    | __construct() |        |      |
| 2 | on()  | void | 启动过程 |
| 3 | off() | | 停止，统计 |
| 4 | start() | echo | 开始，配置 |
| 5 | shutdown() | | 全局，变量 |
| 6 | __destruct() | | |



## 全局常量

| #    | 常量     | 类型   | 描述             |
| ---- | -------- | ------ | ---------------- |
| 1    | APP_PATH | string | 应用地址目录路径 |
| 2    | MR_PATH  | string | 框架根目录       |



## 全局自定义变量

| #    | 变量    | 类型  | 描述               |
| ---- | ------- | ----- | ------------------ |
| 1    | $_DEBUG | array | 调试除错，过程数组 |



## 全局对象

| #    | 对象     | 类型 | 描述           |
| ---- | -------- | ---- | -------------- |
| 1    | Mr       |      | 触发器类       |
| 2    | Composer |      | 提供商自动加载 |

