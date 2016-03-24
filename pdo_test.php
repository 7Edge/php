<?php
	$opt=array(PDO::ATTR_PERSISTENT=>TRUE,PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING);
	try{
		$Pdo=new PDO("mysql:host=127.0.0.1;port=3306;dbname=myOA",'root','qazwsx',$opt);
		//$Pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "数据连接失败，失败原因：".$e->getMessage();
		exit;
	}
	
	echo 	"持续持久连接数据库".$Pdo->getAttribute(PDO::ATTR_PERSISTENT)."<br>";
	echo 	"是否关闭自动提交".$Pdo->getAttribute(PDO::ATTR_AUTOCOMMIT)."<br>";
	echo 	"错误处理模式".$Pdo->getAttribute(PDO::ATTR_ERRMODE)."<br>";
	echo 	"与连接状态相关特有信息".$Pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS)."<br>";
	echo 	"空字符串转换为sql的null".$Pdo->getAttribute(PDO::ATTR_ORACLE_NULLS)."<br>";
	echo 	"数据库服务器信息".$Pdo->getAttribute(PDO::ATTR_SERVER_INFO)."<br>";
	echo 	"数据库服务器版本信息".$Pdo->getAttribute(PDO::ATTR_SERVER_VERSION)."<br>";
	echo 	"数据库客户端版本信息".$Pdo->getAttribute(PDO::ATTR_CLIENT_VERSION)."<br>";
	echo 	"表字段字符大小写转换".$Pdo->getAttribute(PDO::ATTR_CASE)."<br>";
	
