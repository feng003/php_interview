<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/29
 * Time: 8:07
 */

function shortUrl($url){
    $base32 = array (
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
        'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
        'y', 'z', '0', '1', '2', '3', '4', '5'
    );

    $hex = md5($url);
    $hexLength = strlen($hex);
    $subHexLen = $hexLength / 8;

    $output = array();
    for ($i = 0; $i < $subHexLen; $i++) {
        //每循环一次取到8位
        $subHex = substr ($hex, $i * 8, 8);
        $int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
        $out = '';

        for ($j = 0; $j < 6; $j++) {
            $val = 0x0000001F & $int;
            $out .= $base32[$val];
            $int = $int >> 5;
        }

        $output[] = $out;
    }

    return $output;
}


function shortUrl2($url){
    $result = sprintf("%u",crc32($url));
    $show = '';
    while($result  >0){
        $s = $result % 62;
        if($s > 35){
            $s=chr($s+61);
        }elseif($s>9 && $s<=35){
            $s=chr($s+55);
        }
        $show .= $s;
        $result = floor($result / 62);
    }

    return $show;
}

echo shortUrl2('http://baidu.com');