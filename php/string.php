<?php


function cutArticle($data,$cut=200,$str="....")
{
    $data = strip_tags($data);//去除html标记
    //$pattern = "/&[a-zA-Z]+;/";//去除特殊符号
    //$data=preg_replace($pattern,'',$data);
    if(!is_numeric($cut))
    {
        return $data;
    }
    if($cut>0)
    {
        $data = mb_strimwidth($data,0,$cut,$str);
    }
    return $data;
}
//mb_strimwidth() 获取按指定宽度截断的字符串  strip_tags() 从字符串中去除 HTML 和 PHP 标记 strpos() 返回 needle 在 haystack 中首次出现的数字位置。
//string mb_strimwidth ( string $str , int $start , int $width [, string $trimmarker = "" [, string $encoding = mb_internal_encoding() ]] )
//string strip_tags ( string $str [, string $allowable_tags ] )
//mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] ) 