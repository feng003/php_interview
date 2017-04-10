<?php
/**
 * 通过 工厂模式  实现一个可扩展的 计算类
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/12
 * Time: 8:29
 */

/**
 * Interface Calu
 */
interface Calu
{
    public function getValue($num1,$num2);
}

/**
 * Class Plus
 */
class Plus implements Calu
{
    public function getValue($num1,$num2)
    {
        return $num1 + $num2;
    }
}

/**
 * Class Sub
 */
class Sub implements Calu
{
    public function getValue($num1,$num2)
    {
        return $num1 - $num2;
    }
}

/**
 * Class Mul
 */
class Mul implements Calu
{
    public function getValue($num1,$num2)
    {
        return $num1 * $num2;
    }
}

/**
 * Class Div
 */
class Div implements Calu
{
    public function getValue($num1,$num2)
    {
        try
        {
            if($num2 == 0)
            {
                throw new Exception('除数不能为0');
            }else{
                return $num1/$num2;
            }
        }catch (Exception $e){
            echo "错误信息:".$e->getMessage();
        }
    }
}

/**
 * Class CalculatorFactory
 */
class CalculatorFactory
{
    public static function createObj($operator)
    {
        switch ($operator)
        {
            case "+":
                return new Plus();
                break;
            case "-":
                return new Sub();
                break;
            case "/":
                return new Div();
                break;
            case "*":
                return new Mul();
                break;
        }

    }
}

$test = CalculatorFactory::createObj("/");
$res = $test->getValue(5,2);
echo $res;