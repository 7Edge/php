<?php
	include 'conn.inc.php';
	$eno=$_POST['jobNum'];
	$ename=$_POST['userName'];
	$sex=$_POST['sex'];
	//$dno=$_POST[''];
	//$jobno=$_POST[''];
	$dno=1;
	$jobno=2;
	$birthday=$_POST['birthday'];
	$hometown=$_POST['addr'];
	$hiredate=$_POST['startTime'];
	//$leadercode=$_POST[''];
	$leadercode=getLeaderCode($leadername);
	$leadername=$_POST['leaderName'];
	
	$sql="insert into employee(eno,ename,sex,dno,jobno,birthday,hometown,hiredate,leadercode) values($eno,$ename,$sex ,$dno,$jobno,str_to_date($birthday,'%Y%m%d'),$hometown,str_to_date($hiredate,'%Y%m%d'),$leadercode)";
	
	if(mysql_query($sql)){
		echo "提交成功！";
	}else{
		die("失败，错误：".mysql_error());
	}
	
	function getLeaderCode($name){
		$result=mysql_query("select ifnull((select eno from employee where ename=$leadername limit 1),'cd002')");
		if(!$result){
			echo "获取leadercod失败";
		}
		$arr=mysql_fetch_array($result);
		$code=$arr['eno'];
		return $code;	 
		}
	
?>