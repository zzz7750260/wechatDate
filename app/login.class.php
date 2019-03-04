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
						
						//获取token检测是否过期，如果过期就进行更新
						if($this->checkToken($selectUserSql_db_info['token'],$theUserName)){
							//如果没过期就直接返回
							$loginArray = array(
								status => '1',
								msg => '登陆成功',
								result =>$selectUserSql_db_info,
							);															
						}
						else{
							//如果过期了就对token进行更新
							$newToken = base64_encode(time() . md5($theUserName));
							$updataTokenSql = "update user set token = '$newToken' where username = '$theUserName'";
							$updataTokenSql_db = mysql_query($updataTokenSql);
							if($updataTokenSql_db){
								$loginArray = array(
									status => '8',
									msg => 'token更新成功，登陆成功',
									result =>$selectUserSql_db_info,
								);	
							}
							else{
								$loginArray = array(
									status => '9',
									msg => 'token更新失败，登陆失败',
									result =>'',
								);																	
							}
						}
																	
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
						//判断token是否失效,没失效时，返回登陆成功
						//echo $this->checkToken($theToken,$theUserName);
						if($this->checkToken($theToken,$theUserName)){
							$selectUserSql_db_info = mysql_fetch_assoc($tokenSql_db);	
							
							$loginArray = array(
								status => '2',
								msg => '自动登陆成功',
								result =>$selectUserSql_db_info,
							);	
							
							//echo "自动登陆成功";
							
						}
						//失效时返回已经失效
						else{
							
							$loginArray = array(
								status => '6',
								msg => 'token已经失效',
								result =>'',
							);		
							//echo "token已经失效";
						}																		
					}
					else{
						$loginArray = array(
							status => '5',
							msg => '自动登陆失败',
							result => '自动登陆失败',
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
		
		//用户注册
		function userRegister(){
			//获取传递过来的信息
			$theUserName = $_POST['username'];
			$thePassword = $_POST['password'];
			//$theToken = $_POST['theToken'];
			$theUserToken = $_POST['teUserToken'];
			if($theUserToken == '10min'){
				//检测用户名是否存在
				$checkUserSql = "select * from user where username = '$theUserName'";
				$checkUserSql_db = mysql_query($checkUserSql);
				$checkUserSql_db_num = mysql_num_rows($checkUserSql_db);
				if($checkUserSql_db_num>1){
					//组装前端数据
					$registerArray = array(
						status => 4,
						msg => '用户已经存在',
						result => ''
					);
				}
				else{
					//生成时间
					$theTime = date('Y-m-d H:i:s');
					//$theToken = time() . $theUserName;	
					$theToken = base64_encode(time() . md5($theUserName));
					//echo $theToken;
					$addUserSql = "insert into user(username,password,token,time) values ('$theUserName','$thePassword','$theToken','$theTime')";
					$addUserSql_db = mysql_query($addUserSql);
					if($addUserSql_db){
						//组装前端数据
						$registerArray = array(
							status => 1,
							msg => '用户插入成功',
							result => ''
						);
					}
					else{
						$registerArray = array(
						status => 2,
						msg => '用户插入失败',
						result => ''
						);
					}
				}
				
			}
			else{
				$registerArray = array(
					status => 0,
					msg => '登陆失败',
					result => ''
				);
			}
			
			//将数组转为json返回给前端
			$registerJson = json_encode($registerArray);
			print_r($registerJson);
		}
		
		//检查token是否过期(7天为过期时效)
		function checkToken($theToken,$username){
			//将token进行解码
			$returnFlag; //返回标识
			$token_decode = base64_decode($theToken);
			
			//echo $token_decode;
			if($token_decode && $username){
				//提取token中的time
				$theTime = substr($token_decode,0,(mb_strlen($token_decode)-mb_strlen(md5($username))));
				//判断time是否超时
				//echo "显示时间: $theTime";
				
				if((int)$theTime + 604800 > time()){
					//当前时间小于加上七天的秒数，说明没超时
					$returnFlag = true;
				}
				else{
					$returnFlag = false;
				}
			}
			else{
				$returnFlag = false;	
			}
			return $returnFlag;
		}
		
		function theRuturn($turl){
			if($turl == 'checkLogin'){
				$this->checkLogin();
			}
			if($turl == 'userRegister'){
				$this->userRegister();
			}
			
		}
	}
