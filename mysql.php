<?php
	$link_db=mysql_connect('127.0.0.1','root','qazwsx');
	if(!$link_db){
		exit("连接失败！错误：".mysql_error());
	}
	
	echo "连接数据库成功！<br>";
	echo mysql_get_client_info()."<br>";
	echo mysql_get_host_info($link_db)."<br>";
	echo mysql_get_proto_info()."<br>";
	echo mysql_get_server_info()."<br>";
	echo mysql_client_encoding()."<br>";
	echo mysql_stat()."<br>";
	
	mysql_close($link_db);
	
?>
