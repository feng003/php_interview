PSR-0规范

1 命名空间必须与绝对路径一致
2 类名首字母必须大写
3 除了入口文件外，其他“.php”必须只有一个类

自动载入
单一入口

SPL(PHP标准库)
1 SplStack  SplQueue SplHeap SplFixedArray 数据结构类
2 ArrayIterator AppendIterator Countable ArrayObject
3 SPL提供的函数

$stack = new SplStack() 栈   先进后出   push pop
$queue = new SplQueue() 队列 先进先出   后进后出
$dui = new SplMinHeap() 堆
$arr = new SplFixedArray() 固定长度的数组

魔术方法
1 get/set
2 call/callStatic
3 toString
4 invoke

三种基本设计模式
1 工厂模式  工厂方法或者类生产对象  factory
2 单例模式  使某个类的对象仅容许创建一个
3 注册模式  全局共享和交换对象
