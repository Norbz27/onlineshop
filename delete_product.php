<?php
	include_once('dbconnect.php');

		if(!empty($_GET['pid'])){
			$pid = $_GET['pid'];
			mysqli_query($conn, "delete from cart where ID = '$pid'") or die(mysqli_error($conn));
			header("Location: cart.php");
	}

	if(!empty($_GET['ptid2'])){
			$ptid2 = $_GET['ptid2'];
			mysqli_query($conn, "update transaction set ProductStatus_Id='4' where transaction_Id = ".$ptid2."") or die(mysqli_error($conn));
			header("Location: my_purchase.php");
	}
?>