<?php
	class theLogin{	
		function checkLogin(){
			//获取token和user_token
			$theToken = $_GET['theToken'];
			$theUserToken = $_GET['theUserToken'];
			if(!$theToken){
				$theToken = $_POST['theToken'];
			}
			if(!$theUserToken){
				$theUserToken = $_POST['theUserToken'];	
			}
			
			//获取提交过来的用户信息
			$theUserName = $_POST['username'];
			$thePassword = $_POST['password'];
			
			if($theUserToken == '10mins'){
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
			echo $theUserToken;
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
