<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 11:28
 */

define('BASEDIR',__DIR__);

include BASEDIR . '/IPro/Loader.php';

spl_autoload_register('\\IPro\\Loader::autoload');
