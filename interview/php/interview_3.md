# PHP面试题汇总

> 1、双引号和单引号的区别


            双引号解释变量，单引号不解释变量
            双引号里插入单引号，其中单引号里如果有变量的话，变量解释
            双引号的变量名后面必须要有一个非数字、字母、下划线的特殊字符，或者用{}讲变量括起来，否则会将变量名后面的部分当做一个整体，引起语法错误
            双引号解释转义字符，单引号不解释转义字符，但是解释'\和\\
            能使单引号字符尽量使用单引号，单引号的效率比双引号要高（因为双引号要先遍历一遍，判断里面有没有变量，然后再进行操作，而单引号则不需要判断）

> 2、常用的超全局变量(8个)


            $_GET ----->get传送方式
            $POST ----->post传送方式
            $REQUEST ----->可以接收到get和post两种方式的值
            $GLOBALS ----->所有的变量都放在里面
            $FILE ----->上传文件使用
            $SERVER ----->系统环境变量
            $SESSION ----->会话控制的时候会用到
            $COOKIE ----->会话控制的时候会用到

> 3、HTTP中POST、GET、PUT、DELETE方式的区别


HTTP定义了与服务器交互的不同的方法，最基本的是POST、GET、PUT、DELETE，与其比不可少的URL的全称是资源描述符，我们可以这样理解：url描述了一个网络上资源，而post、get、put、delegate就是对这个资源进行增、删、改、查的操作！

3.1表单中get和post提交方式的区别

get是把参数数据队列加到提交表单的action属性所指的url中，值和表单内各个字段一一对应，从url中可以看到；post是通过HTTPPOST机制，将表单内各个字段与其内容防止在HTML的head中一起传送到action属性所指的url地址，用户看不到这个过程
对于get方式，服务器端用Request.QueryString获取变量的值，对于post方式，服务器端用Request.Form获取提交的数据
get传送的数据量较小，post传送的数据量较大，一般被默认不受限制，但在理论上，IIS4中最大量为80kb，IIS5中为1000k，get安全性非常低，post安全性较高

3.2 GET请求会向数据库发索取数据的请求，从而来获取信息，该请求就像数据库的select操作一样，只是用来查询一下数据，不会修改、增加数据，不会影响资源的内容，即该请求不会产生副作用。无论进行多少次操作，结果都是一样的。

与GET不同的是，PUT请求是向服务器端发送数据的，从而改变信息，该请求就像数据库的update操作一样，用来修改数据的内容，但是不会增加数据的种类等，也就是说无论进行多少次PUT操作，其结果并没有不同。

POST请求同PUT请求类似，都是向服务器端发送数据的，但是该请求会改变数据的种类等资源，就像数据库的insert操作一样，会创建新的内容。几乎目前所有的提交操作都是用POST请求的。

DELETE请求顾名思义，就是用来删除某一个资源的，该请求就像数据库的delete操作。

> 4、PHP介绍


PHP优势:

开放源代码
免费性
快捷性
跨平台强
效率高
图形处理
面向对象
专业专注

PHP技术应用:

静态页面生成
数据库缓存
过程缓存
div+css w3c标准
大负荷
分布式
flex
支持MVC
Smarty模块引擎

> 6、echo、print_r、print、var_dump之间的区别

* echo、print是php语句，var_dump和print_r是函数
* echo 输出一个或多个字符串，中间以逗号隔开，没有返回值是语言结构而不是真正的函数，因此不能作为表达式的一部分使用
* print也是php的一个关键字，有返回值 只能打印出简单类型变量的值(如int，string)，如果字符串显示成功则返回true，否则返回false
* print_r 可以打印出复杂类型变量的值(如数组、对象）以列表的形式显示，并以array、object开头，但print_r输出布尔值和NULL的结果没有意义，因为都是打印"\n"，因此var_dump()函数更适合调试
* var_dump() 判断一个变量的类型和长度，并输出变量的数值


> 9、如何获取客户端的ip(要求取得一个int)和服务器ip的代码

客户端：$_SERVER["REMOTE_ADDR"];或者getenv('REMOTE_ADDR')
ip2long进行转换
服务器端：gethostbyname('www.baidu.com')

> 11、优化数据库的方法

MySQL数据库优化的八大方式（经典必看）点击获取

选取最适用的字段属性，尽可能减少定义字段宽度，尽量把字段设置NOTNULL，例如'省份'、'性别'最好适用ENUM
使用连接(JOIN)来代替子查询
适用联合(UNION)来代替手动创建的临时表
事务处理
锁定表、优化事务处理
适用外键，优化锁定表
建立索引
优化查询语句

> 13、对于大流量网站，采用什么方法来解决访问量的问题

确认服务器硬件是否能够支持当前的流量
数据库读写分离，优化数据表
程序功能规则，禁止外部的盗链
控制大文件的下载
使用不同主机分流主要流量

> 16、 说明php中传值与传引用的区别，并说明传值什么时候传引用？

变量默认总是传值赋值，那也就是说，当将一个表达式的值赋予一个变量时，整个表达式的值被赋值到目标变量，这意味着：当一个变量的赋予另外一个变量时，改变其中一个变量的值，将不会影响到另外一个变量

php也提供了另外一种方式给变量赋值：引用赋值。这意味着新的变量简单的__引用__(换言之，成为了其别名或者指向)了原始变量。改动的新的变量将影响到原始变量，反之亦然。使用引用赋值，简单地将一个&符号加到将要赋值的变量前(源变量)

对象默认是传引用 
对于较大是的数据，传引用比较好，这样可以节省内存的开销