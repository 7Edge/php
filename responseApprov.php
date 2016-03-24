<?php
	session_start();
	include 'conn.inc.php';
	$eno=$_SESSION['eno'];
	
	
	$vcaSql="call myOA.pr_getMy_check('$eno')";		//待审批年假
	$vcaQuery=mysql_query($vcaSql); 
	$vcaNum=mysql_num_rows($vcaQuery);
	$i=0;
	do{
		$vcaArray=mysql_fetch_assoc($vcaQuery);
		$vcaArray['auto_check_no']="1".$vcaArray['auto_check_no'];
		//echo $vcaArray['auto_check_no']."<br><br>";
		$vcaLogArray[$i]=array('serialNum'=>$vcaArray['auto_check_no'],'jobNum'=>$vcaArray['empno'],'varName'=>$vcaArray['ename'],'vacationType'=>$vcaArray['vname'],'starTime'=>$vcaArray['request_s_time'],'vacationDate'=>$vcaArray['leave_time'],'vacationReason'=>$vcaArray['description']);
		$i++;
	}while($i<$vcaNum);
	mysql_close($link);
	
	
	include 'conn.inc.php';
	$extSql="call myOA.pr_getMy_extwork_check('$eno')";		//待审批加班
	$extQuery=mysql_query($extSql);
	$extNum=mysql_num_rows($extQuery);
	$j=0;
	do{
		$extArray=mysql_fetch_assoc($extQuery);
		$extArray['auto_check_no']="2".$extArray['auto_check_no'];
		//echo $extArray['auto_check_no']."<br>";
		$extLogArray[$j]=array('serialNum'=>$extArray['auto_check_no'],'jobNum'=>$extArray['empno'],'varName'=>$extArray['ename'],'overtimeStart'=>$extArray['extwork_s_time'],'overtimeDate'=>$extArray['dur_time'],'resType'=>$extArray['ext_choice'],'marks'=>$extArray['extwork_description']);
		$j++;		
	}while($j<$extNum);
	//echo var_dump($extLogArray)
	;
	$responArray['allVacationLen']=$vcaNum;	//change not be from responTipsNum 
	$responArray['allOvertimeLen']=$extNum;
	$responArray['vacationlog']=$vcaLogArray;
	$responArray['overtimeLog']=$extLogArray;
	echo json_encode($responArray,JSON_UNESCAPED_UNICODE);
	
	mysql_close($link);