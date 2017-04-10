<?php
/**
 * factory
 * In this pattern, a class simply creates the object you want to use.
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/12
 * Time: 8:04
 */

class Automobile
{
    private $vehicleMake;
    private $vehicleModel;

    public function __construct($make,$model)
    {
        $this->vehicleMake = $make;
        $this->vehicleModel = $model;
    }

    public function getMakeAndModel()
    {
        return $this->vehicleMake. '' . $this->vehicleModel;
    }
}

class AutomobileFactory
{
    public static function create($make,$model)
    {
        return new Automobile($make,$model);
    }
}
$vey = AutomobileFactory::create('bug','veyron');
print_r($vey);
print_r($vey->getMakeAndModel());