<?php
	include_once('dbconnect.php');

		if(!empty($_GET['pid'])){
			$catname = $_GET['catname'];
			$category = $_GET['cat'];
			$pid = $_GET['pid'];
			mysqli_query($conn, "delete from product where ID = '$pid' and Category_Id = '$category'") or die(mysqli_error($conn));
			header("Location: Product.php?catname=$catname&category=$category");
	}

	if(!empty($_GET['ptid'])){
			$ptid = $_GET['ptid'];
			mysqli_query($conn, "update transaction set ProductStatus_Id='4' where transaction_Id = ".$ptid."") or die(mysqli_error($conn));
			header("Location: delivery_service.php");
	}

	if(!empty($_GET['ptid1'])){
			$ptid1 = $_GET['ptid1'];
			mysqli_query($conn, "update transaction set ProductStatus_Id='4' where transaction_Id = ".$ptid1."") or die(mysqli_error($conn));
			header("Location: transaction.php");
	}
	
	if(!empty($_GET['brand_Id'])){
			$brand_Id = $_GET['brand_Id'];
			$category = $_GET['category'];
			$catname = $_GET['catname'];
			mysqli_query($conn, "delete from brand where brand_Id = ".$brand_Id."") or die(mysqli_error($conn));
			header("Location: Product.php?category=$category&catname=$catname");
	}
	
?>