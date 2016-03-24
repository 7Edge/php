<?php
	include 'conn.inc.php';
	$insert="insert into employee(eno,ename,sex,dno,jobno,birthday,hometown,hiredate,leadercode) values('cd346','张家琦','男',1,2,str_to_date('1990-12-04','%Y-%m-%d'),'四川省成都市',str_to_date('2013-07-01','%Y-%m-%d'),'cd100')";
	
	$result=mysql_query($insert);
	if ($result && mysql_affected_rows()>0){
		echo "数据插入成功，最后一条插入数据记录ID：".mysql_insert_id()."<br>";
	}else{
		echo "插入失败：".mysql_errno().",原因".mysql_error()."<br>";
	}
	
	mysql_close($link);
	
?>