<?php 
	// {"state": true, "message": "更新成功!"}
	// {"state": false "message": "更新失敗!"}
	// {"state": false, "message" : "不允許空白欄位!"}
	// {"state": false, "message" : "欄位錯誤!"}

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["ID"]) && isset($dataArray["Username"]) && isset($dataArray["Password"]) && isset($dataArray["Email"])  && isset($dataArray["Level"])){
		if($dataArray["ID"] != "" && $dataArray["Username"] != "" && $dataArray["Password"] != "" && $dataArray["Email"] != "" && $dataArray["Level"] != ""){

			$u_id=$dataArray["ID"];
			$u_Username=$dataArray["Username"];
			$u_Password=$dataArray["Password"];
			$u_Email=$dataArray["Email"];
			$u_Level=$dataArray["Level"];


			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "UPDATE member_Car SET Username='$u_Username', Password='$u_Password', Email='$u_Email', Level='$u_Level' WHERE ID='$u_id'";

			if(excute_sql($link, "id18041126_friends", $sql)){
				echo '{"state": true, "message": "更新成功!"}';
			}else{
				echo '{"state": false, "message": "更新失敗!"}';
			}
			mysqli_close($link);
			}else{
				echo '{"state": false, "message" : "不允許空白欄位!"}';
			}		
	}else{
		echo '{"state": false, "message" : "欄位錯誤!"}';
	}
	
 ?>