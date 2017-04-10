<?php
// TODO  http://blog.jobbole.com/17211/     学习技巧
// phpinfo();

// require_once('./firephp/fb.php');

define ('ROOT',pathinfo(__FILE__,PATHINFO_DIRNAME));
require_once(ROOT.'db/fb.php');

function load_class($class_name){
	$path = ROOT . '/db/' . $class_name.'.php';
	if(file_exists($path)){
		require_once($path);
	}
}