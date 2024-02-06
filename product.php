<?php
	session_start();
	include_once('dbconnect.php');
	$cat_id = $_GET['category'];
	$catname = $_GET['catname'];
	$p_id = $_GET['p_id'];
	$user_id = $_SESSION['USER_ID'];


	$query = "select * from category inner join product on product.Category_Id = category.Category_Id where category.Category_Id = $cat_id and ID = '$p_id'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$price = $row['Price'];
			$price1 = number_format($price);
		$des = '
			<div class="preview col-md-6">
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img height="370px" src="img/'.$row['Img'].'" /></div>
						</div>				
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">'.$row['Name'].'</h3>
						<input type="hidden" name="pid" value="'.$row['ID'].'">
						<input type="hidden" name="pname" value="'.$row['Name'].'">
						<input type="hidden" name="pprice" value="'.$row['Price'].'">
						<input type="hidden" name="pimg" value="'.$row['Img'].'">
						<input type="hidden" name="cat" value="'.$row['Category_Id'].'">
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<h4 class="price"><span>₱'.$price1.'</span></h4>
						<p class="vote"><strong>91%</strong> Product soled</p>
						<div class="row" style="margin-left: 0px;">
							<span class="mt-2 mr-4">Qauntity</span>';
		if($row['Stock'] == 0){
			$des1 ='<input class="quantity" min="0" max="'.$row['Stock'].'" name="quantity" value="0" type="number" readonly>';
		}else{
			$des1 ='<input class="quantity" min="1" max="'.$row['Stock'].'" name="quantity" value="1" type="number" readonly>';
		}
		$des2 ='<span class="mt-2 ml-3 mr-1">'.$row['Stock'].'</span><span class="mt-2">available</span>';
		$des3 ='<div class="container">
				<div class="row" style="background: rgba(0,0,0,.02); padding: 10px; font-size: 20px;">
					<div class="">Product Details</div>
				</div>
				<div class="row mt-3">
					<pre class="text-secondary" style="font-size:15px; font-family:arial;padding-left:10px;letter-spacing:.5px;">'.$row['Description'].'</pre>
				</div>
			</div>';
	}

	$cart = isset($_POST['cart']) ? $_POST['cart'] : '';
	if($cart == 'Add to cart'){
		$p_id = $_POST['pid'];
		$query = mysqli_query($conn, 'select * from cart where User_ID = '.$user_id.' and Product_Id = '.$p_id.'') or die(mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$quantity = $row['Quantity'];
		$price = $row['Product_price'];
		if(mysqli_num_rows($query) >= 1){
			$quan = $_POST['quantity'] + $quantity;
			$subtotal = $quan * $price;

			mysqli_query($conn, "update cart set Quantity = '$quan', Sub_total = '".$subtotal."' where User_ID = ".$user_id." and Product_Id = ".$p_id."") or die(mysqli_error($conn));
		}else{

			
				$user_id = $_SESSION['USER_ID'];
				$id  = $_POST['pid'];
				$name  = $_POST['pname'];
				$price  = $_POST['pprice'];
				$quantity  = $_POST['quantity'];
				$img  = $_POST['pimg'];
				$subtotal = $price * $quantity; 

				mysqli_query($conn, "insert into cart(User_Id,Quantity,Product_Id,Product_name,Product_price,Product_img,Sub_total) values('$user_id','$quantity','$id','$name','$price','$img','$subtotal')") or die(mysqli_error($conn));


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
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/product_view.css">

		<script>
				function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    
			    reader.onload = function(e) {
			      $('#imgid').attr('src', e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]);
			  }
			}

			$("#inputid").change(function() {
			  readURL(this);
			});

		</script>
	</head>
	<?php 
		if(isset($_SESSION['USERNAME'])){
		$sql = mysqli_query($conn, "select * from user_account where User_ID = ".$_SESSION['USER_ID']."") or die(mysqli_error($conn));
       	$row = mysqli_fetch_array($sql);
			if(empty($row['Verified_Id'])){
	?>
	<div id="brand" class="modal fade">  
        <div class="modal-dialog modal-md">  
             <div class="modal-content">  
                  <div class="modal-header">    
                       <h4 class="modal-title">Add Verified ID</h4>  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div><form method="post">
                  <div class="modal-body" id="ebrand">  
                    <div class="form-group text-center">
            		  <img id="imgid" src="img/icons/vid.png" class="mb-2" width="260" height="200"/>
	                 </div> 
	                 <div class="text-center">
	                 	
		                 <label for="set" class="btn btn-outline-primary set p-2" style="font-size: 12px; padding-left: 3px; cursor: pointer;"><i class="fas fa-plus-circle"></i> Add Verified ID</label>
		                   <input type="file" id="set" class="form-control" id="inputid" name="inputid" accept="/image" style="display:none;" onchange="readURL(this);" required />
		                
	                 </div>
                  </div>  
                  <div class="modal-footer">
                       <input type="submit" class="btn btn-success save" name="brsave" id="brsave" value="Save">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                  </div>  
                  </form>
             </div>  
        </div>  
    </div>
<?php }}?>
	<body lang="en" style="background-color: #f8f9fc">
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
		<div class="container-xl shadow" style="font-size: 13px; background-color: white; ">
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
		<div class="container-xl py-3 mb-4" style="background-color: #151e3b; color: white; padding: 10px 60px 20px 60px;">
			<div class="row">
				<div class="col-1">
				<p class="h2"><?php echo $catname?></p>
				</div>
			</div>
		</div>
		<div class="container">
		<div class="card1">
			<div class="container-fliud">
				 <form action="#" method="post">
						<div class="wrapper row">
						<?php echo $des;?>
							<div class="number-input md-number-input mb-4">
							  <input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" style="width:30px;border:none;background: none;height: 35px; font-size: 25px; padding-bottom: 5px" class="minus" value="-">
							  <?php echo $des1?>
							  <input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" style="width:30px;border:none;background: none;height: 35px; font-size: 25px; padding-bottom: 5px" class="plus"  value="+">
							</div>
						<?php echo $des2;?>
						</div>
						<div class="row" style="margin-left: 0px;">
							<span class="mb-5">Share:</span>
							<a href="Facebook.com" class="btn ml-2" style="border-radius: 10px; font-size: 30px; margin-top: -10px; color: blue; padding: 0;"><i class="fab fa-facebook"></i></a>
							<a href="Messenger.com" class="btn ml-2" style="border-radius: 10px; font-size: 30px; margin-top: -10px; color: #0078ff; padding: 0;"><i class="fab fa-facebook-messenger"></i></a>
							<a href="Twitter.com" class="btn ml-2" style="border-radius: 10px; font-size: 30px; margin-top: -10px; color: #0078ff; padding: 0;"><i class="fab fa-twitter"></i></a>
							<a href="Googleplus.com" class="btn ml-2" style="border-radius: 10px; font-size: 30px; margin-top: -10px; color: maroon; padding: 0;"><i class="fab fa-google-plus"></i></a>
						</div>
						<div class="action">
							<?php 
		              		$sql = mysqli_query($conn, "select * from user_account where User_ID = ".$_SESSION['USER_ID']."") or die(mysqli_error($conn));
       						$row = mysqli_fetch_array($sql);
		              			
								if(isset($_SESSION['USERNAME'])){
									if(empty($row['Verified_Id'])){
							?>
								<a class="btn btn-warning" data-toggle="modal" data-target="#brand" style="color: white;cursor: pointer;">Add to cart</a>
								<a class="btn btn-warning" data-toggle="modal" data-target="#brand" style="color: white;cursor: pointer;">Buy now</a>
							<?php }else{?>
							<input type="submit" style="color:white;" class="btn btn-warning" name="cart" id="sub" value="Add to cart">
							<a href="checkout.php?p_id=<?php echo $p_id;?>&quan=1" class="btn btn-warning" style="color: white;">Buy now</a>

							<?php }
							}else{?>
								<a class="btn btn-warning" href="login.php" style="color: white;">Add to cart</a>
								<a class="btn btn-warning" href="login.php" style="color: white;">Buy now</a>
							<?php }?>
						</div> 
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="card mb-5">
			<?php echo $des3;?>
		</div>
	</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
