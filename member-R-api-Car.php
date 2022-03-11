<?php
	require_once("db-tool-Car.php");
	$link = create_connection();
	$sql = "SELECT * FROM member_Car";
	$result = excute_sql($link, "id18041126_friends", $sql);

	if(mysqli_num_rows($result)>0){
		$dataArray = array();
		while($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		echo '{"state": true, "data": '.json_encode($dataArray).'}';
	}else{
		echo '{"state": false , "message": "無資料!"]}';
	}
?>