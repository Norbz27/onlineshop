<?php  
 if(isset($_POST["user_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");  
      $query = "SELECT * FROM user_account WHERE User_ID = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>   
                    <center>
                    <img src="img/'.$row["Profile_img"].'" width="100px" height="100px" class="img-profile rounded-circle mb-4">
                    </center>
                </tr>
                <tr>  
                     <td style="border:none;" width="30%"><label>Name:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Name"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Email:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Email"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Address:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Address"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Phone Number:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Phone_number"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Gender:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Gender"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Age:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Age"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Birthdate:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Birthdate"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;padding-top:50px;" width="30%"><label>Username:</label></td>  
                     <td style="border:none;padding-top:50px;" width="50%">'.$row["Username"].'</td>  
                </tr>
                <tr>  
                     <td style="border:none;" width="30%"><label>Password:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Password"].'</td>  
                </tr>
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }

  if(isset($_POST["del_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");  
      $query = "SELECT * FROM delivery_service WHERE delivery_Id = '".$_POST["del_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>   
                    <center>
                    <img src="img/'.$row["Profile_img"].'" width="100px" height="100px" class="img-profile rounded-circle mb-4">
                    </center>
                </tr>
                <tr>  
                     <td style="border:none;" width="30%"><label>Name:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Name"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Email:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Email"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Address:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Address"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;" width="30%"><label>Phone Number:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Phone"].'</td>  
                </tr>  
                <tr>  
                     <td style="border:none;padding-top:50px;" width="30%"><label>Username:</label></td>  
                     <td style="border:none;padding-top:50px;" width="50%">'.$row["Username"].'</td>  
                </tr>
                <tr>  
                     <td style="border:none;" width="30%"><label>Password:</label></td>  
                     <td style="border:none;" width="50%">'.$row["Password"].'</td>  
                </tr>
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }

 if(isset($_POST["product_id"]))  
 {  
      $catname = $_POST["catname"];
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");  
      $query = "SELECT * FROM product inner join brand on product.brand_Id = brand.brand_Id inner join category on product.Category_Id = category.Category_Id WHERE ID = '".$_POST["product_id"]."'";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  <div class="row">
                  <div class="col-6 ml-5">
                    <img src="img/'.$row["Img"].'" width="240px" height="240px" class="img-profilemb-4">
                  </div>
                  <div class="col" style="font-size:20px; margin-top:30px;">
                    <label class="mr-5" style="font-size:25px;">Name:</label>
                    <span class="ml-1" style="font-weight:bold; font-size:25px;">'.$row["Name"].'</span><br/>
                    <label class="mr-4">Price:</label>
                    <span class="ml-5">'.$row["Price"].'</span><br/>
                    <label class="mr-5">Brand:</label>
                    <span class="ml-3">'.$row["Brand"].'</span><br/>
                    <label class="mr-5">Stock:</label>
                    <span class="ml-3">'.$row["Stock"].'</span><br/>
                    <label class="mr-4">Category:</label>
                    <span class="ml-2">'.$row["Category_Name"].'</span><br/>
                  </div><br/>
                  </div>
                  <center><input type="button" id="btndes" class="btn btn-info mb-2 rounded-circle" value="&plus;"><input type="button" id="btndes1" class="btn btn-info mb-2 rounded-circle" value="&minus;"></center>
                  <div class="mx-5" id="des">
                    <center><h5>Description</h5></center>
                    <div class="pt-2 pl-3" style="border: 1px solid; border-radius: 6px;">
                      <pre class="text-secondary">'.$row["Description"].'</pre>
                    </div>
                  </div>
                ';  
      }    
      echo $output;  
 }

  if(isset($_POST["brand_id"]))  
 {  
    $output = '';
      $connect = mysqli_connect("localhost", "root", "", "db_online_shopping");
      $query = "SELECT * from brand where brand_Id = ".$_POST['brand_id'].""; 
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  <label class="mr-5" style="font-size:20px;">Brand Name:</label>
                         <input width="10px" type="text" class="form-control" id="brand_name" name="brand_name" value="'.$row['Brand'].'" placeholder="Name">

                ';  
      }    
      echo $output;  



 }  

 ?>
 <script type="text/javascript">
  $('#des').hide();
  $('#btndes1').hide();
   $(document).ready(function(){  
      $('#btndes').click(function(){
        $('#des').show("slow", "linear");
        $('#btndes1').show();
        $('#btndes').hide();
      });  
      $('#btndes1').click(function(){
        $('#des').hide("slow", "linear");
        $('#btndes1').hide();
        $('#btndes').show();
      });  
 });
 </script>