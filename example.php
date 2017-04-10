<?php
//Common2Action是通过CommonAction复制而来,删除了权限验证的部分
//此功能模拟了多个会员高并发访问
class D_TestAction extends Common2Action{
	function buygp()
	{
		import("@.Action.User.CommonAction");
		$user=M('会员')->where("要选择的一个可以符合条件的会员")->find();
		//赋予SESSION
		$_SESSION[C('USER_AUTH_KEY')] =$user['id'];
		$_SESSION[C('USER_AUTH_NUM')] =$user['编号'];
		//取得对象
		$s=$this->con->get('./user/fun_stock');
		//设置表单
		$_REQUEST['num']=$user['ofc币'];
		//执行指定的操作
		R('User/Fun_deal/stock_buy',array(true));
	}
	function index(){
		set_time_limit(0);
		for($i=0;$i<=20;$i++)
		{
			$fp="fp".$i;
				$$fp = fsockopen('127.0.0.1', $_SERVER["SERVER_PORT"], $errno, $errstr, 30);
				$link = U('Admin/D_Test/buygp');
				$out = "GET {$link} HTTP/1.1\r\n";
				$out .= "Host: ".$_SERVER['HTTP_HOST']."\r\n";
				$out .= "Connection: Close\r\n\r\n";
				fwrite($$fp, $out);
		}
		//在20个并发访问发出后,开始逐个询问返回结果.
		for($i=0;$i<=20;$i++)
		{
			$fp="fp".$i;
			while (!feof($$fp)){echo fgets($$fp, 128);}
		}
	}
}
?>