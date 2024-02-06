<?php
	include_once('dbconnect.php');

	if(!empty($_GET['uid'])){
		mysqli_query($conn, "delete from user_account where User_ID = '$_GET[uid]'") or die(mysqli_error($conn));
		header("Location: user_accounts.php");
	}
	if(!empty($_GET['did'])){
		mysqli_query($conn, "delete from delivery_service where delivery_Id = '$_GET[did]'") or die(mysqli_error($conn));
		header("Location: delivery_accounts.php");
	}
?>