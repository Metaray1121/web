<?php 
	function create_connection(){
		$link = mysqli_connect("localhost", "id18041126_tcnr12", "MetaRay1121@") or die("error".mysqli_connect_error());
		return $link;
	}

	function excute_sql($link, $dbname, $sql){
		mysqli_select_db($link, $dbname) or die("連線資料庫失敗".mysqli_error($link));
		$result = mysqli_query($link, $sql);
		return $result;
	}
 ?>