<?php
/**
 * Singleton 单例模式
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/11
 * Time: 8:55
 */
class Singleton
{

    /**
     * 静态 成员变量 保存全局实例
     * @var null
     */
    private static $_instance = null;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @staticvar Singleton $instance The *Singleton* instances of this class.
     * @return Singleton The *Singleton* instance.
     * 静态工厂方法，返还此类的唯一实例
     */
    public static function getInstance()
    {

        if(null === self::$_instance)
        {
            self::$_instance = new Singleton();
        }
        return self::$_instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     * 私有化 默认构造方法，保证外界无法直接实例化
     */
    private function __construct()
    {

    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {

    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {

    }
}
class SingletonChild extends Singleton
{

}
$obj = Singleton::getInstance();
//instanceof 确定一个对象是类的实例、类的子类，还是实现了某个特定接口
if($obj instanceof Singleton){echo 'Y';}else{echo 'N';}
var_dump($obj);
var_dump($obj === Singleton::getInstance());

$cObj = SingletonChild::getInstance();
var_dump($cObj === Singleton::getInstance());

var_dump($cObj === SingletonChild::getInstance());

/**
 * 单例的基类
 * Class BaseSingleton
 */
class BaseSingleton
{
    private static $_instances = array();

    protected function __construct()
    {
    }

    final public function __clone()
    {
        trigger_error("clone method is not allowed.", E_USER_ERROR);
    }

    final public static function getInstance()
    {
        $c = get_called_class();

        if(!isset(self::$_instances[$c])) {
            self::$_instances[$c] = new $c;
        }

        return self::$_instances[$c];
    }
}