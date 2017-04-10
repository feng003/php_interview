<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/25
 * Time: 10:30
 */
$ch = curl_init('http://www.sina.com');

curl_exec($ch);

if(!curl_errno($ch)){
    $info = curl_getinfo($ch);
    echo $info['total_time'].$info['url'];
}

curl_close($ch);

//TODO curl_setopt(); 设置一个cURL传输选项 bool curl_setopt ( resource $ch , int $option , mixed $value )
$option = array('url'=>'资源网络地址','conetnet_type'=>'内容编码','http_code'=>'http状态码','header_size'=>'header的大小','request_size'=>'请求的大小','filetime'=>'文件创建时间','ssl_verify_result'=>'ssl验证结果','redirect_count'=>'跳转技术','total_time'=>'总耗时','namelookup_time'=>'dns查询耗时','pretransfer_time'=>'传输','size_upload'=>'上传数据的大小','size_download'=>'下载数据的大小','speed_download'=>'下载速度','speed_upload'=>'上传速度','redirect_time'=>'重定向耗时');