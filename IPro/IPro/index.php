<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午11:07
 */
define('BASEDIR',__DIR__);

include BASEDIR.'/IPro/Loader.php';

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
//$db = \IPro\Factory::createDatebase();
//单例模式
$db = IPro\Database::getInstance();
echo $db;