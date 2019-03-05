<?php 
include('system.ini.php');
class theDiary{
	function listDiary(){
		$theUserToken = $_GET['theUserToken'];
		if($theUserToken == '10min'){
			//获取所有的日记
			$diaryListSql = "select * from diary where 1 = 1";
			$diaryListSql_db = mysql_query($diaryListSql);
			if($diaryListSql_db){
				$diaryArray = array();
				while($diaryListSql_db_array = mysql_fetch_assoc($diaryListSql_db)){
					$diaryArray[] = $diaryListSql_db_array;
				}	
				//组建返回前端数组
				$returnDiaryArray = array(
					status => '1',
					msg => '日记返回成功',
					result => $diaryArray
				);
			}
			else{
				//组建返回前端数组
				$returnDiaryArray = array(
					status => '0',
					msg => '日记返回失败',
					result => ''
				);							
			}
			
			//将数组转为json
			$returnDiaryJson = json_encode($returnDiaryArray);
			print_r($returnDiaryJson);
		}
	}
	
	//添加日志
	function addDiary(){
		$theToken = $_POST['token'];
		$theTitle = $_POST['title'];
		$theText = $_POST['text'];
		$theStatus = $_POST['status'];
		$theDate = $_POST['date'];
		$theAuthor = $_POST['author'];
		
		if($theToken == '10min'){
			//插入数据库
			$addDiarySql = "insert into diary (title,container,date,author,public) values ('$theTitle','$theText','$theDate','$theAuthor','$theStatus')";
			$addDiarySql_db = mysql_query($addDiarySql);
			
			if($addDiarySql_db){
				//组装前端数组
				$returnDiaryArray = array(
					status => 1,
					msg => '日志添加成功',
					result => ''
				);
			}
			else{
				//组装前端数组
				$returnDiaryArray = array(
					status => 0,
					msg => '日志添加失败',
					result => ''
				);
			}
		}
		else{
			$returnDiaryArray = array(
				status => 3,
				msg => 'userToken不正确',
				result => ''
			);	
		}
		
		$returnDiaryJson = json_encode($returnDiaryArray);	
		print_r($returnDiaryJson);
	}
	
	//根据id获取日志
	function getDiary(){
		$theToken = $_GET['token'];
		$theId = $_GET['id'];
		if($theToken == '10min'){
			$getDiarySql = "select * from diary where did = '$theId'";
			$getDiarySql_db = mysql_query($getDiarySql);
			if($getDiarySql_db){
				$getDiarySql_db_array = mysql_fetch_assoc($getDiarySql_db);
				$returnDiaryArray = array(
					status => 1,
					msg => '成功返回日志内容',
					result => $getDiarySql_db_array
				);
			}
			else{
				$returnDiaryArray = array(
					status => 0,
					msg => '成功失败',
					result => ''
				);			
			}											
		}
		else{
			$returnDiaryArray = array(
				status => 2,
				msg => 'token不正确',
				result => ''
			);	
		}
		
		$returnDiaryJson = json_encode($returnDiaryArray);
		
		print_r($returnDiaryJson);
	}
	
	//删除对应的日志信息
	function delArticle(){
		$theId = $_GET['id'];
		$theToken = $_GET['token'];
		if($theToken == '10min'){
			$delDiarySql = "delete from diary where did = '$theId'";
			$delDiarySql_db = mysql_query($delDiarySql);
			if($delDiarySql_db){
				$returnDiaryArray = array(
					status => 1,
					msg => '日志删除成功',
					result => ''
				);
			}
			else{
				$returnDiaryArray = array(
					status => 0,
					msg => '日志删除失败',
					result => ''
				);
			}
		}
		else{
			$returnDiaryArray = array(
				status => 2,
				msg => 'token不正确',
				result => ''
			);
		}
		$returnDiaryJson = json_encode($returnDiaryArray);
		
		print_r($returnDiaryJson);
	}
	
	function theReturn($turl){
		if($turl == 'listDiary'){
			$this->listDiary();
		}	
		if($turl == 'addDiary'){
			$this->addDiary();	
		}
		if($turl == 'getDiary'){
			$this->getDiary();	
		}
		if($turl == 'delArticle'){
			$this->delArticle();
		}	
	}
}
