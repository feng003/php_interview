<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午10:57
 */


index1::test();

//php 5.3之前
function __autoload($class)
{
    require __DIR__.'/'.$class.'.php';
}
//php 5.3之后
spl_autoload_register();