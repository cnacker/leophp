# ♌ Leophp 2018.7.25

包 wuding/leophp

源码库 https://gitee.com/netjoin/mr-fact

镜像 https://github.com/cnacker/leophp

相比较上一时期，路由和模板引擎都是框架集成的

充分使用 Traits 等特性

增加服务类，用于精简控制器



#### 项目介绍
Mr.Fact PHP Framework

与众不同的 PHP 框架，包含 Gitee、GitHub Webhooks 的应用实例

#### 软件架构

app/[模块名]/action/[控制器名].php

控制器类检测顺序：
```
app/[模块]/action/[HTTP方法]_[控制器]
app/[模块]/action/[控制器]
app/[模块]/action/_class
app/_module/action/_class
```

动作方法检测顺序：
```
[动作]_[HTTP方法]()
[动作]()
_action()
_notfound()
```

#### 安装教程
php >= 5.4.0

1. xxxx
2. xxxx
3. xxxx

#### 使用说明

1. xxxx
2. xxxx
3. xxxx

#### 参与贡献

1. Fork 本项目
2. 新建 Feat_xxx 分支
3. 提交代码
4. 新建 Pull Request


#### 码云特技

1. 使用 Readme\_XXX.md 来支持不同的语言，例如 Readme\_en.md, Readme\_zh.md
2. 码云官方博客 [blog.gitee.com](https://blog.gitee.com)
3. 你可以 [https://gitee.com/explore](https://gitee.com/explore) 这个地址来了解码云上的优秀开源项目
4. [GVP](https://gitee.com/gvp) 全称是码云最有价值开源项目，是码云综合评定出的优秀开源项目
5. 码云官方提供的使用手册 [http://git.mydoc.io/](http://git.mydoc.io/)
6. 码云封面人物是一档用来展示码云会员风采的栏目 [https://gitee.com/gitee-stars/](https://gitee.com/gitee-stars/)
