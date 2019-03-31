# Mr-Fact Leophp



## 核心类

[MrFact\console](console.md) 定义变量常量对象，前置调试错误报告，配置信息中间调试，类加载初始化类

[MrFact\timeline](timeline.md) 结束调试问题

[MrFact\functions](functions.md) 空函数文件

[Mr\Kernel](Kernel.md) 请求、路由（配置），控制器类名，执行动作

[Mr\Core](Core.md) 获取实例：路由器、HTTP 请求、模板

[Mr\Request](Request.md)  初始化方向路线，获取 GET 请求

[Mr\Template](Template.md) 请求方法地址，渲染缓冲布局，获取内容块

[Mr\Router](Router.md) 添加路由规则，解析规则配置，导入请求结果，路由设置匹配请求链接



## 抽象、接口、特性类

[Mr\Abstracts\Action]() 抽象动作类，使用特性

[Mr\Interfaces\Action]()  动作接口类

[Mr\Traits\Action]() 动作特质类，输出 JSON 格式



## 入口、配置文件

web/index.php 启动，声明函数

app/config.php 路由、GIT



## 模块

`_module/action/_class`

`_module/classes/model/url/search`

`_module/classes/service/WebHooks`

`_module/classes/view/Tree`

`_module/theme/_skin/_class/_func_get`