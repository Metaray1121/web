<?php 
	
	$Uuid = substr(md5(uniqid(mt_rand())), 10, 20);

	echo '{"state": true, "uuid": "'.$Uuid.'", "message": "登入成功!"}'; //uuid要echo給前端
	

 ?>