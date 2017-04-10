<?php
/**
 * Created by PhpStorm.
 * User: zhangb
 * Date: 15-5-23
 * Time: 上午12:03
 */

namespace IPro;

class DatabaseFactory{

    static function createDatebase(){

        $db = Database::getInstance();

        Register::set('db1',$db);

        return $db;
    }
}