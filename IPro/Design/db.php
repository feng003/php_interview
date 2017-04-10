<?php
/**
 * Adapter适配器
 * 可将一个类的接口转换成客户希望的另外一个接口，使得原本不兼容的接口能够一起工作。
 * 通俗的理解就是将不同接口适配成统一的API接口。
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/5/27
 * Time: 8:24
 */
error_reporting(E_ALL ^ E_DEPRECATED);
/**
 * 适配目标，规定的接口将被适配对象实现
 * Target适配目标： IDataBase接口
 * Interface IDatabase
 */
interface IDatabase
{
    public function connect($host, $username, $password, $database);
    public function query($sql);
}

/**
 * Adapter适配器 ：mysql类和postgresql类
 * Class Mysql
 */
class Mysql implements IDatabase
{
    protected $connect;

    public function connect($host, $username, $password, $database)
    {
        $connect = mysql_connect($host, $username, $password);
        mysql_select_db($database, $connect);
        $this->connect = $connect;
        //...
    }

    public function query($sql)
    {
        $result = mysql_query($sql,$this->connect);
        return $result;
    }
}

/**
 * Adapter适配器 ：mysql类和postgresql类
 * Class Postgresql
 */
class Postgresql implements IDatabase
{
    protected $connect;

    public function connect($host, $username, $password, $database)
    {
        $this->connect = pg_connect("host=$host dbname=$database user=$username password=$password");
        //...
    }

    public function query($sql)
    {
        //...
    }
}

/**
 * Adapter适配器 ：mysql类和postgresql类
 */


//客户端使用
$client = new Mysql();
$client->connect('127.0.0.1','root','toor','lefan');
$sql = "select * from user";
$res = $client->query($sql);
$result = mysql_fetch_array($res);
echo "<pre>";
print_r($result);