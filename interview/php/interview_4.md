> 1、<?php echo count(strlen(“http://php.net”)); ?>的执行结果是？

答案：1 

讲解：count(var)是用来统计数组或对象的元素个数的。当var是null或者空数组时，结果为0。如果var是普通变量，则返回1。正常情况下返回var中的元素或属性个数。 

> 2、使用list()函数需要注意什么？

答案：list()是一个语法结构。List($array)是用来快速把数组中的元素赋给一些变量。使用时要注意，$array必须为一个索引数组，并且索引值从0开始。 

> 3、请说明php.ini中的safe_mode开启之后影响了哪些函数？

答案：Safe_mode是php的安全模式。开启之后，主要会对系统操作、文件、权限设置等方法产生影响，主要用来应对webshell。以下是受到影响的一些函数：ckdir，move_uploaded_file,chgrp,parse_ini_file,chown,rmdir,copy,rename,fopen,require,highlight_file,show_source,include,symlink,link,touch,mkdir,unlink，exec,shell_exec,pasathru,system,popen

需要注意的是:在php5.3以上版本，safe_mode被弃用，在php5.4以上版本，则将此特性完全去除了。

4、请对POSIX风格和兼容Prel风格两种正则表达式的主要函数进行类比说明。

答案：POSIX 风格 : 匹配正则表达式ereg  和替换 ereg_replace
　　Prel风格：匹配正则表达式 preg_match  和替换 preg_replace
　　Preg_match 比ereg的执行效率更快，preg_replace 比ereg_replace的执行效率更快。

> 5、如何在命令下运行php脚本（写出两种方式），如何向php脚本传递参数？ 

答案：第一种方式：先进入php安装目录，执行 php 路径/文件名.php。

例：php my_script.php     php -f  "my_script.php" 

第二种方式：php -r “php脚本”;(不需要加php的开始符和结束符)。 

例：php -r "print_r(get_defined_constants());" 

向php脚本传递参数： 

第一种方式：php -r "var_dump($argv);" -- -h  (注意：如果要传递的参数开头为-，那么得使用参数列表分隔符 -- 才能正确传参。)

第二种方式：test.php文件代码：#!/usr/bin/php  <?phpvar_dump($argv);?>
 
    ./test.php -h -- foo(在php文件开头加入#!/usr/bin/php，即可直接传递以-为开头得参数)

> 6、php5中魔术方法有哪几个？请举例说明各自的用法。

答案：

1、__construct() ：实例化对象时自动调用。
2、__destruct() ：销毁对象或脚本执行结束时自动调用。
3、__call() ：调用对象不存在得方法时执行此函数。
4、__get() ：获取对象不存在的属性时执行此函数。
5、__set() ：设置对象不存在的属性时执行此函数。
6、__isset() : 检测对象的某个属性是否存在时执行此函数。
7、__unset() ：销毁对象的某个属性时执行此函数。
8、__toString() ：将对象当作字符串输出时执行此函数。
9、__clone() ：克隆对象时执行此函数。
10、__autoload() ：实例化对象时，当类不存在时，执行此函数自动加载类。
11、__sleep() ：serialize之前被调用，可以指定要序列化的对象属性。
12、__wakeup ：unserialize之前被调用，可以执行对象的初始化工作。
13、__set_state() ：调用var_export时，被调用。用__set_state的返回值做为var_export的返回值。
14、__invoke() ：将对象当作函数来使用时执行此方法，通常不推荐这样做。

> 7、简述php的垃圾收集机制。

答案：php中的变量存储在变量容器zval中，zval中除了存储变量类型和值外，还有is_ref和refcount字段。refcount表示指向变量的元素个数，is_ref表示变量是否有别名。如果refcount为0时，就回收该变量容器。如果一个zval的refcount减1之后大于0，它就会进入垃圾缓冲区。当缓冲区达到最大值后，回收算法会循环遍历zval，判断其是否为垃圾，并进行释放处理。

关于此问题（http://blog.csdn.net/niluchen/article/details/9468365）有各为详细的讲解！

> 8、用php实现一个双向队列。

队列是一种线性表，按照先进先出的原则进行
单向队列：只能从头进，从尾出
双向队列：头尾都可以进出

    class DuiLie {

        private $array = array();//声明空数组

        public function setFirst($item){
            return array_unshift($this->array,$item);//头入列
        }

        public function delFirst(){
            return array_shift($this->array);//头出列
        }

        public function setLast($item){
            return array_push($this->array,$item);//尾入列
        }

        public function delLast(){
            return array_pop($this->array,$item);//尾出列
        }

        public function show(){
            var_dump($this->array);//打印数组
        }

        public function Del(){
            unset($this->array);//清空数组
        }
    }

[参考地址](http://www.cnblogs.com/pentacles/p/6441525.html)