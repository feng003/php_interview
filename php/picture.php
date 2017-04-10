<?php

		// $user_image = '6.gif';
		//获取头像图片的高和宽
		// list($src_w, $src_h) = getimagesize($user_image);
		// $imgWidth  = '90';
        // $imgHeight = '90';
		
		// //改变头像图片大小
		// $new_image  = imagecreatetruecolor($imgWidth, $imgHeight);
		// $user_image = imagecreatefromjpeg($user_image);
		// imagecopyresized($new_image, $user_image, 0, 0, 0, 0,$imgWidth,$imgHeight,$src_w, $src_h);
		// imagejpeg($new_image,'./1.jpg');


		//TODO getimagesize — 取得图像大小 array getimagesize ( string $filename [, array &$imageinfo ] )

		//TODO imagefttext — 使用 FreeType 2 字体将文本写入图像  array imagefttext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text [, array $extrainfo ] )
		
		//TODO imagecreatefromjpeg — 由文件或 URL 创建一个新图象。  resource imagecreatefromjpeg ( string $filename )
		//TODO imagecreatefrompng — 由文件或 URL 创建一个新图象

		//TODO imagecopymerge — 拷贝并合并图像的一部分  bool imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )

		//TODO imagecopyresized — 拷贝部分图像并调整大小  bool imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
		//TODO imagecreatetruecolor — 新建一个真彩色图像  resource imagecreatetruecolor ( int $width , int $height )

		//TODO imagetypes — 返回当前 PHP 版本所支持的图像类型
		//TODO imagejpeg — 输出图象到浏览器或文件。  bool imagejpeg ( resource $image [, string $filename [, int $quality ]] ) imagejpeg() 从 image 图像以 filename 为文件名创建一个 JPEG 图像。
		//TODO imagepng — 以 PNG 格式将图像输出到浏览器或文件
		// $img = './1.jpg';
		// $arr = getimagesize($img);		

		function imgcreatefromstyle($img){
			$arr = getimagesize($img);
			if(strpos($arr['mime'],'png')){
				return imagecreatefrompng($img);			
			}elseif(strpos($arr['mime'],'jpeg')){
				return imagecreatefromjpeg($img); 
			}else{
				return imagecreatefromgif($img); 
			}
		}
		
		// print_r(imgcreatefromstyle($img));
		// print_r($arr);
		// die;

		//头像
		$user_image ='./1.jpg';
		$arr = getimagesize($user_image);
		print_r($arr);
		$imgWidth  = '90';
		$imgHeight = '90';
		$image      = imagecreatetruecolor($imgWidth, $imgHeight); //创建一个彩色的底图
		$user_image = imgcreatefromstyle($user_image);
		$dst_path = './sy.jpg';
		$dst = imagecreatefromstring(file_get_contents($dst_path));
		imagecopymerge($dst, $user_image, 30, 20, 0, 0, $imgWidth, $imgHeight, 100);
		
		//二维码
		$erwema_url = './erweima.png';
		$imgWidth_ewm  = '270';
   		$imgHeight_ewm = '270';
		list($ewm_w, $ewm_h) = getimagesize($erwema_url);
		$image_news_ewm      = imagecreatetruecolor($imgWidth_ewm, $imgHeight_ewm);
		$erwema_url          = imagecreatefrompng($erwema_url);
		imagecopyresized($image_news_ewm, $erwema_url, 0, 0, 0, 0,$imgWidth_ewm,$imgHeight_ewm,$ewm_w, $ewm_h);
		imagecopymerge($dst, $image_news_ewm, 100, 180, 0, 0, 270, 270, 100);//二维码
		//字体  姓名
		$font  = './images/msyh.ttf';//字体
		$red   = imagecolorallocate($dst, 255, 0, 0);//字体颜色
		$black = imagecolorallocate($dst, 0, 0, 0);//字体颜色
		imagefttext($dst, 20, 0,175, 55, $red,$font, '12313123123123123');
		imagepng($dst,'./3.png');

		// function resizejpg($imgsrc,$width,$height) 
		// { 
		// 	//$imgsrc jpg格式图像路径
		// 	//$imgdst jpg格式图像保存文件名
		// 	//$imgwidth要改变的宽度
		// 	//$imgheight要改变的高度

		// 	$arr = getimagesize($imgsrc);

		// 	$imgWidth  = $width;
		// 	$imgHeight = $height;
		// 	// Create image and define colors
		// 	$image  = imagecreatetruecolor($imgWidth, $imgHeight); //创建一个彩色的底图
		// 	if(strpos($arr['mime'],'png')){
		// 		$imgsrc = imagecreatefrompng($imgsrc); 
		// 		imagecopyresized($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]); 
		// 		// imagecreatefromstring(file_get_contents($image));
		// 		// imagepng($image);
		// 	}elseif(strpos($arr['mime'],'jpeg')){
		// 		$imgsrc = imagecreatefromjpeg($imgsrc); 
		// 		imagecopyresized($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]); 
		// 		// imagecreatefromstring(file_get_contents($image));
		// 		// imagejpeg($image);
		// 	}else{
		// 		$imgsrc = imagecreatefromgif($imgsrc); 
		// 		imagecopyresized($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]); 
		// 		// imagecreatefromstring(file_get_contents($image));
		// 		// imagegif($image);
		// 	}
		// 	return $image;
		// }
		// $result = resizejpg('./1.jpg','100','100');
		// print_r($result);die;