<?php

header('Content-Type:text/html;charset=utf-8');

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2015/3/25
 * Time: 11:42
 */
//TODO addslashes()  addcslashes() bin2hex() hex2bin() chop() chr() ord() chunk_split() convert_cyr_string() convert_uudecode() convert_uuencode() count_chars() crc32() crypt() explode()
//TODO get_html_translation_table();html_entity_decode();htmlentities();htmlspecialchars();htmlspecialchars_decode();implode();join();
//TODO nl2br(); 在字符串 string  所有新行之前插入 '<br />' 或 '<br>'，并返回。

$str = 'Hello world hi php';
//strlen($str);
//
//mb_strlen($str);

//$res = addslashes($str);
//$res = addcslashes($str,'A..m');  //以 C 语言风格使用反斜线转义字符串中的字符
//$rs = addslashes($res);  //使用反斜线引用字符串
//echo $rs;

//$res = explode(',',$str);
//print_r($res);
//lcfirst(); ucfirst(); strtolower();strtoupper() ucwords();
//$rs = lcfirst($str);
//echo $rs;
//$res = ucwords($str);
//echo $res;
//trim()(首尾处) rtrim(开头) ltrim()(末端)


mb_strlen($str);
/**
 * substr加强版，可截取中文字符，
 * @param $str
 * @param $start
 * @param $end
 * @return bool|string
 */
function subistr($str,$start,$end){
    $reslut = '';
    for($i=$start ; $i<=$end ; $i++){
        if(preg_match('/[\x7f-\xff]/',$str[$i]) ){
            $reslut .= $str[$i].$str[$i+1].$str[$i+2];
            $i = $i+2;
            $end = $end+2;
        }else{
            $reslut .= $str[$i];
        }
    }
    return $reslut?$reslut:false;
}

// $ch = '0as这ss是带中文的测dd试bnb';
// var_dump(subistr($ch,0,7));

    /**
     * 过滤掉 微信昵称中的表情
     * @param $string
     * @return mixed
     */
    function modifier_emojistrip($string)
    {
        return preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $string);
    }

$str = "你好，欢迎使用[11111].我们会马上给你发货，地址：[22222],woshi [args3]";
//print_r(explode('[',$str));
//print_r(strpos($str,'['));

// preg_match('/\[\w+\]/',$str,$arr);
//preg_match('/.+(\[\w+\]).+(\[\w+\])/',$str,$arr);
// print_r($arr);
//print_r($str);
$reg = '/\[\w+\]/';
// $args = 'hello';
$args = array('hello','hi','hh');
// if(preg_match_all($re, $str, $matches)){
//     echo $matches[0][0]."<br />";
//     echo $matches[0][1]."<br />";
//     echo $matches[0][2]."<br />";
//     print_r($matches);
// }

preg_match_all($reg, $str, $matches);

// $arr = array_replace($matches[0], $args);
// // print_r($arr);die;
// $strs = str_replace([11111], $args, $str);
// print_r($strs);
$strs = preg_replace($matches[0],$args,$str);

print_r($strs);

    
    function multiple_replace_words($word,$replace,$string,$tmp_match='#a_a#'){
        preg_match_all('/'.$word.'/',$string,$matches);    //匹配所有关键词
        $search = explode(',','/'.implode('/,/',$matches[0]).'/');        
        //不存在匹配关键词
        if(empty($matches[0])) return false;
        
        //特殊替换设置
        $count = count($matches[0]);
        foreach($replace as $key=>$val){
            if(!isset($matches[0][$key])) unset($replace[$key]);    //剔除越界替换
        }

        //合并特殊替换数组与匹配数组
        for($i=0;$i<$count;$i++){
            $matches[0][$i] = isset($replace[$i])? $replace[$i] : $matches[0][$i];
        }
        $replace = $matches[0];
        
        //防止替换循环，也就是替换字符仍是被替换字符，此时将其临时替换一个特定字符$tmp_match
        $replace = implode(',',$replace);
        $replace = str_replace($word,$tmp_match,$replace);    //临时替换匹配字符
        $replace = explode(',',$replace);
        
        
        //替换处理
        $string = preg_replace($search,$replace,$string,1);     //每次只替换数组中的一个
        $string = str_replace($tmp_match,$word,$string);        //还原临时替换的匹配字符
        
        return $string;
    }



    /**
     * 把数组内的< >替换成{ }。 
     */
  $arr = array("<小刚>","<小晓>","<小飞>","<小李>","<小红>");
  function arrContentReplact($array)
  {
    if(is_array($array))
    {
      foreach($array as $k => $v)
      {
        $array[$k] = arrContentReplact($array[$k]);
      }
    }else
    {
      $array = str_replace(array('<', '>'), array('{', '}'), $array);
    }
    return $array;
  }