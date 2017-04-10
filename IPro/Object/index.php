<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午4:46
 */

class NbaPlayer
{

    public $name;
    public $team;
    public $num;

    function __construct()
    {
        $this->name = 'Jordan';
        $this->team = 'Bull';
        $this->num  = '23';
    }

    function __get($value){
        return $value;
    }

    function __set($key,$value){

    }

    public function run()
    {
        echo 'run';
    }

    public function jump()
    {
        echo 'jump';
    }

    public function shoot()
    {
        echo 'shoot';
    }

    public function pass()
    {
        echo 'pass';
    }
}

$jordan = new NbaPlayer();
print $jordan->num;
$jordan->run();