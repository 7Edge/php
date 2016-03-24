<?php
	session_start();
	$link=mysql_connect('127.0.0.1','root','qazwsx');
	mysql_select_db('myOA',$link);
	$eno=$_SESSION['eno'];
	$resultArray['jobNum']=$_SESSION['eno'];	//结果数组
	//$resultArray['allVacationLength']=6;
	//$resultArray['vacationType']=
	$sex=get_sex($eno);
	
	$nianjiasql="select '年假' as name,total_vacation as allDate,(total_vacation-left_vacation) as useDate,left_vacation as freeDate,' ' as comments from myOA.emp_vacation where period='2016' and empno='$eno'";
	$queryResult=mysql_query($nianjiasql);
	$vacationArray=mysql_fetch_array($queryResult,MYSQL_ASSOC);
	$responArray[0]=$vacationArray;
	
	if($sex=='man'){
		$chanjiaSql="SELECT 
    '陪产假' AS name,
    b.topcnt AS allDate,
    (b.topcnt - left_chanjia) AS useDate,
    left_chanjia AS freeDate,
	' ' as comments
FROM
    myOA.emp_vacation a,
    vacation_type b
WHERE
    b.vname = '陪产假' AND a.period = '2016'
        AND a.empno = '$eno'";
		$chanjiaR=mysql_query($chanjiaSql);
		$chanjiaArray=mysql_fetch_array($chanjiaR,MYSQL_ASSOC);
	}elseif($sex=='woman'){
		$chanjiaSql="SELECT 
    '产假' AS name,
    b.topcnt AS allDate,
    (b.topcnt - left_chanjia) AS useDate,
    left_chanjia AS freeDate,
	' ' as comments
FROM
    myOA.emp_vacation a,
    vacation_type b
WHERE
    b.vname = '产假' AND a.period = '2016'
        AND a.empno = '$eno'";
		$chanjiaR=mysql_query($chanjiaSql);
		$chanjiaArray=mysql_fetch_array($chanjiaR,MYSQL_ASSOC);
	}
	$responArray[1]=$chanjiaArray;
	
	$typeArray=array('事假'=>'left_rest','病假'=>'left_bingjia','婚假'=>'left_hunjia','丧假'=>'left_sangjia',);
	foreach($typeArray as $key=>$value){
		$sql="SELECT 
    '$key' AS name,
    b.topcnt AS allDate,
    (b.topcnt - '$value') AS useDate,
    '$value' AS freeDate,
	' ' as comments
FROM
    myOA.emp_vacation a,
    vacation_type b
WHERE
    b.vname = '$key' AND a.period = '2016'
        AND a.empno = '$eno'";
		$sqlReult=mysql_query($sql);
		$sqlArray=mysql_fetch_array($sqlReult);
		$i=count($responArray);
		$responArray[$i]=$sqlArray;
	}
	
	$resultArray['vacationType']=$responArray;
	$resultArray['allVacationLength']=count($responArray);
	
	echo json_encode($resultArray);
	/*foreach($vacationArray as $segment=>$value){
		$i=0;
		while($segment){
			case 'total_vacation':  
				$vacationType[$i]=array("name"=>"年假","allDate")
		}
	}
	*/
	
	function get_sex($workNum){					//获取性别，无结果或者错误数据返invalidsex
		$sexSql="select sex from myOA.employee where empno='$workNum'";
		$sexReslt=mysql_query($sexSql);
		$arrayReslt=mysql_fetch_array($sexReslt);
		if($arrayReslt[0]=='男'){
			return 'man';
		}elseif($arrayReslt[0]=='女'){
			return 'woman';
		}else{
			return 'invalidsex';
		}
	}
	
	mysql_close($link);
	//$vacationType[0]=array()