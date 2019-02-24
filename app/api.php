<?php
	//获取加载对应的参数
	$theParameter = $_GET['parameter'];
	if(!$theParameter){
		$theParameter = $_POST['parameter'];
	}
	
	