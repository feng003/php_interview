<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午11:44
 */

namespace IPro;

class Database{

    protected $arr = array();
    static private $db;

    /**
     * 成员属性
     * @param $key
     * @return mixed
     */
    function __get($key)
    {
        return $this->arr[$key];
    }

    function __set($key,$value)
    {
        $this->arr[$key] = $value;
    }

    /**
     * 成员方法
     * @param $func
     * @param $param
     * @return string
     */
    function __call($func,$param){
        var_dump($func,$param);
        return "magic function \n";
    }

    /**
     * 类的静态方法
     */
    static function __callStatic($func,$param){
        var_dump($func,$param);
        return "magic static function \n";
    }

    function __toString(){
        return __CLASS__;
    }

    function __invoke($param){
        var_dump($param);
    }

    private function __construct(){

    }

    /**
     * 获取实例
     */
    static function getInstance(){
        if(self::$db){
            return self::$db;
        }else{
            self::$db = new self();
            return self::$db;
        }
    }

    /**
     * @param $where
     * @return $this 实现链式操作
     */
    function where($where){

        return $this;
    }

    function limit($limit){

        return $this;
    }

    function order($order){

        return $this;
    }

    function find(){

    }

    function select(){

    }
}