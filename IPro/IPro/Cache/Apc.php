<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/26
 * Time: 17:29
 */
namespace IPro\Cache;
use IPro\CacheInterface;

 class Apc implements CacheInterface{

     //比较好得实现是，在这里加入PHP脚本缓存（即运行时缓存），这样如果是在
     //一次运行过程中二次读取缓存数据，不用调用底层服务，就能直接返回数据

     private $runningCache = array();

     public function set($key, $value, $expire=0){
         $res = apc_store($key, $value, $expire);
         if ($res){
             $this->runningCache[$key] = $value;
         }
         return $res;
     }

     public function get($key){
         if (isset($this->runningCache[$key])){
             return $this->runningCache[$key];
         }
         return apc_fetch($key);
     }

     public function delete($key){
         $res = apc_delete($key);
         if ($res){
             unset($this->runningCache[$key]);
         }
         return $res;
     }

     public function flush(){
         $res = apc_clear_cache('user');
         if ($res){
             $this->runningCache = array();
         }
         return $res;
     }

 }