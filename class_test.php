<?php
	class MyClass{
		 var $vars=10;
		
		 function sayHello(){
			echo "hello world";
		}
	}
	
	class MyClass2 extends MyClass{
		function useFatherPrivate(){
			echo "继承过来的属性是：".$this->vars;
			$this->sayHello();
		}
	}
	
	$Test=new MyClass2();
	$Test->useFatherPrivate();