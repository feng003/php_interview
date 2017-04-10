<?php
/**
 * 装饰者模式
 * 是不修改原类代码和继承的情况下动态扩展类的功能。
 * 传统的编程模式都是子类继承父类实现方法重载，使用装饰器模式，只需添加一个新的装饰器对象，更加灵活，避免类数量和层次过多。
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/5/27
 * Time: 8:38
 */

/**
 * 被装饰者基类
 * Interface Component
 */
interface Component
{
    public function operation();
}

/**
 * 装饰者基类
 * Class Decorator
 */
abstract class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation()
    {
        $this->component->operation();
    }
}

/**
 * 具体装饰者类
 * Class ConcreteComponent
 */
class ConcreteComponent implements Component
{
    public function operation()
    {
        echo 'do operation'.PHP_EOL;
    }
}

/**
 * 具体装饰类A
 * Class ConcreteDecoratorA
 */
class ConcreteDecoratorA extends Decorator {

    public function __construct(Component $component) {
        parent::__construct($component);
    }

    public function operation() {
        parent::operation();
        $this->addedOperationA();  // 新增加的操作
    }

    public function addedOperationA() {
        echo 'Add Operation A '.PHP_EOL."<br/>";
    }
}

/**
 * 具体装饰类B
 * Class ConcreteDecoratorB
 */
class ConcreteDecoratorB extends Decorator {

    public function __construct(Component $component) {
        parent::__construct($component);
    }

    public function operation() {
        parent::operation();
        $this->addedOperationB();
    }

    public function addedOperationB() {
        echo 'Add Operation B '.PHP_EOL;
    }
}


class Client {

    public static function main() {
        /**
         * do operation Add Operation A
         */
        $decoratorA = new ConcreteDecoratorA(new ConcreteComponent());
        $decoratorA->operation();

        /**
         * do operation Add Operation A
         * Add Operation B
         */
        $decoratorB = new ConcreteDecoratorB($decoratorA);
        $decoratorB->operation();
    }

}

Client::main();