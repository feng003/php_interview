<?php
    require('firephp/FirePHP.class.php');

    ob_start();

//    $firephp = FirePHP::getInstance(true);
//    $var = array('i'=>10, 'j'=>20);
//    $firephp->log($var, 'Iterators');die;

    $firephp = FirePHP::getInstance(true);
    $arr = array('1','23','linux');
    $firephp->log($arr);die;

    echo get_current_user()."<br>";
    echo date('g:i a,j M Y',getlastmod());
	phpinfo();
    echo "<pre>";
    print_r($_SERVER);
?>