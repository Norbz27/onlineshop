<?php
	session_start();
	include_once('dbconnect.php');
	
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
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/product_view.css">
		<style>
		#btn{ 
		margin-left:15px;
		border-color: #ff7713;
		color:#ff7713;
		margin-bottom:20px;
		}
		#btn:hover{
		background-color: #ff7713;
		color: #151e3b;
		}
		</style>
		<script>
				

		</script>
	</head>
	<body lang="en" style="background-color: #f8f9fc">
		<div class="container-xl">
			<nav id="nav-bar" style="padding: 30px 80px 20px 80px; background-color: white; " class="navbar navbar-light navbar-expand-md navigation-clean-button">
				<img src="img/logo.png" style="width: 35px; height: 30px; margin-right:5px; "/>
				<a class="navbar-brand text-uppercase font-weight-bold" style="font-family: 'Nunito', sans-serif;" href="index.php">Biologic System</a><span><a class="navbar-brand" style="font-family: 'Nunito', sans-serif;" href="index.php">/  Shopping Cart</a></span>
				<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navcol-1"  style="margin-left: 300px;float: right; margin-right: -100px">
				<form id="form-search" class="form-inline active-cyan-4">
					<input size="90" id="search-bar" class="form-control form-control-sm w-75" type="text" placeholder="Search" aria-label="Search">
					<button class="search-btn"><i style="color: white;" class="fas fa-search" aria-hidden="true"></i></button>
				</form>
				</div>
				<div class="dropdown" style="cursor:pointer; padding-top:10px;"><i style="font-size: 22px;margin-left: 10px;" class="fas fa-user dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></i>
					<div class="dropdown-menu shadow-lg bg-white rounded" style="border:none; " role="menu">
						<a class="dropdown-item " role="presentation" style="font-size:12px;" href="User_info.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" role="presentation" style="font-size:12px;" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
					</div>
				</div>
			</nav>
			
		</div>
	

		<div class="container" style="font-size: 13px">
			<div class="card">
				<div class="container-fliud">
				 	<table class="table" id="dataTable" width="100%" cellspacing="0" style="`width: 110%;">
			          <thead>
			            <tr  class="m-0 font-weight-bold text-dark">
			              <th style="border:none;" width="500px">
				 		<label>Product</label></th>
			              <th style="border:none;">Unit Price</th>
			              <th style="border:none;">Quantity</th>
			              <th style="border:none;">Item Subtotal</th>
			              <th style="border:none;">Action</th>
			            </tr>
			            <tbody>
			            </tbody>
			           </thead>
			       </table>
			       <table class="table" id="dataTable" width="100%" cellspacing="0" style="`width: 110%;">
			          <thead>
			            <tr  class="m-0 font-weight-bold text-dark">
			            	<hr class="style17">
			              <th style="border:none;" width="520px"></th>
			              <th style="border:none;" width="140px"></th>
			              <th style="border:none;" width="140px"></th>
			              <th style="border:none;" width="140px"></th>
			              <th style="border:none;" width="140px"></th>
			            </tr>
			            	<?php
			            	$user_id = $_SESSION['USER_ID'];
			            	$sql = 'select * from cart where User_Id = '.$user_id.'';
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$sub = $row['Sub_total'];
										$price = $row['Product_price'];
										$price1 = number_format($price);
										$sub1 = number_format($sub);
			            ?>
			            <tbody>
			            
			              <td style="border:none;"><img width="50px" height="50px" src="img/<?=$row['Product_img']?>"><span> <?=$row['Product_name']?></span></td>
			              <td style="border:none; padding-top: 25px">₱<?=$price1?></td>
			              <td style="border:none; padding-top: 25px"><?=$row['Quantity']?></td>
			              <td style="border:none; padding-top: 25px">₱<?=$sub1?></td>
			              <td style="border:none; padding-top: 20px; padding-left: 25px;"><a class="btn btn-danger mx-3" href="delete_product.php?pid=<?=$row['ID']?>" onclick="return confirm(\'Are you sure you want to remove this Item?\')"><i class="fas fa-trash-alt"></i></a></td>
			          
			            </tbody>
			            <?php }?>
			           </thead>
			       </table>
			       <table class="table" id="dataTable" width="100%" cellspacing="0" style="`width: 110%;">
			          <thead>
			            <tr  class="m-0 font-weight-bold text-dark">
			              <th style="border:none;"></th>
			              <hr class="style17">
			              <th style="border:none;" width="470px"></th>
			              <th style="border:none;" width="140px"></th>
			              <th style="border:none;" width="140px"></th>
			              <th style="border:none;" width="140px"></th>
			            </tr>

			            <tbody>
			              <td style="border:none; padding-top: 5px" align="center" width="10px"></td>
			              <td style="border:none;"><span></span></td>
			              <td style="border:none; padding-top: 5px"></td>
			              <td style="border:none; padding-top: 5px"></td>
			              <td style="border:none; padding-top: 5px"></td>
			              <td style="border:none; padding-top: 0px; padding-left: 10px"></td>
			            </tbody>
			            <tfoot>
			            	<tr>
			            		<td style="border:none;"></td>
			            		<td style="border:none;"></td>
			            		<td style="border:none;"></td>
			            		<td style="border:none; width: 300px" align="center"><h5 class="price"><span style="color: black">Total Coast:</span></h5></td>
			            		<?php
					            	$user_id = $_SESSION['USER_ID'];
									$row = $result->fetch_assoc();
									foreach($conn->query('SELECT SUM(Sub_total) FROM cart where User_Id = '.$user_id.'') as $row) {
											$subtol = $row['SUM(Sub_total)'];
											$subtol1 = number_format($subtol);

					            ?>
			            		<td style="border:none;"><h4 class="price"><span>₱<?=$subtol1?></span></h4></td>
			            	<?php }?>
			            		<td style="border:none;"><a href="checkout.php" style="padding-top:10px;color: white; width: 150px; height: 50px" class="btn btn-warning">Check out</a></td>
			            	</tr>
			            </tfoot>
			           </thead>
			       </table>
				</div>
			</div>
		
		</div>

		
		
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
