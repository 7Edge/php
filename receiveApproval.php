<?php
	session_start();
	include 'conn.inc.php';
	
	$eno=$_SESSION['eno'];
	$approve=str2int($_POST['approve']);
	//echo $approve;
	$receiveStr=$_POST['valueList'];
	//echo $receiveStr;
	$valueArray=explode(',',$receiveStr);
	//echo substr($valueArray[0],1,(3-1));
	//$vcaSql="call myOA.pr_check_vacation('$checkNum','$eno',{$approve},@excu_result)";
	//echo $vcaSql;

	foreach($valueArray as $value){
		$firstChar=substr($value,0,1);	//1是加班2是年假
		$valueLen=strlen($value);
		$checkNum=substr($value,1,($valueLen-1));
		
		if($firstChar=='1'){
			$vcaSql="call myOA.pr_check_vacation('$checkNum','$eno',{$approve},@p_out_status)";
			mysql_query($vcaSql);
			$vcaResult=mysql_query("select @p_out_status");
			$resultArray=mysql_fetch_array($vcaResult);
			$resultAllArray[$value]=$resultArray[0];
			//echo mysql_error()."<br><br>";
		}elseif($firstChar=='2'){
			$extSql="call myOA.pr_check_extwork('$checkNum','$eno',{$approve},@p_out_status)";
			mysql_query($extSql);
			$extResult=mysql_query("select @p_out_status");
			$resultArray=mysql_fetch_array($extResult);
			$resultAllArray[$value]=$resultArray[0];
			//echo mysql_error()."<br><br>";
		}
	}
	
	//echo var_dump($resultAllArray);
	echo json_encode(1);
	
	function str2int($trueOrFalse){
		if($trueOrFalse=='true'){
			return 1;
		}elseif($trueOrFalse=='false'){
			return -1;
		}
	}
	
	
	mysql_close($link);
	 