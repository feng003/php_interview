<?php
/**
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/1
 * Time: 9:53
 * 逐渐深入地理解Ajax
 * http://web.jobbole.com/82447/
 */

    $data = json_decode(file_get_contents("php://input"));
    echo ('{"id" : ' . $data->id . ', "age" : 24, "sex" : "boy", "name" : "huangxueming"}');