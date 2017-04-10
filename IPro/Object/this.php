<?php
/**
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/16
 * Time: 8:22
 */

class Convert
{
    public static function c2f($degress)
    {
        return (1.8*$degress)+32;
    }

}

$f = Convert::c2f(12);
print_r($f);