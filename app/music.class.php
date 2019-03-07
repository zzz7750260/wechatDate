<?php 
	include('system.ini.php');
	define('thePath',dirname(dirname(__FILE__)));
	class theMusic{		
		//定义静态路径为	
		function addMusic(){
			//获取前端数据
			$theTitle = $_POST['title'];
			//$theFile = $_POST['file'];
			$xthePath = $_POST['afilePath'];
			
			$theFile = $_FILES['file']; 
			
			//组建前端数组
			$returnMusicArray = array(
				status => 11,
				msg => '数据获取成功',
				result =>$theFile,
				title => $theTitle,
				sthePath => $xthePath
			);
			
			$returnMusicJson = json_encode($returnMusicArray);
			
			print_r($returnMusicJson);
			
		}
		
		function theReturn($turl){		
			if($turl == 'addMusic'){
				$this->addMusic();
			}
			
		}
	}