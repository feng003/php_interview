<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 17-4-24
 * Time: 下午9:11
 */

//abcdef =>  defabc
$str1 = "abcdef";

var_dump(strModify1($str1));
function strModify1($str){
    $startStr = substr($str,0,3);
    $endStr   = substr($str,-3,3);
    return $endStr.$startStr;
}


//I am a student.  => student. a am I
$str2 = "I am a student.";

var_dump(strModify2($str2));
function strModify2($str)
{
    $arr = explode(' ',$str);
    $newStr = implode(' ',array_reverse($arr));
    return $newStr;
}