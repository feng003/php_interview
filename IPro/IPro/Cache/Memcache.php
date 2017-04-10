<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/26
 * Time: 17:31
 */
namespace IPro\Cache;

use IPro\CacheInterface;

class Memcache implements CacheInterface{

    //比较好得实现是，在这里加入PHP脚本缓存（即运行时缓存），这样如果是在
    //一次运行过程中二次读取缓存数据，不用调用底层服务，就能直接返回数据
    private $runningCache = array();

    //Memcache对象实例
    private $memcache;

    //实现Memcache服务的初始化和连接，实际项目中肯定需要根据配置文件初始化，这里简化
    public function __construnct(){
        $memcache = new Memcache;
        $memcache->connect('memcache_host', 11211);
        $this->memcache = $memcache;
    }

    public function set($key, $value, $expire=0){
        $res = $this->memcache->set($key, $value, $expire);
        if ($res){
            $this->runningCache[$key] = $value;
        }
        return $res;
    }

    public function get($key){
        if (isset($this->runningCache[$key])){
            return $this->runningCache[$key];
        }
        return $this->memcache->get($key);
    }

    public function delete($key){
        $res = $this->memcache->delete($key);
        if ($res){
            unset($this->runningCache[$key]);
        }
        return $res;
    }

    public function flush(){
        $res = $this->memcache->flush();
        if ($res){
            $this->runningCache = array();
        }
        return $res;
    }

}