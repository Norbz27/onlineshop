 <?php
	session_start();
	include_once('dbconnect.php');

	$msg = '';
	$bsave = isset($_POST['bsave']) ? $_POST['bsave'] : '';
	if($bsave == 'Save'){
			$tname = $_POST['inputName'];
			$temail = $_POST['inputEmail4'];
			$tphone = $_POST['inputPhone'];
			$tgender = $_POST['inputgender'];
			$tage = $_POST['inputAge'];
			$tbday = $_POST['inputbday'];
			$timg = $_POST['inputimage'];
			
			mysqli_query($conn, "update user_account set Name='$tname', Email='$temail', Phone_number='$tphone', Gender='$tgender', Age='$tage', Birthdate='$tbday',Profile_img='$timg' where User_id like '$_SESSION[USER_ID]'") or die(mysqli_error($conn));


	}
	$result = mysqli_query($conn, "select Name, Email , Phone_number, Gender, Age, Birthdate, Username, Profile_img from user_account where User_id like '$_SESSION[USER_ID]'") or die(mysqli_error($conn));

	if(mysqli_num_rows($result) >= 1){
		while($rowUsers = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$name = $rowUsers['Name'];
			$email = $rowUsers['Email'];
			$phone = $rowUsers['Phone_number'];
			$gender = $rowUsers['Gender']; 
			$age = $rowUsers['Age'];
			$birth = $rowUsers['Birthdate'];
			$username = $rowUsers['Username'];
			$img = $rowUsers['Profile_img'];
		}
	}

	$bsave = isset($_POST['cart']) ? $_POST['cart'] : '';
	if($bsave == 'Buy Again'){
			$pname = $_POST['pname'];
			$pprice = $_POST['pprice'];
			$pimg = $_POST['pimg'];
			$pid = $_POST['pid'];
			$bid = $_POST['bid'];
			$quan = $_POST['quan'];
			$sub = $_POST['sub'];
			
			mysqli_query($conn, "insert into cart(User_id,Quantity,Product_Id,Product_name,Product_price,Product_img,Sub_total) values('$bid','$quan','$pid','$pname','$pprice','$pimg','$sub')") or die(mysqli_error($conn));

			header("Location: cart.php");


	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>online shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	<script src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:800&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="vendor/datetimepicker/bootstrap-datepicker.css">
  	
	<link rel="stylesheet" href="css/style.css">
	<style>
	hr.style17 {
		border-top: 1px solid #a8a8a8;
		text-align: center;
	}
	hr.style17:after {
		content: '§';
		display: inline-block;
		position: relative;
		top: -14px;
		padding: 0 10px;
		background: #f0f0f0;
		color: #8c8b8b;
		font-size: 18px;
		-webkit-transform: rotate(60deg);
		-moz-transform: rotate(60deg);
		transform: rotate(60deg);
	}
	</style>
	<script type="text/javascript">
		function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    
			    reader.onload = function(e) {
			      $('#img').attr('src', e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]);
			  }
			}

			$("#inputimage").change(function() {
			  readURL(this);
			});

	</script>
	<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
	</head>
	<body lang="en" style="background-color: #f8f9fc; ">
		<div class="container-xl">
			<nav id="nav-bar" style="padding: 30px 80px 20px 80px; background-color: white; " class="navbar navbar-light navbar-expand-md navigation-clean-button">
				<img src="img/logo.png" style="width: 35px; height: 30px; margin-right:5px; "/>
				<a class="navbar-brand text-uppercase font-weight-bold" style="font-family: 'Nunito', sans-serif;" href="index.php">Biologic System</a>
				<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
				<?php
				if(empty($_SESSION['USERNAME'])){
					echo '<span style="margin-right:50px;"></span>';
					}
				?>
				<div class="collapse navbar-collapse" id="navcol-1">
				<form action="view_product.php" id="form-search" class="form-inline active-cyan-4 mx-auto" style="padding-left:65px;" method="post">
					<input size="90" id="search-bar" name="search" class="form-control form-control-sm w-75 mx-6" type="text" placeholder="Search" aria-label="Search">
					<button type="submit" name="btnsearch" class="search-btn"><i style="color: white;" class="fas fa-search" aria-hidden="true"></i></button>
				</form>
				<?php
				if(empty($_SESSION['USERNAME'])){
						echo '<span style="padding-right:0px;"></span>';
					}
					else{
						echo '<span style="padding-right:25px;"></span>';
						
					} 
				?>
				<div class="row">
					<?php
						if(empty($_SESSION['USERNAME'])){
						echo '<a class=""style="margin-left: 60px;padding-top: 10px; float:right;"><img class="img-cart" src="img/cart.png"/></a>';
					}else{
						echo '<a class="" href="cart.php" style="margin-left: 60px;padding-top: 10px; float:right;"><img class="img-cart" src="img/cart.png"/></a>';
					}
					?>

					<?php
						if(empty($_SESSION['USERNAME'])){
							echo '<div id="log_btn"><span id="log_sign" class="navbar-text actions"> <a id="login" class="login" href="login.php">Log In</a><a class="btn btn-primary action-button" role="button" href="Signup.php" id="signup">Sign Up</a></span></div></div>';	
						}
						else{
							echo '<div class="dropdown" style="cursor:pointer; padding-top:10px;"><i style="font-size: 22px;margin-top:4px; margin-left: 10px; float:right;" class="fas fa-user dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></i>
									<div class="dropdown-menu shadow-lg bg-white rounded" style="border:none; " role="menu">
										<a class="dropdown-item " role="presentation" style="font-size:12px;" href="User_info.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" role="presentation" style="font-size:12px;" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
									</div>
								</div>';
							
						}
					?>
								
					<span style="font-size: 13px; padding-left: 5px; padding-top: 10px; letter-spacing: 1px; ">
					<?php 
						if(empty($_SESSION['USERNAME'])){
							
						}
						else{
							echo $_SESSION['USERNAME'];
							
						}
					?>
						
					</span>
				</div>
			</nav>
			
		</div>
		<div class="container-xl shadow" style="font-size: 13px;background-color: white;">
				<nav class="navbar bg-faded navbar-light navbar-expand navigation-clean-button" style="padding-left: 50px;">
					<ul class="nav navbar-nav mx-auto" style="list-style-type: none; text-align: center;" >
                        <li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="dropdown nav-item" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="dropdown-toggle nav-link active" data-toggle="dropdown" aria-expanded="false" href="#">Product Categories</a>
                            <div class="dropdown-menu" style="border: none;" role="menu">
                            	<?php
									$sql = 'select * from category';
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
									
								?>
									<a class="dropdown-item" role="presentation" href="view_product.php?category=<?php echo $row['Category_Id']; ?>&catname=<?php echo $row['Category_Name']?>"><?=$row['Category_Name'];?></a>
						
								<?php }?>
							</div>
                        </li>
                        <li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link" href="#">Promos</a></li>
                        <li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link" href="Services.php">Services</a></li>
						<li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link" href="about.php">About us</a></li>
                    </ul>
				</nav>

		</div>

		<div class="container-xl mt-5" style="padding: 10px 60px 20px 60px; font-size: 12px; font-family: arial">
			<div class="row">
				<div class="mr-5">
					<div class="container-sm">
						<div class="mb-4 row">
						  <a class="nav-link text-dark col-4" href="#" role="button">
			                <img style="height: 50px; width: 50px" class="img-profile rounded-circle" src="img/<?php echo $img; ?>">
			              </a>
			               <a class="nav-link text-dark col mt-1" id="edit" role="button" style="cursor: pointer">
			               	<span class="mr-2 d-lg-inline meduim " style="font-weight: bold; padding-left: 5px; font-size: 13px "><?php echo $username; ?></span><br/>
			               	<i class="fas fa-pencil-alt"></i>  Edit Profile
			               </a>
						</div>
						<div class="list-group">
						  <div class="custom-control mr-auto" style="border:none; background: none; padding: 0px">
					        <a class="nav-link text-dark font-weight-bold" href="#">
					          <span class="" ><i class="far fa-user rounded-circle"></i></span>
					          <span style="padding-left: 13px; letter-spacing: 0.5px;">My Account</span></a>
					        <li class="list-group-item mr-auto" style="border:none; background: none; padding: 0px; margin-left: 13px">
					          <a class="nav-link text-secondary" href="User_info.php">
					          <span style="padding-left: 13px; letter-spacing: 0.5px;">Profile</span></a>
					      	</li>
					      	<li class="list-group-item mr-auto" style="border:none; background: none; padding: 0px; margin-left: 13px">
					          <a class="nav-link text-secondary" href="address.php">
					          <span style="padding-left: 13px; letter-spacing: 0.5px;">Addresses</span></a>
					      	</li>
					      	<li class="list-group-item mr-auto" style="border:none; background: none; padding: 0px; margin-left: 13px">
					          <a class="nav-link text-secondary" href="password.php">
					          <span style="padding-left: 13px; letter-spacing: 0.5px;">Change Password</span></a>
					      	</li>
					      </div>
					      <li class="list-group-item mr-auto" style="border:none; background: none; padding: 0px">
					        <a class="nav-link text-dark font-weight-bold" href="#">
					          <span class="" ><i class="far fa-credit-card rounded-circle"></i></span>
					          <span style="padding-left: 10px; letter-spacing: 0.5px;">My Purchase</span></a>
					      </li>
					      
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card-header mb-4" style="background: none; border: none; padding: 0px">
						<div class="card-body bg-white mb-3" style="box-shadow: -4px -3px 11px -13px rgba(92,91,92,1);">
							<h5 style="margin-bottom: -5px">My Purchase</h5>
	          			</div>
						<div class="active-cyan-4 mb-4">
						  <form method="post">
						  	<input style="border-radius: 0px" name="search" class="form-control" type="text" placeholder="Search..." aria-label="Search">
						  	<input type="submit" name="bSearch" value="Search" hidden>
						  </form>
						</div>
					</div>
					<div class="card-body bg-white " style="box-shadow: -4px -3px 11px -13px rgba(92,91,92,1);">
						<div class="">
							<table class="table" id="dataTable" width="100%" cellspacing="0" style="`width: 100%;">
			          <thead>
			            <tr  class="m-0 font-weight-bold text-dark">
			              <th style="border:none;" width="100px"></th>
			              <th style="border:none;" width="180px"></th>
			              <th style="border:none;" width="170px"></th>
			              <th style="border:none;" width="190px"></th>
			            </tr>
			            	
			            </thead>
			            <tbody>
			            	<?php
			            	$user_id = $_SESSION['USER_ID'];
			            	$bSearch = isset($_POST['bSearch']) ? $_POST['bSearch'] : '';
							if($bSearch == 'Search'){
								$sql = "select * from transaction inner join productstatus on transaction.ProductStatus_Id = productstatus.ProductStatus_Id where Product_name like '$_POST[search]%' and Buyers_Id = ".$user_id."";
								
							}else{
			            	$sql = 'select * from transaction inner join productstatus on transaction.ProductStatus_Id = productstatus.ProductStatus_Id where Buyers_Id = '.$user_id.' order by transaction.ProductStatus_Id ASC';
			            	}
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								$status = $row['ProductStatus_Id'];
								$tran_Id = $row['transaction_Id'];
								$price = $row['Product_price'];
								$subtotal = $row['Product_price']*$row['Quantity'];
								$subtotal1 = number_format($subtotal);
								$price1 = number_format($price);
			            ?>
			            <tr>
			            	<td class="text-secondary" style="border: none;"><?=$row['Status']?></td>
			            </tr>
			  			<tr>
			              <td style="border:none;"><img width="120px" height="120px" src="img/<?=$row['Product_img']?>"></td>
			              <td style="border:none;font-size: 15px; font-weight: bold" width="500"><?=$row['Product_name']?></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px;"></td>
			              <td style="border:none; padding-top: 25px;font-size: 15px">x<?=$row['Quantity']?></td>
			              <td style="border:none; padding-top: 25px; font-size: 20px">₱<?=$price1?></td>
			              
			         	</tr>
			         	<tr>
			         		<td style="border:none;"></td>
			              <td style="border:none; padding-top: 25px;"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 5px;font-size: 15px;font-weight: bold;	">Order Total:</td>
			         		<td class="text-warning" style="border:none; padding-top: 0px;font-size: 25px; font-weight: bold;">₱<?=$subtotal1?></td>
			         	</tr>
			         	<tr>
			         		<td style="border:none;"></td>
			              <td style="border:none; padding-top: 25px;"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px"></td>
			              <td style="border:none; padding-top: 25px;padding-top: 12px;"><a href="order_detail.php?p_id=<?=$row['transaction_Id'];?>" style="color:white;font-size: 12px; width: 150px" class="btn btn-warning">View Order Detail</a></td>

			              <?php 
			              	if($row["ProductStatus_Id"] == 3){
			              		echo '<td style="border:none; padding-top: -35px;" width="200">
			              		<form action="" method="post">
			              		<input type="hidden" name="pname" value="'.$row['Product_name'].'">
			              		<input type="hidden" name="pprice" value="'.$row['Product_price'].'">
			              		<input type="hidden" name="pimg" value="'.$row['Product_img'].'">
			              		<input type="hidden" name="quan" value="'.$row['Quantity'].'">
			              		<input type="hidden" name="pid" value="'.$row['Product_Id'].'">
			              		<input type="hidden" name="bid" value="'.$row['Buyers_Id'].'">
			              		<input type="hidden" name="sub" value="'.$row['Subtotal'].'">
			              		<input type="submit" name="cart" value="Buy Again" class="btn btn-warning" style="color:white;font-size: 12px; width: 100px">
			              		</form>
			              		</td>';
			              	}else if($row["ProductStatus_Id"] == 4){
			              		echo '<td style="border:none; padding-top: -35px;" width="200"><span style="color:white;font-size: 12px; width: 100px;" class="text-dark">Product Canceled</span></td>';
			              	}else{
			              		echo '<td style="border:none; padding-top: -35px;"><a href="delete_product.php?ptid2='.$tran_Id.'" onclick="return confirm(\'Are you sure you want to cancel this order?\')" style="color:white;font-size: 12px; width: 100px" class="btn btn-warning">Cancel Order</a></td>';
			              	}
			              ?>
			         		<td style="border:none; padding-top: -35px;"></td>
			         	</tr>

			            </tbody>
			            <?php }?>
			           
			       </table>
	            		</div>
	          		</div>
          		</div>
			</div>
		</div>
		
		<script type="text/javascript" src="vendor/datetimepicker/bootstrap-datepicker.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
	</body>
	<!-- Footer -->
	<footer class="page-footer small" style="background-color: white;">

	  <div style="background-color: #151e3b; color: white;">
		<div class="container">

		  <!-- Grid row-->
		  <div class="row py-4 d-flex align-items-center">

			<!-- Grid column -->
			<div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
			  <h6 class="mb-0">Get connected with us on social networks!</h6>
			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-6 col-lg-7 text-center text-md-right">

			  <!-- Facebook -->
			  <a class="fb-ic">
				<i class="fab fa-facebook-f white-text mr-4"> </i>
			  </a>
			  <!-- Twitter -->
			  <a class="tw-ic">
				<i class="fab fa-twitter white-text mr-4"> </i>
			  </a>
			  <!-- Google +-->
			  <a class="gplus-ic">
				<i class="fab fa-google-plus-g white-text mr-4"> </i>
			  </a>
			  <!--Linkedin -->
			  <a class="li-ic">
				<i class="fab fa-linkedin-in white-text mr-4"> </i>
			  </a>
			  <!--Instagram-->
			  <a class="ins-ic">
				<i class="fab fa-instagram white-text"> </i>
			  </a>

			</div>
			<!-- Grid column -->

		  </div>
		  <!-- Grid row-->

		</div>
	  </div>

	  <!-- Footer Links -->
	  <div class="container text-center text-md-left mt-5">

		<!-- Grid row -->
		<div class="row mt-3">

		  <!-- Grid column -->
		  <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

			<!-- Content -->
			<h6 class="text-uppercase font-weight-bold"><img src="img/logo.png" style="width:35px; height:30px; margin-right:5px;"/>Biologic System</h6>
			<hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			<p>We enables the customer to browse the firm's range of products and services, view photos or images of the products, along with information about the product details, features and prices with a cash on delivery services in Mindanao Philippines.</p>

		  </div>
		  <!-- Grid column -->

		  <!-- Grid column -->
		  <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

			<!-- Links -->
			<h6 class="text-uppercase font-weight-bold">Products</h6>
			<hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			<p>
			  <a href="#!"></a>
			</p>
			<p>
			  <a href="#!"></a>
			</p>
			<p>
			  <a href="#!"></a>
			</p>
			<p>
			  <a href="#!"></a>
			</p>

		  </div>
		  <!-- Grid column -->

		  <!-- Grid column -->
		  <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" >

			<!-- Links -->
			<h6 class="text-uppercase font-weight-bold">links</h6>
			<hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			<p>
			  <a style="text-decoration: none" href="about.php">About Us</a>
			</p>
			<p>
			  <a style="text-decoration: none" href="services.php">Services</a>
			</p>
			<p>
			  <a style="text-decoration: none" href="terms.php">Terms and Condition</a>
			</p>
			<p>
			  <a href="#!"></a>
			</p>

		  </div>
		  <!-- Grid column -->

		  <!-- Grid column -->
		  <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

			<!-- Links -->
			<h6 class="text-uppercase font-weight-bold">Contact</h6>
			<hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			<p>
			  <i class="fas fa-home mr-3"></i> Magallanes St., Surigao City</p>
			<p>
			  <i class="fas fa-envelope mr-3"></i> contact@support.com</p>
			<p>
			  <i class="fas fa-phone mr-3"></i> (086) 826-3067</p>
			<p>
			  <i class="fas fa-print mr-3"></i> 09192900584/0928905008</p>

		  </div>
		  <!-- Grid column -->

		</div>
		<!-- Grid row -->

	  </div>
	  <!-- Footer Links -->

	  <!-- Copyright -->
	  <div class="footer-copyright text-center py-3">© 2020 Copyright:
		<a href="#"> 2020. All Rights Reserved.</a>
	  </div>
	  <!-- Copyright -->

	</footer>
	<!-- Footer -->
</html>
