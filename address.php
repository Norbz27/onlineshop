 <?php
	session_start();
	include_once('dbconnect.php');

	$msg = '';
	$bsave = isset($_POST['bsave']) ? $_POST['bsave'] : '';
	if($bsave == 'Save'){
			$taddress = $_POST['inputAddress'];
			
			mysqli_query($conn, "update user_account set Address = '$taddress' where User_id like '$_SESSION[USER_ID]'") or die(mysqli_error($conn));


	}
	$result = mysqli_query($conn, "select * from user_account where User_id like '$_SESSION[USER_ID]'") or die(mysqli_error($conn));

	if(mysqli_num_rows($result) >= 1){
		while($rowUsers = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$name = $rowUsers['Name'];
			$phone = $rowUsers['Phone_number'];
			$address = $rowUsers['Address']; 
			$username = $rowUsers['Username'];
			$img = $rowUsers['Profile_img'];
		}
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
					        <li class="list-group-item mr-auto font-weight-bold" style="border:none; background: none; padding: 0px; margin-left: 13px">
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
					        <a class="nav-link text-dark font-weight-bold" href="my_purchase.php">
					          <span class="" ><i class="far fa-credit-card rounded-circle"></i></span>
					          <span style="padding-left: 10px; letter-spacing: 0.5px;">My Purchase</span></a>
					      </li>
					 
					      
						</div>
					</div>
				</div>
				<div class="card-body bg-white row" style="box-shadow: -4px -3px 11px -13px rgba(92,91,92,1);">
				<div class="col">

		              <div>
		              	<h5>My Address</h5>
		              </div>
		              <hr class="style17">
		              <form action="address.php" method="post">
		              	<div class="row">
				        <div style="float: left; margin-left: 0px" class="container-fluid col-md-8">
				            <div class="form-group row">
		   						<label for="" class="col-sm-3 col-form-label">Name</label>
		    					<div class="col">
		    				    	<span id="inputAddress" class="form-control" readonly name="inputName" style=" border:none;background-color: white"><?php echo $name;?></span>
		  						</div>
		  					</div>
		  					<div class="form-group row">
		   						<label for="" class="col-sm-3 col-form-label">Phone</label>
		    					<div class="col">
		    				    	<span id="inputAddress" class="form-control" readonly name="inputName" style=" border:none;background-color: white"><?php echo $phone;?></span>
		  						</div>
		  					</div>
		  					<div class="form-group row">
		   						<label for="" class="col-sm-3 col-form-label">Address</label>
		    					<div class="col">
		    				    	<input type="text" id="inputAddress" class="form-control" name="inputAddress" value="<?php echo $address;?>" style=" border:none;background-color: white">
		  						</div>
		  					</div>
				        </div>
				        	
            			</div>

            				<input type="Submit" id="save" class="btn btn-info" style="font-size: 12px; padding: 7px 15px 7px 15px" name="bsave" value="Save">			
            		</form>
            	</div>
            	
            </div>
          </div>
		</div>
		<script type="text/javascript">
			
		</script>
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
