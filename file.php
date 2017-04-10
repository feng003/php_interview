<?php
	$path = realpath('.'); 
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST); 
	foreach ($objects as $name => $object) { 
		if($objects->isFile() && $objects->getExtension()=='php')
		{
			echo $name."<br>";
		}
	}
?>