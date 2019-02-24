<?php
	class theLogin{	
		function checkLogin(){
			//获取token和user_token
			$theToken = $_GET['theToken'];
			$theUserToken = $_POST['theUserToken'];
			if($theUserToken == '10min'){
				//返回前端数组
				$loginArray = array(
					status => '200',
					msg => ''
				)
				
			}
					
		}
		function theRuturn($turl){
			
			
		}
	}
