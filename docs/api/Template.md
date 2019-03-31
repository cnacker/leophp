# Class Mr\Template

Source https://gitee.com/netjoin/mr-fact/blob/master/src/MrFact/Template.php



## Public Properties

| #    | Property | Type   | Default Value | Description  |
| ---- | -------- | ------ | ------------- | ------------ |
| 1    | $layout  | string |               | 模板布局名称 |
| 2    | $content | string |               | 模板缓冲内容 |
| 3    | $exec    | array  | []            | 渲染文件列表 |



## Public Methods

| #    | Method        | Returns Value | Description                          |
| ---- | ------------- | ------------- | ------------------------------------ |
| 1    | __construct() |               | 触发方法，初始化                     |
| 2    | __destruct()  |               |                                      |
| 3    | init()        |               | 初始化配置：请求方法和地址           |
| 4    | getMethod()   |               |                                      |
| 5    | render()      |               | 提取变量，返回包含内容，布局文件数据 |
| 6    | content()     |               |                                      |

