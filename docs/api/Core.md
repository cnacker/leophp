# Class Mr\Core

源码 https://gitee.com/netjoin/mr-fact/blob/master/src/MrFact/Core.php



## 公共属性

| #    | 属性      | 默认值 | 类型  | 描述     |
| ---- | --------- | ------ | ----- | -------- |
| 1    | $instance | []     | array | 静态实例 |
| 2    | $inst     | []     | array | 实例     |
| 3    | $config   | []     | array | 配置     |



## 公共方法

| #    | 方法          | 返回值     | 描述               |      |
| ---- | ------------- | ---------- | ------------------ | ---- |
| 1    | __construct() |            |                    |      |
| 2    | __destruct()  |            |                    |      |
| 3    | getInst()     | 对象       | 静态获取单例的单例 |      |
| 4    | getInstance() | 数组的对象 | 实例的实例         |      |
| 5    | router()      | 实例化的对象     | 路由器                   |      |
| 6    | request()     | 实例化的对象   | 协议请求                   |      |
| 7    | template()    |        | 模板                   |      |

