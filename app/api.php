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
	//echo $theParameter;
	if($theParameter == 'login'){
		include_once('login.class.php');
		$thePart = new theLogin;
		$thePart-> theRuturn($turl);
	}
	if($theParameter == 'diary'){
		include_once('diary.class.php');
		$thePart = new theDiary;
		$thePart-> theReturn($turl);
	}
	if($theParameter == 'music'){
		include_once('music.class.php');
		$thePart = new theMusic;
		$thePart-> theReturn($turl);
	}
	