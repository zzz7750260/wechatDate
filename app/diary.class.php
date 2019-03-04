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
	
	function theReturn($turl){
		if($turl == 'listDiary'){
			$this->listDiary();
		}	
	}
}
