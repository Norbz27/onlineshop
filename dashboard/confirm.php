<?php
	include_once('dbconnect.php');

	if(!empty($_GET['ptid'])){
			$ptid = $_GET['ptid'];
			mysqli_query($conn, "update transaction set ProductStatus_Id='2' where transaction_Id = ".$ptid."") or die(mysqli_error($conn));
			header("Location: transaction.php");
	}
	if(!empty($_GET['del'])){
			$ptid = $_GET['del'];
			$quan = $_GET['quan'];
			$catid = $_GET['catid'];
			$pid = $_GET['pid'];
			$stock = $_GET['stock'];
			$stock2 = $stock - $quan;
			mysqli_query($conn, "update transaction set ProductStatus_Id='3' where transaction_Id = ".$ptid."") or die(mysqli_error($conn));
			mysqli_query($conn, "update product set Stock='".$stock2."' where Category_Id = ".$catid." and ID = ".$pid."") or die(mysqli_error($conn));
			header("Location: delivery_service.php");
	}
?>