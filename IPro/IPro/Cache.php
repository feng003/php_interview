<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/26
 * Time: 17:29
 */
namespace IPro;

interface CacheInterface{
    public function set($key, $value, $expire=86400);
    public function get($key);
    public function delete($key);
    public function flush();
    //实际上还可以实现诸如批量set、批量get、递增、递减等接口，这里省略
}