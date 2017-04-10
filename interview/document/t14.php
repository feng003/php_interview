<?php
	//两数组第k个值
	//两个有序数组A和B，分别拥有m和n的长度，求其合并后的第k个值

		function findMedianSortedArrays(&$arrA,&$arrB){
		if(count($arrA)==0||count($arrB)==0){
			return 0;
		}
		$m=count($arrA);
		$n=count($arrB);
		$k=intval(($n+$m-1)/2)+1;
		return findKthSortedArrays($arrA,$arrB,$k);
	}

		$a=array(1,3,5,7,9);
	$b=array(2,4,6,8);
	echo findKthSortedArrays($a,$b,5);

	function findKthSortedArrays(&$arrA,&$arrB,$k){
		$m=count($arrA);
		$n=count($arrB);
		if($m>$n){
			return findKthSortedArrays($arrB,$arrA,$k);
		}
		$left=0;
		$right=$m;
		while ($left<$right) {
			$mid=$left+intval(($right-$left)/2);
			$j=$k-1-$mid;
			if($j>=$n||$arrA[$mid]<$arrB[$j]){
				$left=$mid+1;
			}else{
				$right=$mid;
			}
		}
		$Aiminusl=$left-1>=0?$arrA[$left-1]:-100;
		$Bj=$k-1-$left>=0?$arrB[$k-1-$left]:-100;
		$valk = max($Aiminusl,$Bj);
		if (($n+$m)%2==1) {
			return $valk;
		}
		$Bjplus1=$k-$left>=$n?100:$arrB[$k-$left];
		$Ai=$left>=$m?100:$arrA[$left];
		return ($valk+min($Bjplus1,$Ai))/2;
	}

	$a=array(1,2,3);
	$b=array(7,8,9,10);
	echo findMedianSortedArrays($a,$b);



		class Person{
		private $name;
		private $sex;

		function __construct($name,$sex)
		{
			$this->name=$name;
			$this->sex=$sex;
		}

		public function __get($name){
			return $this->$name;
		}
	}

	$p=new Person('hello','haha');
	echo $p->name;
	echo $p->sex;

