<?php
	//获取加载对应的参数
	$theParameter = $_GET['parameter'];
	$turl = $_GET['turl'];
	if(!$theParameter){
		$theParameter = $_POST['parameter'];
	}
	if(!$turl){
		$turl = $_POST['turl'];
	}
	
	if($theParameter == 'login'){
		include_once('login.class.php');
		$thePart = new theLogin;
		$thePart-> theRuturn($turl);
	}
	
	