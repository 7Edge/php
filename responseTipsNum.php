<?php
	$accept=$_POST['getTips'];
	if(isset($accept)){
		if($accept=='true'){
			$tipsArray['tipsNum']='10';
			$tipsNumJson=json_encode($tipsArray);
			echo $tipsNumJson;
			
		}else{
			exit();
		}
	}else{
		exit();
	}
