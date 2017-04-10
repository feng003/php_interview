<?php
  //TODO is_object(var)
  Class  person{
      public  $name;
      public  $sex;
      public  $age;
      public function  __construct(){
          $name = 'hello';
          $age = 19;
          $sex = 'female';
      }

      public function p($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
      }

    public  function  say($str){
      echo  $str;
    }
  }
  $stu = new  person();
  $stu->name = 'linux';
  $stu->say('hello,php');
  $stu->say($stu->name);
  echo "<br>";
  echo serialize($stu);

  Class B extends person{
    public $string;
    public $array;

    public function __construct(){
      parent::__construct();
      $this->name = 'person_name';
    }

    public function B_say(){
      echo $this->name;
    }
  }

$b = new B();
$b->B_say();
$b->p($_SERVER);
 ?>
