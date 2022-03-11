<?php 
// {"username":"123", "password":"XXX", "email":"owner@gmail.com", 
// "bday": "XXX", "tel":"XXX", "edu":"XXX", "interest":"XXXX","occupation":"XXX","mode":"XXX","disease":"XXX"}

// "{"state": true, "message": "新增成功!"}"
// "{"state": false "message": "新增失敗!"}"
// "{"state": false, "message" : "不允許空白欄位!"}"
// "{"state": false, "message" : "欄位錯誤!"}"

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["username"]) && isset($dataArray["password"]) && isset($dataArray["email"])){
		if($dataArray["username"] != "" && $dataArray["password"] != "" && $dataArray["email"] != ""){

			$Username = $dataArray["username"];
			$Password = $dataArray["password"];
			$Email = $dataArray["email"];
			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "INSERT INTO member_Car(Username, Password, Email, Uuid, Level) VALUES('$Username','$Password','$Email', '', '3')";

			if(excute_sql($link, "id18041126_friends", $sql)){
				echo '{"state": true, "message": "新增成功!"}';
			}else{
				echo '{"state": false, "message": "新增失敗!"}';
			}
			mysqli_close($link);
			}else{
				echo '{"state": false, "message" : "不允許空白欄位!"}';
			}		

	}else{
		echo '{"state": false, "message" : "欄位錯誤!"}';
	}

	

 ?>