<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午3:39
 */
namespace IPro\Database;

use IPro\IDatabase;

class Mysql implements IDatabase
{
    protected $conn;

    /**
     * @param $host
     * @param $user
     * @param $passwd
     * @param $dbname
     */
    function connect($host,$user,$passwd,$dbname){
        $conn = @mysql_connect($host,$user,$passwd);
        mysql_select_db($dbname,$conn);
        $this->conn = $conn;
    }

    /**
     * @param $sql
     * @return resource
     */
    function query($sql){
        $result = mysql_query($sql,$this->conn);
        return $result;
    }

    function find(){}

    function select(){}

    function add(){}

    function save(){}

    /**
     *
     */
    function close(){
        mysql_close($this->conn);
    }

}