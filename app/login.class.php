<?php
	//引入数据库连接
	include('system.ini.php');
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
			
			
			//echo $theUserName;
			//检测是否正确使用token
			if($theUserToken == '10min'){
				//检测是否是根据缓存登陆，如果存在$theToken,为缓存登陆检测，否则为账号登陆
				if(!$theToken){
					$selectUserSql = "select * from user where username = '$theUserName' and password = '$thePassword'";
					$selectUserSql_db = mysql_query($selectUserSql);
					$selectUserSql_db_num = mysql_num_rows($selectUserSql_db);
					
					if($selectUserSql_db_num>0){
						$selectUserSql_db_info = mysql_fetch_assoc($selectUserSql_db);
						//组建前端数组
						//返回前端数组
						$loginArray = array(
							status => '1',
							msg => '登陆成功',
							result =>$selectUserSql_db_info,
						);							
						
					}
					else{
						$loginArray = array(
							status => '6',
							msg => '账户不存在',
							result =>$selectUserSql_db_info,
						);							
						
					}
				}
				else{
					//根据token判断进自动登陆
					$tokenSql = "select * from user where token = '$theToken' and username = '$theUserName'";
					$tokenSql_db = mysql_query($tokenSql);
					$tokenSql_db_num = mysql_num_rows($tokenSql_db);
					if($tokenSql_db_num>0){
						$selectUserSql_db_info = mysql_fetch_assoc($tokenSql_db);
						
						$loginArray = array(
							status => '2',
							msg => '自动登陆成功',
							result =>$selectUserSql_db_info,
						);								
					}
					else{
						$loginArray = array(
							status => '5',
							msg => '自动登陆失败',
							result =>$selectUserSql_db_info,
						);								
					}
				}
				
		
			}
			else{
				$loginArray = array(
					status => '0',
					msg => '登陆失败',
					result =>''
				);				
			}
			//echo $theUserToken;
			//将数组转为json返回给前端
			$loginJson = json_encode($loginArray);
			print_r($loginJson);
			
		}
		
		//注册
		
		function theRuturn($turl){
			if($turl == 'checkLogin'){
				$this->checkLogin();
			}
			
		}
	}
