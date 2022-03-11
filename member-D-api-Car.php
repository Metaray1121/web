<?php 
	// {"state": true, "message": "刪除成功!"}
	// {"state": false "message": "刪除失敗!"}
	// {"state": false, "message" : "不允許空白欄位!"}
	// {"state": false, "message" : "欄位錯誤!"}

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["ID"])){
		if($dataArray["ID"] != ""){

			$d_id=$dataArray["ID"];

			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "DELETE FROM member_Car WHERE ID='$d_id'";

			if(excute_sql($link, "id18041126_friends", $sql)){
				echo '{"state": true, "message": "刪除成功!"}';
			}else{
				echo '{"state": false, "message": "刪除失敗!"}';
			}
			mysqli_close($link);
			}else{
				echo '{"state": false, "message" : "不允許空白欄位!"}';
			}		
	}else{
		echo '{"state": false, "message" : "欄位錯誤!"}';
	}
	
 ?>