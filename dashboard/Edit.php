<?php  
    
 if(isset($_POST["user_id"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");
      $query = "SELECT * FROM user_account WHERE User_ID = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);

 }  
  if(isset($_POST["del_id"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");
      $query = "SELECT * FROM delivery_service WHERE delivery_Id = '".$_POST["del_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);

 }  
  if(isset($_POST["product_id"]))  
 {  
 	  $catname = $_POST["catname"];
  	  $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");
      $query = "SELECT * FROM product inner join brand on product.brand_Id = brand.brand_Id inner join category on product.Category_Id = category.Category_Id WHERE ID = '".$_POST["product_id"]."'"; 
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);

 }  
 


 ?>