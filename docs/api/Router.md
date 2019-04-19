# Class Mr\Router

Source https://gitee.com/netjoin/mr-fact/blob/master/src/MrFact/Router.php



## Public Properties

| #    | Property           | Type | Default Value | Description    |
| ---- | ------------------ | ---- | ------------- | -------------- |
| 1    | $rule              |      |               | 附加路由规则   |
| 2    | $req               |      |               | 请求方法标识符 |
| 3    | $set               |      |               | 规则配置结果   |
| 4    | $result            |      |               | 规则处理结果   |
| 5    | $moduleDefault     |      |               | 初始默认模块   |
| 6    | $controllerDefault |      |               | 初始默认控制器 |
| 7    | $actionDefault     |      |               | 初始默认动作   |
| 8    |                    |      |               |                |



## Public Methods

| #    | Method        | Returns Value | Description                  |
| ---- | ------------- | ------------- | ---------------------------- |
| 1    | __construct() |               |                              |
| 2    | __destruct()  |               |                              |
| 3    | init()        |               |                              |
| 4    | getMethod()   |               |                              |
| 5    | add()         |               | 添加动作规则方法             |
| 6    | parse()       |               | 分析五种路由规则             |
| 7    | on()          |               | 导入请求参数，对应请求方法   |
| 8    | uri()         |               | 多重循环，通用资源标识符     |
| 9    | pathinfo()    |               | 多重循环，动作地址           |
| 10   | path()        |               | 匹配规则，检测设置           |
| 11   | super()       |               | 超级变量：一个查询参数       |
| 12   | query()       |               | 多重循环，分配动作控制器模块 |
| 13   | queryCheck()  |               | 查询检测，                   |
| 14   | info()        |               | 返回替换魔方控制器组件       |

