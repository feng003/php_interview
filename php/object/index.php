<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-6
 * Time: 下午8:18
 */

Class Linux{

    public $name;
    public $file;

    function __construct($param){
        $this->name = 'My name is Linux ' .$param."<br>";
    }

    function __get($str){
        return $this->$str;
    }

    function __set($str,$value){
        return $this->$str = $value;
    }
    function say($str){
        if($str){
            echo $this->name;
        }else{
            echo $this->file;
        }
    }
    function print_file($file){
        if(is_dir($file)){
            $res = fopen($file,'w');


        }
    }
}

$li = new Linux('home');
//$li->name ='my name is shell';
//echo $li->name;
$li->user = 'user';
echo $li->user;

Class lamp extends Linux{
    public $name;
    private $struct;
    protected $goucheng;

}