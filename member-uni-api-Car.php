<?php 
	
	//申請帳號時檢查使用者名稱(Username)是否已被使用

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["username"])){
		if($dataArray["username"] != ""){

			$chech_uni_username = $dataArray["username"];
			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "SELECT * FROM member_Car WHERE Username = '$chech_uni_username'";
			$result = excute_sql($link , "id18041126_friends", $sql);

			if(mysqli_num_rows($result) == 1){
				echo '{"state": false, "message": "此帳號已被使用,請重新設定!"}';				
			}else{
				echo '{"state": true, "message": "此帳號可以使用!"}';
			}
		}else{
			echo '{"state": false, "message" : "不允許空白欄位!"}';
		}		
	}else{
		echo '{"state": false, "message" : "欄位錯誤!"}';
	}

 ?>