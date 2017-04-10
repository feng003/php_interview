<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/30
 * Time: 14:16
 */
//header('Content-type: text/html; charset=utf8');
$str = json_encode($_POST);
$data = array('msg'=>'success','status'=>1);

file_put_contents('1.txt',$str,FILE_APPEND);

echo json_encode($data);
