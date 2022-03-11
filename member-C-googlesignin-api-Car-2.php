<?php 
	//申請帳號時檢查使用者名稱(Username)是否已被使用
	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

			$Username = $dataArray["username"];
			$Email = $dataArray["email"];

			require_once("db-tool-Car.php");

			$link = create_connection();
			$sql = "SELECT * FROM member_Car WHERE Email = '$Email'";			
			$result = excute_sql($link , "id18041126_friends", $sql);
			if(mysqli_num_rows($result) == 0){

				$link = create_connection();
				$sql = "INSERT INTO member_Car(Username, Password, Email, Uuid, Level) VALUES('$Username','','$Email', '', '10')";

				excute_sql($link, "id18041126_friends", $sql);

				echo '{"state": true, "message": "新增成功"}';
			}else{
				
				echo '{"state": false, "message": "已經加入會員"}';	
			}
		
 ?>