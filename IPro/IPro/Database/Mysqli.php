<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午3:39
 */

namespace IPro\Database;

use IPro\IDatabase;

class Mysqli implements IDatabase
{

    protected $conn;

    /**
     * @param $host
     * @param $user
     * @param $passwd
     * @param $dbname
     */
    function connect($host,$user,$passwd,$dbname){
        $conn = mysqli_connect($host,$user,$passwd,$dbname);
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