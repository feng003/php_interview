<?php
class runTime {
	private $startTime = 0;
	private $stopTime  = 0;
	private function getMicrotime() {
		list($mesc, $secs) = explode(' ', microtime());
		return $secs + $mesc;
	}
	public function start() {
	 	$this->startTime = $this->getMicrotime();
	 }
	public function stop() {
	 	$this->stopTime = $this->getMicrotime();
	 	// 计算执行时间
	 	if (round(($this->stopTime - $this->startTime) * 1000, 2) / 1000 > 1) {
			return round(($this->stopTime - $this->startTime), 2).'秒';
	 	}else {
			return round(($this->stopTime - $this->startTime) * 1000, 2).'毫秒';
	 	}
	}
}
// $run = new runTime();
// $run->start();
// // 程序体
// for ($i=0; $i < 10000000; $i++) { 
// 	echo '';
// }
// $time = $run->stop();
// echo '程序执行共花费了：'.$time.'毫秒！';
?>