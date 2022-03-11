<?php 
	
	//檢查uuid是否有一樣的,如果有則直接登入

	//{"uuid":"XX"}
	// {"state": true, "message": "帳號已登入!"}
	// {"state": false, "message": "帳號未登入!"}
	// {"state": false, "message" : "不允許空白欄位!"}
	// {"state": false, "message" : "欄位錯誤!"}

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["uuid"])){
		if($dataArray["uuid"] != ""){

			$chech_uuid_username = $dataArray["uuid"];
			
			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "SELECT * FROM member_Car WHERE Uuid = '$chech_uuid_username'";
			$result = excute_sql($link , "id18041126_friends", $sql);

			if(mysqli_num_rows($result) == 1){
				
				$u_dataArray = array();
				while($row = mysqli_fetch_assoc($result)){
					$u_dataArray[] = $row;
				}

				echo '{"state": true, "data": '.json_encode($u_dataArray).', "message": "帳號已登入!"}';				
			}else{
				echo '{"state": false, "message": "帳號未登入!"}';
			}
			mysqli_close($link);
		}else{
			echo '{"state": false, "message" : "不允許空白欄位!"}';
		}		
	}else{
		echo '{"state": false, "message" : "欄位錯誤!"}';
	}

 ?>