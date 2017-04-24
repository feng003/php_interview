<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2015/11/17
 * Time: 8:28
 */
header("Content-Type: text/html; charset=utf-8");
//    $arr = array(
//        'http://www.hxg100.com/',
//        'http://www.radar518.com/',
//        'http://www.sydzsy99.com/',
//        'http://www.huitaozg.com/',
//        'http://www.daotong888.com/',
//        'http://www.zd139.cn/',
//        'http://www.wechatis.com/'
//    );
//    foreach($arr as $k=>$v)
//    {
//        if (Visit($v))
//            echo $v."--Website OK"."<br/>";
//        else
//            echo $v."--Website DOWN"."<br/>";
//    }

    echo "<a href='jinshu.php'>数组转换</a><br>";
    echo "<a href='./Daily/20170424'>字符串操作</a><br>";

    /**
 * 检查网站是否宕机
 * @param $url
 * @return bool
 */
function Visit($url)
{
    $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
    $ch    = curl_init();
    curl_setopt ($ch, CURLOPT_URL,$url );
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch,CURLOPT_VERBOSE,false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch,CURLOPT_SSLVERSION,3);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
    $page=curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    var_dump($httpcode);
    if(($httpcode>=200 && $httpcode<300)||$httpcode == '302'||$httpcode == '301') return true;
    else return false;
}