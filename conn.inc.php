<?php
	$link=mysql_connect('127.0.0.1','root','qazwsx') or die("连接数据库失败：".mysql_error());
	$UseMyOA=mysql_select_db('myOA',$link) or die("USE myOA库失败：".mysql_error());