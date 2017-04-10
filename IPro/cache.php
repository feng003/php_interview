<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午11:07
 */
define('BASEDIR',__DIR__);

include BASEDIR . '/IPro/Loader.php';

$loader = new \IPro\Loader();
$loader->registerAutoloader();
//适配器
//$db = new IPro\Database\Pdo();
//$db->connect('localhost','root','toor','lefan');
//$res = $db->query("show databases");
//print_r($res);
//$db->close();

//这个时候如果想换底层服务，基本上只用改下常量CACHE_TYPE的值就行了，但是还是要注意一下，如果底层
//使用文件缓存或APC缓存的话，会有分布式部署的问题，即如果有多个前端，缓存就只是在当前访问的那个前端有效
//这部分的差异，是没法单纯从代码封装上去解决的
/**
 *  被适配者通过适配器完成对适配目标的适配，以达到对客户使用透明的目的。
    被适配者(Adaptee): Memcache对象、APC函数集
    适配目标(Target): CacheInterface
    适配器(Adapter): ApcAdapter、MemcacheAdapter
    客户(Client): 最后的$cacheKey = "data_123";代码块
 */

$cacheKey = "data_123";
$cache = \IPro\CacheFactory::getInstance();//客户具体使用的时候，完全不用关心底层用的什么服务

$data = $cache->get($cacheKey);
if ($data === false){
    $data = getDataFromMysql(123);
    if ($data){
        $fileCache->set($cacheKey, $data, 86400);
    }
}