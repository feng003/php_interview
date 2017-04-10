<?php
/**
 * 注册器模式
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午3:29
 */

namespace IPro;

class Register{


    protected static $object;

    /**
     * 对象注册到全局的对象
     * @param $alias
     * @param $object
     */
    function set($alias,$object){
        self::$object[$alias] = $object;

    }

    /**
     *
     * @param $alias
     * @return mixed
     */
    static function get($name){
        return self::$object[$name];
    }

    /**
     * @param $alias
     */
    function __unset($alias){
        unset(self::$object[$alias]);
    }

}