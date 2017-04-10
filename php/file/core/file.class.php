<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
class File {
	public $info = array('dir'=>array(), 'file'=>array(), 'path'=>'', 'current'=>'', 'backward'=>'');
	
	function __construct() {
		$this->getBaseInfo();
		return $this->info;
	}
	// 获取当前目录基本信息
	protected function getBaseInfo() 
	{
		$this->info['root']		= 'www/';
		$this->info['path'] 	= '';				// 计算当前路径
		$this->info['current'] 	= 'www';			// 前目录名称
		$this->info['backward'] = '';				// 上一级目录路径
		$this->info['size']		= 0;				// 当前目录大小
		$this->info['isVist']	= false;
		// 如果当前目录不为根目录
		if (!empty($_GET['path'])) 
		{
			$analyticle = $this->dealURL();								// 处理地址参数
			$this->info['path'] 	.= implode('/', $analyticle).'/';
			$this->info['current'] 	 = array_pop($analyticle);
			$this->info['backward'] .= implode('/', $analyticle);
		}
		// 获取当前目录下所有文件夹和文件
		$fullPath = 'E:/wamp/www/'.$this->info['path'];
		
		$handle      = opendir($fullPath);
		while ($item = readdir($handle)) {
			$tmp = array();
			if ($item[0] == '.') {
				continue;             
			} elseif ($item == 'index.php' || $item == 'index.html' || $item == 'index.htm') {
				$this->info['isVist']	= true;
				continue;
			}
			$filename 			= $fullPath.$item;
			$tmp['name'] 		= $item;
			$tmp['ctime'] 		= date('Y-m-d h:m:s', fileatime($filename));
			$tmp['size']		= null;
			if (is_dir($filename)) {			
				// 计算目录大小
				$cacheName 		= md5($this->info['path'].$item);
				$cacheFile 		= './Cache/'.$cacheName;
				$fileStat 		= stat($filename);
				if (file_exists($cacheFile)) {
					$cacheStat 	= (array)(json_decode(file_get_contents($cacheFile)));
					if ($fileStat['ctime'] == $cacheStat['ctime']) {		// 加载文件信息缓存文件
						$dirSize = $cacheStat['size'];
					}else{
						$dirSize = $this->countDirSize($filename);			// 更新文件信息缓存
						$fileStat['size'] = $dirSize;
						file_put_contents($cacheFile, json_encode($fileStat));
					}
				}else{
					$dirSize = $this->countDirSize($filename);
					$fileStat['size'] = $dirSize;
					file_put_contents($cacheFile, json_encode($fileStat));	// 创建文件信息缓存
				}
				if (round($dirSize / 1024 / 1024, 2) > 1024) {
					$tmp['size']		= round($dirSize / 1024 / 1024 / 1024, 2).'G';
				}elseif (round($dirSize / 1024 / 1024, 2) > 1) {
					$tmp['size']		= round($dirSize / 1024 / 1024, 2).'M';
				}else{
					$tmp['size']		= round($dirSize / 1024, 2).'K';
				}
				
				$tmp['perms']			= substr(sprintf("%o",fileperms($filename)),-4);
				$this->info['dir'][] 	= $tmp;
				$this->info['size'] 	+= $dirSize;
			}else {
				$tmp['size']			= round((filesize($filename) / 1024), 2).'k ';
				$tmp['perms']			= substr(sprintf("%o",fileperms($filename)),-4);
				$this->info['file'][] 	= $tmp;
				$this->info['size'] 	+= filesize($filename);
			}
		}
		$this->info['disk_total_space'] = round(disk_total_space($fullPath) / 1024 / 1024 / 1024, 2)."G";		// 计算当前目录所在磁盘空间大小
		$this->info['disk_free_space'] 	= round(disk_free_space($fullPath) / 1024 / 1024 / 1024, 2)."G";		// 计算当前目录所在磁盘剩余空间
		$this->info['perms']			= substr(sprintf("%o",fileperms($fullPath)),-4);
		// var_dump(disk_total_space($fullPath));die;						// 但当前目录权限
		// 换算当前目录大小
		if (round($this->info['size'] / 1024 / 1024, 2) > 1024) {
			$this->info['size']			= round($this->info['size'] / 1024 / 1024 / 1024, 2).'G';
		}elseif (round($this->info['size'] / 1024, 2) > 1024) {
			$this->info['size']			= round($this->info['size'] / 1024 / 1024, 2).'M';
		}else{
			$this->info['size']			= round($this->info['size'] / 1024, 2).'K';
		}
	}
	protected function dealURL() 
	{
		$arr_URL = explode('/', $_GET['path']);
		foreach ($arr_URL as $key => $value) 
		{
			if ($value == '') {
				unset($arr_URL[$key]);
			}
		}
		return array_merge($arr_URL);
	}
	protected function countDirSize($filePath) 
	{
		$countSize = 0;
		$handle    = opendir($filePath);
		while ($item = readdir($handle)) 
		{
			if ($item[0] == '.') continue;
			$filename = $filePath.'/'.$item;
			if (is_dir($filename)) {
				$countSize += $this->countDirSize($filename);
			}else {
				$countSize += filesize($filename);
			}
		}
		return $countSize;
	}
}
?>