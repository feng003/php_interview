<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午3:39
 */


namespace IPro\Database;

use IPro\IDatabase;

class Pdo implements IDatabase
{

    protected $conn;

    /**
     * @param $host
     * @param $user
     * @param $passwd
     * @param $dbname
     */
    function connect($host,$user,$passwd,$dbname)
    {
        $conn = new \PDO('mysql://host=$host;dbname= $dbname',$user,$passwd);

        $this->conn = $conn;
    }

    /**
     * @param $sql
     * @return resource
     */
    function query($sql){
        $result = $this->conn->query($sql);
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
        unset($this->conn);
    }
}