<?php
/**
 * 接口的方法名是show，继承接口的类中必须有show这个方法，要不然就会报错。也就是说接口的方法是假的，真正起作用的是在继承的类中的方法
 * 继承接口类中，调用接口的方法时，所传参数要和接口中的参数名要一至。
 * 一个接口可以被多个类继承，并且类名不一样。同一个类之间可以相互调用，不同类之间不能调用。
 */
interface face{
	const PARA = "test";
	public function show();
	public function assign();
}

class test implements face{

	public function show(){
		echo 11111;
	}
	public function assign(){

	}
}
$test = new test();
echo $test->show();
echo face::PARA;
?>