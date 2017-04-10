<?php
date_default_timezone_set('PRC');
require_once "Core/runTime.class.php";
require_once "Core/File.class.php";
$run = new runTime();
$run->start();
$fileInfo = new File();
// print_r($fileInfo->info);
?>
<!-- </pre> -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $fileInfo->info['current'] ?></title>
	<style>
	@charset "utf-8";
@import url(reset.css);

body{
	background: #F2F2F2;
}
li{
	list-style: none;
}
a{
	color: #000;
}
a:hover{
	color: #FF5722;
}
.h-s{
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	height: 300px;
	/*bottom: 0;*/
	background: #36474F;
	z-index: -1;
}
.content{
	margin: 30px auto;
	width: 1000px;
}
.row-1{
	height: 80px;
	line-height: 80px;
	color: #FFF;
	font-size: 40px;
}
.row-1 .right{
	text-align: right;
	font-size: 16px;
	line-height: 80px;
}
.row-1 .right span{
	vertical-align: top;
	margin-right: 12px;
}
.row-1 .right img{
	height: 30px;
	margin-top: 25px;
}
.row-2{
	height: 50px;
	line-height: 50px;
	font-size: 14px;
	color: rgba(255, 255, 255, 0.75);
	/*background: #888;*/
	font-size: 13px;
}
.row-2 .left li{
	float: left;
	margin-right: 50px;
}
.row-2 .right{
	text-align: right;
}
.row-3{
	position: relative;
	background: #FFFFFF;
	min-height: 700px;
	padding-bottom: 20px;
}
.row-3-1{
	height: 16px;
	font-size: 14px;
	padding: 16px 0 16px 0;
}
.row-3-hd{
	height: 16px;
	font-size: 14px;
	padding: 26px 0 26px 0;
}
.row-3-1 li{
	float: left;
	width: 170px; 
	margin-left: 56px;
}
.row-3-1 .first, .row-3-1 .last{
	/*width: 12.5%*/
}
.row-3-1 .first{
	text-align: left;
	margin-left: 26px;
}
.row-3-1 .last{
	text-align: right;
	margin-left: 0;
	margin-right: 26px;
	width: 100px;
}
.row-3-1-dir{
	color: #000;
}
.row-3-1-file{
	color: #888;
}
.vist-button{
	position: fixed;
	bottom: 100px;
	/*right: 0;*/
	right: 160px;
	width: 55px;
	height: 55px;
	line-height: 55px;
	text-align: center;
	border-radius: 50%;
	box-shadow: 0 0px 10px rgba(0, 0, 0, .5);
	background: #3F51B5;
	color: #FFF;
	font-size: 14px;
}
.vist-button:hover{
	box-shadow: 0 3px 20px rgba(0, 0, 0, .6);
}
.left{
	float: left;
}
.right{
	float: right;
}
	</style>
	<script>
		function bodyLoad() {
			var dateTime = new Date();
			var hh = dateTime.getHours(); //小时
			var mm = dateTime.getMinutes(); //分钟
			var week = dateTime.getDay(); //周(0~6,0表示星期日)
			var days = ["日 ", "一 ", "二 ", "三 ", "四 ", "五 ", "六 ", ]
			document.getElementById("date").innerHTML = "星期" + days[week];
			document.getElementById("time").innerHTML = hh + ":" + mm;
			setTimeout(bodyLoad, 1000);
		}
	</script>
</head>
<body onload="bodyLoad()">
	<div class="h-s"></div>
	<div class="content">
		<div class="row-1">
			<div class="left">
				<?php echo $fileInfo->info['current'] ?>
			</div>
			<div class="right">
				<span id="date"> </span> <span id="time"></span>
				<?php
					$time = $run->stop();
					echo '执行时间：'.$time;
				?>
			</div>
		</div>
		<div class="row-2">
			<ul class="left">
				<li>大小：<?php echo $fileInfo->info['size']; ?></li>
				<li>文件夹数量：<?php echo count($fileInfo->info['dir']) ?></li>
				<li>文件数量：<?php echo count($fileInfo->info['file']) ?></li>
				<li>权限：<?php echo $fileInfo->info['perms']; ?></li>
				<li>磁盘空间：<?php echo $fileInfo->info['disk_total_space'] ?></li>
				<li>剩余空间：<?php echo $fileInfo->info['disk_free_space'] ?></li>
			</ul>
		</div>
		<div class="row-3">
	<?php
	if ($fileInfo->info['isVist'] ) 
	{
		// echo '<a href="'.$fileInfo->info['root'].'/'.$fileInfo->info['path'].'"><div class="vist-button">访问</div></a>';
		echo '<a href="'.$fileInfo->info['root'].'"><div class="vist-button">访问</div></a>';
	}
	?>
			<div class="row-3-1 row-3-hd">
				<ui>
					<li class="first">名称</li>
					<li>创建时间</li>
					<li>类型</li>
					<li>权限</li>
					<li class="last">大小</li>
				</ui>
			</div>
			<div class="row-3-1">
				<ui>
					<li class="first">
						<a href="tool.php?path=<?php echo $fileInfo->info['backward']; ?>" clas="dir">上一级</a>
					</li>
					<li></li>
					<li></li>
					<li></li>
					<li class="last"></li>
				</ui>
			</div>
	<?php
		foreach ($fileInfo->info['dir'] as $key => $value) {
			echo '<div class="row-3-1 row-3-1-dir">
				<ui>
					<li class="first"><a href="tool.php?path='.$fileInfo->info['path'].$value['name'].'" clas="dir">'.$value['name'].'</a></li>
					<li>'.$value['ctime'].'</li>
					<li>目录</li>
					<li>'.$value['perms'].'</li>
					<li class="last">'.$value['size'].'</li>
				</ui>
			</div>';
		}
		foreach ($fileInfo->info['file'] as $key => $value) {
			echo '<div class="row-3-1 row-3-1-file">
				<ui>
					<li class="first">'.$value['name'].'</li>
					<li>'.$value['ctime'].'</li>
					<li>文件</li>
					<li>'.$value['perms'].'</li>
					<li class="last">'.$value['size'].'</li>
				</ui>
			</div>';
		}
	?>
		</div>
	</div>
</body>
</html>
?>