<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/26
 * Time: 17:33
 */

namespace IPro;

class CacheFactory
{
    //缓存我们已经实例化过的类，类似单例模式，但不是很严格
    private static $instance;

    //这里具体返回哪个Cache实例，根据全局的常量配置：CACHE_TYPE
    public static function getInstance(){
        if (is_null(self::$instance)){
            if (CACHE_TYPE == 'APC'){
                self::$instance = new ApcAdapter();
            }elseif (CACHE_TYPE == 'Memcache'){
                self::$instance = new MemcacheAdapter();
            }
        }
        return self::$instance;
    }
}