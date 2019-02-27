<?php
	class systemDb{
		function __construct($db,$user,$pwd,$link){
			$this->db = $db;
			$this->user = $user;
			$this->pwd = $pwd;
			$this->dlink = $link;
		}
		//连接数据库服务器
		function dblink(){
			$conn = mysql_connect($this->db,$this->user,$this->pwd,$this->dlink);
			mysql_query('set names utf8');
			if($conn){
				echo 'mysql server link success'; 
				$conn_db = mysql_select_db('wechatData',$conn);
				
				if($conn_db){ 
					echo 'mysql database link success';
				}
				else{
					echo 'mysql database link false';
				}
			}		
			else{
				echo 'mysql server link false';
			}
		}
	}
	
	$thedb = new systemDb('localhost','root','','link');
	$thedb->dblink();