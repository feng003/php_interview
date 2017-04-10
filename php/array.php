<?php





function arr_del(&$carts,$id,$did){
    foreach($carts as $cartskey => $cartsval){
        if($cartskey == $id){
            if($did != ''){
                foreach($cartsval as $didkey=>$didval){
                    if($didkey == $did){
                        unset($cartsval[$didkey]);
                    }
                }
            }else{
                unset($cartsval);
            }
        }
    }
    print_r($carts);
}
$arr = array('233'=>'21215','234'=>array('cu'=>123));

die;



/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2015/3/29
 * Time: 9:24
 */
//TODO array_walk() array_map() array_filter() array_reduce()

header("content-Type:text/html;charset=utf-8");

$arr    = array(11,23,45,22,234,29,80,21,28,21,28);
$strArr = array('12','linux','Linux','sort','array','ksort','asort');
$arrs   = array('1'=>'sort','2'=>'asort','3'=>'ksort','ksort'=>'按key排序','asort'=>'按value排序');

/**
 * 数组统计函数 count sizeof array_count_values
 * @param $arrs
 * @param $strArr
 */
function statics($arrs,$strArr){
    $str = count($arrs);
    echo $str;
    $strr = sizeof($strArr);
    echo $strr;
    $res = array_count_values($arrs); //返回一个数组  每个数组元素出现的次数
    print_r($res);
}
statics($arrs,$strArr);

/**
 * array 操作 首位元素操作 shift/unshift   末尾元素 pop/push
 * @param $arr
 */
function operate($arr){
    print_r($arr);echo '<br>';
//    array_shift($arr); //移除数组第一个元素  shift 去掉
//    array_unshift($arr,'array_unshift'); //数组开始位置添加一个元素
//    array_pop($arr); //移除数组最后一个元素
    array_push($arr,'array_push'); //数组末尾添加一个元素  push 添加
//    $res=array_unique($arr); //移除重复的元素
//    print_r($res);echo '<br>';
    print_r($arr);
}
//operate($arr);

/**
 * 浏览数组元素 current next end each
 * @param $arr
 */
function skim($arr){
    //echo current($arr);
//echo next($arr);
    echo reset($arr);
    echo end($arr);
    print_r(each($arr));
//print_r($arr);

}

/**
 * 数组排序 sort asort ksort
 */
function arrSort($arr,$strArr,$arrs){
    ksort($arrs);
    sort($arr);
    sort($strArr);
    print_r($arrs);echo"<br>";
    print_r($arr);echo"<br>";
    print_r($strArr); echo"<br>";
    $res = array_reverse($strArr); //反向排序
    print_r($res);
    //shuffle($arr);   //随机排序
//    array_rand($arr);  //从数组中随机取出一个或多个单元
}
//arrSort($arr,$strArr,$arrs);

/**
 * @param $x
 * @param $y
 * @return int
 */
function compare($x,$y){
    if($x[2] == $y[2]){
        return 0;
    }else if($x[2]<$y[2]){
        return -1;
    }else{
        return 1;
    }
}
//usort($arr,function());
//array array_change_key_case(array $input [, int $case = CASE_LOWER ])   返回字符串键名全为小写或大写的数组


