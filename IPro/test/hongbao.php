<?php
/**
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/18
 * Time: 8:27
 */

header("Content-Type: text/html;charset=utf-8");

/**
 * 发红包
 * @param $total   红包额度
 * @param $num     红包数量
 * @param float $min  红包最小额度
 * @return array   每个红包的数量
 */
function sendHongBao($total,$num,$min=0.01)
{

    if(!$total){
        echo "金额不能为0";
        exit();
    }
    if(!$num){
        echo "输入红包数";
        exit();
    }
    if(($total/$num)<0.01){
        echo "要给.".$num."份红包,每份至少0.01,你至少得发送".($num*0.01)."元";
        exit();
    }

    $arr = array();
    for ($i=1;$i<=$num;$i++)
    {
        if($num-$i>0)
        {
            $safe_total = ($total-($num-$i)*$min)/($num-$i);//随机安全上限
            $money = mt_rand($min*100,$safe_total*100)/100;
            $total = $total-$money;
            $arr[] = $money;
        }else{
            $arr[] = $total;
        }
    }
    return $arr;
}

$res = sendHongBao(1,5);
print_r($res);

function send()
{
$number = 20; // 人数
$total = 1;  // 总金额
if(!$total){
    echo "金额不能为0";
    exit();
}
if(!$number){
    echo "输入红包数";
    exit();
}
if(($total/$number)<0.01){
    echo "要给{$number}份红包,每份至少0.01,你至少得发送".($number*0.01)."元";
    exit();
}
$wallet = array(); // 红包列表
$h = ceil(0.1*$number);//红包较高的人数为1%
$l = $number-$h;//红包较少人数
// 算法
for($ii = $l; $ii > 0; $ii--){
    @$xx = $ii == 1 ? mt_rand(1,99)/100 : mt_rand(1,($total/$ii))-(mt_rand(1,99)/100);
    if((($total-$xx)/$ii<=0.01) or $xx<=0){//判断是否大于限制，防止红包过多，有人分不到
        $xx = 0.01;
    }else{
        $xx = round($xx,2);
    }
    $total -= $xx;
    $wallet[] = $xx;
}
for($i = $number; $i > 0; $i--){
    @$x = $i == 1 ? $total : mt_rand(1,($total/$i))+(mt_rand(1,99)/100);
    if(((($total-$x)/$i<=0.01) or $x<=0) && $i!=1){//判断是否大于限制，防止红包过多，有人分不到
        $x = 0.01;
    }else{
        $x = round($x,2);
    }
    $total -= $x;
    $wallet[] = $x;
}
shuffle($wallet);//打乱随机处理

// 总和
echo 'total:',count($wallet).'人共获取：', array_sum($wallet), '元<br />';
//结果
echo 'wallet:<br/> ', join('<br/>', $wallet);

}