<?php 
	

	$data = file_get_contents("php://input", "r");
	$dataArray = array();
	$dataArray = json_decode($data, true);

	if(isset($dataArray["ID"]) && isset($dataArray["Password"])){
		if($dataArray["ID"] != "" && $dataArray["Password"] != ""){

			$u_id=$dataArray["ID"];
			$u_Password=$dataArray["Password"];

			require_once("db-tool-Car.php");
			$link = create_connection();
			$sql = "UPDATE member_Car SET Password='$u_Password' WHERE ID='$u_id'";

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