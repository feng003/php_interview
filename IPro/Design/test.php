<?php
/**
 * 适配器模式
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/5/27
 * Time: 8:12
 */

//老的代码
class User {
    private $name;

    function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}
//新代码，开放平台标准接口
interface UserInterface {

    function getUserName();

}

//这里的新接口使用了组合方式，UserInfo内部有一个成员变量保存老接口User对象，模块之间是松耦合的，这种结构其实就是组合模式。不要使用继承，虽然UserInfo继承User也能达到同样的目的，但是耦合度高，相互产生影响。
class UserInfo implements UserInterface {
    protected $user;

    function __construct($user) {
        $this->user = $user;
        print_r($this->user);
    }

    public function getUserName() {
        return $this->user->getName();
    }
}

//将一个类的接口转换成客户希望的另一个接口,适配器模式使得原本的由于接口不兼容而不能一起工作的那些类可以一起工作
$olduser = new User('张三');
echo $olduser->getName()."<br/>";

$newuser = new UserInfo($olduser);
echo $newuser->getUserName()."<br/>";