<?php 
	//登入,透過檢查Username/Password是否有一樣的組合,成功登入後增設一組Uuid
	//input:  {"username":"XX", "password":"XXX"}
	// {"state": true, "message": "登入成功!"}
	// {"state": false "message": "登入失敗!"}
	// {"state": false, "message" : "不允許空白欄位!"}
	// {"state": false, "message" : "欄位錯誤!"}
	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);
	if(isset($dataArray["username"]) && isset($dataArray["password"])){
		if($dataArray["username"] != "" && $dataArray["password"] != ""){
			$l_username = $dataArray["username"];
			$l_password = $dataArray["password"];
			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "SELECT * FROM member_Car WHERE Username = '$l_username' AND Password = '$l_password'";
			$result = excute_sql($link, "id18041126_friends", $sql);
			if(mysqli_num_rows($result) == 1){
				$Uuid = substr(md5(uniqid(mt_rand())), 10, 20);
				require_once("db-tool-Car.php");
				$link = create_connection();
				$sql = "UPDATE member_Car SET Uuid = '$Uuid' WHERE Username = '$l_username'";
				if(excute_sql($link, "id18041126_friends", $sql)){
					$sql = "SELECT Level FROM member_Car WHERE Username = '$l_username' AND Password = '$l_password'";
					$result = excute_sql($link, "id18041126_friends", $sql);
						if(mysqli_num_rows($result)>0){
							$dataArray = array();
							while($row = mysqli_fetch_assoc($result)){
							$dataArray[] = $row;
					    	}
				    	}
					echo '{"state": true, "uuid": "'.$Uuid.'", "data":'.json_encode($dataArray).', "message": "登入成功!"}'; //uuid要echo給前端
				}else{
					echo '{"state": false, "message": "Uuid新增失敗!"}';
				}
				//echo '{"state": true, "message": "帳號登入成功!"}';
			}else{
				echo '{"state": false, "message": "登入失敗!"}';
			}
		}else{
			echo '{"state": false, "message" : "欄位錯誤!"}';
		}
	}else{
		echo '{"state": false, "message" : "不允許空白欄位!"}';
	}
 ?>