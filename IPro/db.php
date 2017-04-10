<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午11:07
 */

define('BASEDIR',__DIR__);

include BASEDIR . '/IPro/Loader.php';

spl_autoload_register('\\IPro\\Loader::autoload');

//IPro\Object::test();
//App\c\index::test();

//链式操作
//$db = new IPro\Database();
//$db->where($where)->order($order)->find();
//$db->title = 'title and name';
//echo $db->title;
//echo $db;
//$db->say(123);

//工厂模式
$db = IPro\DatabaseFactory::createDatebase();
//单例模式   无论创建多少次   都只有一次的数据库链接
//$db = IPro\Database::getInstance();
//echo $db;
//注册树模式
//$db = \IPro\Register::get('db1');
//echo $db;
//适配器 Adapter

$db = new \IPro\Database\Mysql();
//ReflectionObject  报告了一个对象（object）的相关信息。
echo "<pre>";
ReflectionObject::export($db);die;

$db->connect('localhost','root','toor','lefan');
$res = $db->query("show databases");
print_r($res);

$db->close();