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
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/product_view.css">
	</head>
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
                        <li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link active" href="Services.php">Services</a></li>
						<li class="nav-item" role="presentation" style="padding-right: 30px; letter-spacing: 1px; display: inline-block"><a class="nav-link" href="about.php">About us</a></li>
                    </ul>
				</nav>

		</div>
		<div class="container-xl py-3 mb-4" style="background-color: #151e3b; color: white; padding: 10px 60px 20px 60px;">
			<div class="row">
				<div class="col-4">
				<p class="h2">Terms & Conditions</p>
				</div>
			</div>
		</div>
		<div class="container-xl py-3 mb-4" style="padding: 10px 60px 20px 60px;">
			<div class="row">
			<div class="col-8 text-justify" style="font-size: 17px;font-family: 'Roboto', sans-serif;">
				<h4><b>Terms & Conditions</b></h4>
				<p>Please read these terms and conditions (“terms”, “terms and conditions”) carefully before using www.biologicsystemsph.com website operated by Biologic Systems Computer Center.</p><br/>

				<h4><b>Conditions of Use</b></h4>
				<p>We will provide their services to you, which are subject to the conditions stated below in this document. Every time you visit this website, use its services or make a purchase, you accept the following conditions. This is why we urge you to read them carefully.</p><br/>

				<h4><b>Privacy Policy</b></h4>
				<p>Before you continue using our website we advise you to read our privacy policy [link to privacy policy] regarding our user data collection. It will help you better understand our practices.</p><br/>

				<h4><b>Copyright</b></h4>
				<p>Content published on this website (digital downloads, images, texts, graphics, logos) is the property of [name] and/or its content creators and protected by international copyright laws. The entire compilation of the content found on this website is the exclusive property of [name], with copyright authorship for this compilation by [name].</p><br/>

				<h4><b>Communications</b></h4>
				<p>The entire communication with us is electronic. Every time you send us an email or visit our website, you are going to be communicating with us. You hereby consent to receive communications from us. If you subscribe to the news on our website, you are going to receive regular emails from us. We will continue to communicate with you by posting news and notices on our website and by sending you emails. You also agree that all notices, disclosures, agreements and other communications we provide to you electronically meet the legal requirements that such communications be in writing.</p><br/>

				<h4><b>Trademark</b></h4>
				<p>Biologic Systems Computer Center trademarks may not be used in connection with any product or service that is not of ours, in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits Biologic Systems Computer Center . All other trademarks not owned by Biologic Systems Computer Center or its subsidiaries that appear on this site are the property of their respective owners.</p><br/>

				<h4><b>License and Site Access</b></h4>
				<p>Biologic Systems Computer Center grants you a limited license to access and make personal use of this site and not to download (other than page caching) or modify it, or any portion of it, except with expressed written consent of Biologic Systems Computer Center . </p><br/>

				<p>This license does not include any resale or commercial use of this site or its contents: any collection and use of any product listings, descriptions, or prices: any derivative use of this site or its contents: any downloading or copying of account information for the benefit of another merchant: or any use of data mining, robots, or similar data gathering and extraction tools. </p><br/>

				<p>This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without expressed written consent of Biologic Systems Computer Center . </p><br/>

				<p>You may not frame or utilize framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) of Biologic Systems Computer Center and our associates without express written consent. </p><br/>

				<p>You may not use any meta tags or any other “hidden text” utilizing Biologic Systems Computer Center name or trademarks without the express written consent of Biologic Systems Computer Center. Any unauthorized use terminates the permission or license granted by Biologic Systems Computer Center. </p><br/>

				<p>You are granted a limited, revocable, and nonexclusive right to create a hyperlink to the home page of Biologic Systems Computer Center so long as the link does not portray Biologic Systems Computer Center, its associates, or their products or services in a false, misleading, derogatory, or otherwise offensive matter. </p><br/>

				<p>You may not use any Biologic Systems Computer Center logo or other proprietary graphic or trademark as part of the link without express written permission. </p><br/>

				<h4><b>Your Site Account</b></h4>
				<p>If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. If you are under 18, you may use our website only with involvement of a parent or guardian. Biologic Systems Computer Center and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion. </p><br/>

				<h4><b>REVIEWS, COMMENTS, EMAILS, AND OTHER CONTENT</b></h4>
				<p>Visitors may post reviews, comments, and other content: and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of “spam.”  </p><br/>

				<p>You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content.  </p><br/>

				<p>Biologic Systems Computer Center reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.</p><br/>

				<h4><b>RISK OF LOSS</b></h4>
				<p>All items purchased from Biologic Systems Computer Center are made pursuant to a shipment contract. This basically means that the risk of loss and title for such items pass to you upon our delivery to the carrier. </p><br/>

				<h4><b>PRODUCT DESCRIPTIONS</b></h4>
				<p>Biologic Systems Computer Center and its associates attempt to be as accurate as possible. However, Biologic Systems Computer Center does not warrant that product descriptions or other content of this site is accurate, complete, reliable, current, or error-free. If a product offered by Biologic Systems Computer Center itself is not as described, your sole remedy is to return it in unused condition. </p><br/>

				<p>DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY THIS SITE IS PROVIDED BY BIOLOGIC SYSTEMS COMPUTER CENTER ON AN “AS IS” AND “AS AVAILABLE” BASIS.  </p><br/>

				<p>BIOLOGIC SYSTEMS COMPUTER CENTER MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK. </p><br/>

				<p>BIOLOGIC SYSTEMS COMPUTER CENTER WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF THIS SITE, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES.   </p><br/>

				<h4><b>PRODUCT DESCRIPTIONS</b></h4>
				<p>All items purchased from Biologic Systems Computer Center are made pursuant to a shipment contract. This basically means that the risk of loss and title for such items pass to you upon our delivery to the carrier. </p><br/>

				<h4><b>Applicable Law</b></h4>
				<p>By visiting this website, you agree that the laws of the Philippines, without regard to principles of conflict laws, will govern these terms and conditions, or any dispute of any sort that might come between Biologic Systems Computer Center and you, or your business partners and associates.</p><br/>

				<h4><b>Disputes</b></h4>
				<p>Any dispute related in any way to your visit to this website or to products you purchase from us shall be arbitrated by courts in the Philippines and you consent to exclusive jurisdiction and venue of such courts.</p><br/>

				<h4><b>Comments, Reviews, and Emails</b></h4>
				<p>Visitors may post comments as long as it is not obscene, illegal, defamatory, threatening, infringing of intellectual property rights, invasive of privacy or injurious in any other way to third parties. Content has to be free of software viruses, political campaign, and commercial solicitation. </p><br/>

				<p>We reserve all rights (but not the obligation) to remove and/or edit such content. </p><br/>

				<h4><b>User Account</b></h4>
				<p>If you are an owner of an account on this website, you are solely responsible for maintaining the confidentiality of your private user details (username and password). You are responsible for all activities that occur under your account or password.</p><br/>

				<p>We reserve all rights to terminate accounts, edit or remove content and cancel orders in their sole discretion. </p><br/>

				<h4><b>SITE POLICIES, MODIFICATION, AND SEVERABILITY</b></h4>
				<p>Please review our other policies, such as our Privacy and Returns policy, posted on this site. These policies also govern your visit to Biologic Systems Computer Center. We reserve the right to make changes to our site, policies, and these Terms and Conditions at any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p><br/>

				<h4><b>QUESTIONS:</b></h4>
				<p>Questions regarding our Terms and Conditions, Privacy Policy, Return Policy, or other policy related material can be directed to our support staff by clicking on the “Contact Us” link. Or you can email us at: biologicsystemsph@gmail.com</p><br/>

			</div>
			<div class="col" style="font-family: 'Roboto', sans-serif;">
				<img src="img/biologic.jpg" width="400" class="mb-3">
				<h4><b>Biologic System Computer Center</b></h4>
				<div><i class="fas fa-map-marker-alt"></i><span style="margin-top: -2px"> Magallanes St., Surigao City</span></div><br/>
				<h5 style="letter-spacing: .5px"><b>Repair Service Center</b></h5>
				<div><i class="fas fa-map-marker-alt"></i><span> Gemina St., Surigao City</span></div><br/>
				<h6>Follow us:</h6>
			  <a class="fb-ic">
				<i class="fab fa-facebook-f white-text mr-4"> </i>
			  </a>
			  <a class="tw-ic">
				<i class="fab fa-twitter white-text mr-4"> </i>
			  </a>
			  <a class="gplus-ic">
				<i class="fab fa-google-plus-g white-text mr-4"> </i>
			  </a>
			  <a class="ins-ic">
				<i class="fab fa-instagram white-text"> </i>
			  </a>
			</div>
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
