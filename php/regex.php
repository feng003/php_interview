<?php
/**
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/3/31
 * Time: 14:00
 */

//TODO ^ $ * + {}  [] () !  preg_grep() preg_match() preg_split() preg_replace()
/**
 * \b 元字符 匹配一个 位置（开始或者结束）
 *  . 匹配除了换行符之外的任意 字符
 *  * 匹配 数量  指定*前边的内容可以连续重复使用任意次
 * \d 匹配一位数字(0-9)
 * \s 匹配任意的空白符（空格、制表符、换行符）
 * \w 匹配字母或者数字或下划线或汉字等
 *  + 重复一次或更多次
 *  ? 重复0次或者1次
 *  {n} 重复n次
 *  {m,n} 重复不多于n次  不少于m次
 *  \ 字符转义  \.  \*  \\
 */
//    $str = "himm";
//    $pattern = "#\bhi#";
//    $pattern = "/0\d{2}-\d{8}/";
//    $str = '128-1234678';
//IP地址  2[0-4]\d | 25[0-5] | [01]?\d\d?
//    $pattern = "/^((25[0-5]|2[0-4]\d|[01]?\d\d?)($|(?!\.$)\.)){4}$/";
    $str = "212.168.187.01";
//    $pattern = "/((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)/";

    $pattern = "/((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)/";
    $res = preg_match($pattern,$str);
    if($res){
        echo 1;
    }else{
        echo 0;
    }

/**
 * The match that begins earliest wins .
 * 字符类 [a-zA-Z0-9]   \w   [0-9]   \d
 *  | 分枝条件 如果满足其中任意一种规则都应该匹配  从左向右执行每个条件，满足某个分枝，就不去管其他条件
 *  () 子表达式  分组
 *  反义    \W  \S \D \B [^x]  [^xfb]
 *  ^(?![^a-zA-Z]+$)(?!\D+$).{6,}$   匹配数字和字母组合 至少6位
 *  后向引用 \b(\w+)\b\s+\1\b 匹配重复的单词 go go
 *
 *  贪婪匹配 匹配尽可能多的字符   a.*b 匹配最长的以a开始，以b结束的字符串
 *  懒惰匹配 匹配尽可能少的字符 在后面加上一个 ?   .#?  匹配任意数量的重复，但是在能使整个匹配成功的前提下使用最少的重复。
 *
 * 零宽断言  \b ^ $ 用于指定一个位置，这个位置应该满足一定的条件（即断言）
 * 零宽度正预测先行断言 (?=exp) 它断言自身出现的位置的后面能匹配表达式 exp   \b\w+(?=ing\b)
 * 零宽度正回顾后发断言 (?<=exp)  它断言自身出现的位置的前面能匹配表达式 exp
 *
 * (?<=\s)\d+(?=\s) 匹配以空白符间隔的数字（不包括空白符）
 *
 */
//TODO email邮箱验证
$email = "test@ansoncheung.tk";
if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) {
    echo "Your email is ok.";
} else {
    echo "Wrong email address format";
}
// filter_var()  Filters a variable with a specified filter     
// mixed filter_var ( mixed $variable [, int $filter = FILTER_DEFAULT [, mixed $options ]] )
if (filter_var('test+email@ansoncheung', FILTER_VALIDATE_EMAIL)) {
    echo "Your email is ok.";
} else {
    echo "Wrong email address format.";
}

//TODO 用户名验证
$username = "user_name12";
if (preg_match('/^[a-z\d_]{6,20}$/i', $username)) {
    echo "Your username is ok.";
} else {
    echo "Wrong username format.";
}

//TODO 验证IP地址 
// $IP = "198.168.1.78";
// if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$IP)) {
//     echo "Your IP address is ok.";
// } else {
//     echo "Wrong IP address.";
// }

//TODO 信用卡
$cc = "378282246310005";
if (preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/', $cc)) {
    echo "Your credit card number is ok.";
} else {
    echo "Wrong credit card number.";
}

//域名验证
$url = "http://ansoncheung.tk/";
 if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
 echo "Your url is ok.";
 } else {
 echo "Wrong url.";
 }

 //TODO url中提取域名
 $url = "http://ansoncheung.tk/articles";
 preg_match('@^(?:http://)?([^/]+)@i', $url, $matches);
 $host = $matches[1];
echo $host;

//TODO 中文关键词高亮显示
$text = "Sample sentence from AnsonCheung.tk, regular expression has become popular in web programming. Now we learn regex. According to wikipedia, Regular expressions (abbreviated as regex or regexp, with plural forms regexes, regexps, or regexen) are written in a formal language that can be interpreted by a regular expression processor";
$text = preg_replace("/\b(regex)\b/i", '<span style="background:#5fc9f6">\1</span>', $text);
echo $text;
