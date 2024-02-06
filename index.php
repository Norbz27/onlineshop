<?php
	session_start();
	include_once('dbconnect.php');

	$bsave = isset($_POST['brsave']) ? $_POST['brsave'] : '';
	if($bsave == 'Save'){
			$inputid = $_POST['inputid'];

			mysqli_query($conn, "update user_account set Verified_Id = '$inputid' where User_ID = ".$_SESSION['USER_ID']."") or die(mysqli_error($conn));

			
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
		<link rel="stylesheet" href="css/style.css">
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
				$(document).ready(function(){
        $("#brand").modal('show');
   		 });
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
                        <li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="dropdown nav-item" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Product Categories</a>
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

		<!--Carousel Wrapper-->
		<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
		  <!--Indicators-->
		  <ol class="carousel-indicators">
			<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-2" data-slide-to="1"></li>
			<li data-target="#carousel-example-2" data-slide-to="2"></li>
		  </ol>
		  <!--/.Indicators-->
		  <!--Slides-->
		  <div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
			  <div class="view">
				<img class="d-block w-100" src="img/1.jpg"
				  alt="First slide">
				<div class="mask rgba-black-light"></div>
			  </div>
			  <div class="carousel-caption " style="top: 54%; transform: translateY(-50%);">
				<h1 class="h1-responsive" style="font-size:30px; letter-spacing: 5px;">Welcome to Biologic System</h1>
				<p style="font-size:17px; letter-spacing: 2px;">Online Shopping Site</p>
				<a class="btn btn-outline-light" role="button" href="view_product.php?category=1&catname=PC" style="top: 150%; transform: translateY(260%);">Shop now</a>
			  </div>
			</div>
			<div class="carousel-item">
			  <!--Mask color-->
			  <div class="view">
				<img class="d-block w-100" src="img/gaming.jpg"
				  alt="Second slide">
				<div class="mask rgba-black-strong"></div>
			  </div>
			  <div class="carousel-caption">
				<h1 class="h1-responsive"></h1>
				<p></p>
			  </div>
			</div>
			<div class="carousel-item">
			  <!--Mask color-->
			  <div class="view">
				<img class="d-block w-100" src="img/1_Jlt_au_Nhn-9X4kknrdqHA.jpeg"
				  alt="Third slide">
				<div class="mask rgba-black-slight"></div>
			  </div>
			  <div class="carousel-caption">
				<h1 class="h1-responsive"></h1>
				<p></p>
			  </div>
			</div>
		  </div>
		  <!--/.Slides-->
		  <!--Controls-->
		  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		  <!--/.Controls-->
		</div>
		<!--/.Carousel Wrapper-->
		<div>
		<p class="text-center" style="font-family: 'Montserrat', sans-serif; font-size: 35px; padding: 80px 130px 10px 130px;">" HOME OF QUALITY AND AFFORDABLE TECHNOLOGIES AND ACCESORIES WITH RELIABLE WARRANTY SERVICES"</p>
		</div>
		<p class="text-center" style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px;font-size: 25px; transform: scale(.6, .8); padding-top: 100px;">ON SALE PRODUCTS</p>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
					<!-- Carousel indicators -->
					<ol id="carousel-indicators" class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>   
					<!-- Wrapper for carousel items -->
					<div class="carousel-inner">
						<div class="item carousel-item active">
							<div class="row">
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/lenovo.jpg" class="img-responsive img-fluid" alt="">									
										</div>
										<div class="thumb-content">
											<h4>Lenovo IdeaPad 330-15ARR</h4>									
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<p class="item-price"><strike>$400.00</strike> <b>$369.00</b></p>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/R1HQ-1.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Acer Swift 3 Sf314-56-517w</h4>									
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<p class="item-price"><strike>$25.00</strike> <b>$23.99</b></p>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>		
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/mavic.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>DJI Mavic Air Artic white</h4>									
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star-half"></i></li>
												</ul>
											</div>
											<p class="item-price"><strike>$899.00</strike> <b>$649.00</b></p>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/2140-300x300.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Epson M2140</h4>									
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<p class="item-price"><strike>$315.00</strike> <b>$250.00</b></p>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
							</div>
						</div>
						<div class="item carousel-item">
							<div class="row">
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/l310-300x300.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Epson l310</h4>
											<p class="item-price"><strike>$289.00</strike> <span>$269.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/315-300x300.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Epson l3150</h4>
											<p class="item-price"><strike>$1099.00</strike> <span>$869.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star-half"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/5190-300x300.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Epson 5190</h4>
											<p class="item-price"><strike>$109.00</strike> <span>$99.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star-half"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/o-300x300.png" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Epson l120</h4>
											<p class="item-price"><strike>$599.00</strike> <span>$569.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>						
							</div>
						</div>
						<div class="item carousel-item">
							<div class="row">
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/215621_pjpeg-300x300.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>EPSON L3110</h4>
											<p class="item-price"><strike>$369.00</strike> <span>$349.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/RED-300x300.png" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>REDRAGON kumara</h4>
											<p class="item-price"><strike>$315.00</strike> <span>$250.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/sandisk-300x351.jpg" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>Sandisk 16GB</h4>
											<p class="item-price"><strike>$450.00</strike> <span>$418.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star-half"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>	
								<div class="col-sm-3">
									<div class="thumb-wrapper">
										<span class="wish-icon"><i class="far fa-heart"></i></span>
										<div class="img-box">
											<img src="img/acer-tmb-117-m-c42k-300x300.png" class="img-responsive img-fluid" alt="">
										</div>
										<div class="thumb-content">
											<h4>ACER TMB117-M C42K</h4>
											<p class="item-price"><strike>$350.00</strike> <span>$330.00</span></p>
											<div class="star-rating">
												<ul class="list-inline">
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="fas fa-star"></i></li>
													<li class="list-inline-item"><i class="far fa-star"></i></li>
												</ul>
											</div>
											<a href="#" class="btn btn-primary">Add to Cart</a>
										</div>						
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Carousel controls -->
					<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				</div>
			</div>
		</div>
		
		<div class="card" style="background: #151e3b; color:white; margin-top: 100px;">
		  <div class="card-body">
			<img src="img/acer-nitro.png" class="float-left img-fluid" alt="Responsive image" style="width:450px; height:250px; margin-top:70px; margin-left: 60px;"/>
			<h5 class="card-title" style="float:right;color: #ff7713; font-family: 'Montserrat', sans-serif; font-size: 40px; margin-right:110px; margin-top:20px;">Acer Nitro AN515-42-R970</h5>
			<div style="float:right; color:white; font-family: arial; margin-top:-15px; margin-right:140px;">
			<p class="card-text">
				<ul>
					<li>AMD RYZEN 5-2500U</li>
					<li>4GB DDR4</li>
					<li>1TB HDD+128GB SSD</li>
					<li>RADEON RX560X 4GB VIDEOCARD</li>
					<li>15.6″ DISPLAY</li>
					<li>WIFI</li>
					<li>CAMERA</li>
					<li>BLUETOOTH</li>
					<li>WIN10 HOME1 yr. warranty parts + 1 year online warranty registration.</li>
					<li>©Acer Philippines.</li>
				</ul>
			</p>
			<a href="#" id="btn" class="btn btn-outline-light">Shop now</a>
			</div>
			
		  </div>
		</div>
		<div>
			<p class="text-center" style="font-family: 'Montserrat', sans-serif; font-size: 29px; padding: 40px 130px 70px 130px;">"Trust yourself into the gaming world with a form factor that takes you beyond that of mere mortal lapops."</p>
			<div class="col text-center">
				<button class="btn btn-default btn btn-primary btn-lg" style="padding:7px 13px 7px 13px; margin-bottom: 100px; margin-top: -50px;">GO NOW</button>
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
