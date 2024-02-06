<?php
	$conn = new mysqli("localhost","root","","db_online_shopping");
	if($conn ->connect_error){
		echo 'Failed to connect to MYSQL';
	}
?>