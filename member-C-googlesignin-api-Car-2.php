<?php 
	//申請帳號時檢查使用者名稱(Username)是否已被使用 阻擋每次登入都新增
	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

			$Username = $dataArray["username"];
			$Email = $dataArray["email"];

			require_once("db-tool-Car.php");

			$link = create_connection();
			$sql = "SELECT * FROM member_Car WHERE Email = '$Email'";			
			$result = excute_sql($link , "id18041126_friends", $sql);
			
			if(mysqli_num_rows($result) == 0){ //如果還未加入會員則先創建會員資料並給uuid
				$Uuid = substr(md5(uniqid(mt_rand())), 10, 20);
				$link = create_connection();
				$sql = "INSERT INTO member_Car(Username, Password, Email, Uuid, Level) VALUES('$Username','','$Email', '$Uuid', '10')";

				if(excute_sql($link, "id18041126_friends", $sql)){
					echo '{"state": true, "uuid": "'.$Uuid.'", "message": "會員新增成功,請重新登入!"}';
				}else{
					echo '{"state": false, "message": "會員新增失敗"}';
				}					
			}else{
				$link = create_connection();
				$sql = "SELECT Uuid FROM member_Car WHERE Username = '$Username' AND Email = '$Email'";
				$result = excute_sql($link, "id18041126_friends", $sql);
				if(mysqli_num_rows($result) == ""){ //有會員資料但沒有uuid則給uuid
					$Uuid = substr(md5(uniqid(mt_rand())), 10, 20);
					$link = create_connection();
					$sql = "UPDATE member_Car SET Uuid = '$Uuid' WHERE Username = '$Username' AND Email = '$Email'";
					if(excute_sql($link, "id18041126_friends", $sql)){
						echo '{"state": false, "message": "已新增Uuid"}';
					}else{
						echo '{"state": false, "message": "新增Uuid失敗"}';
					}					
				}else{ //有會員資料也有uuid則直接回傳uuid
					$sql = "SELECT Uuid FROM member_Car WHERE Username = '$Username' AND Email = '$Email'";
					$result = excute_sql($link, "id18041126_friends", $sql);
						if(mysqli_num_rows($result)>0){
							$dataArray = array();
							while($row = mysqli_fetch_assoc($result)){
							$dataArray[] = $row;
					    	}
				    	}
					echo '{"state": false, "data":'.json_encode($dataArray).', "message": "登入成功!"}';
				}	
			}			
		
 ?>