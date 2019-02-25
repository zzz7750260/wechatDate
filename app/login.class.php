<?php
	class theLogin{	
		function checkLogin(){
			//获取token和user_token
			$theToken = $_GET['theToken'];
			$theUserToken = $_POST['theUserToken'];
			if($theUserToken == '10min'){
				//返回前端数组
				$loginArray = array(
					status => '1',
					msg => '登陆成功',
					result =>''
				);
				
			}
			else{
				$loginArray = array(
					status => '0',
					msg => '登陆失败',
					result =>''
				);				
			}
			
			//将数组转为json返回给前端
			$loginJson = json_encode($loginArray);
			print_r($loginJson);
			
		}
		function theRuturn($turl){
			if($turl == 'checkLogin'){
				$this->checkLogin();
			}
			
		}
	}
