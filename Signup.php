<?php
	session_start();
	include_once('dbconnect.php');
	 
	$msg = '';
	$bsave = isset($_POST['bsave']) ? $_POST['bsave'] : '';
	if($bsave == 'Signup'){
			$name = $_POST['inputName'];
			$email = $_POST['inputEmail4'];
			$address = $_POST['inputAddress'];
			$username = $_POST['inputUsername'];
			$password = $_POST['inputPassword'];
			$pnum = $_POST['inputnum'];
			$img = $_POST['inputimage'];
			$Q = mysqli_query($conn, "select * from user_account where Username = '$username'") or die(mysqli_error($conn));

			if(mysqli_num_rows($Q) >= 1){
				$msg = '<div class="alert alert-danger text-center" role="alert">
					  	  Username Already Excist!
						</div>';
			}else{
			mysqli_query($conn, "insert into user_account(Name,Email,Phone_number,Address,Username,Password,Profile_img) values('$name','$email','$pnum','$address','$username','$password','$img')") or die(mysqli_error($conn));
			header('Location: login.php');
			
			$msg = '<div class="alert alert-success text-center" role="alert">
					  Successfully added new system user!
					</div>';

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
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/form.css">

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

			
			var inputPassword = document.getElementById("inputPassword")
			  , inputConfirmPassword = document.getElementById("inputConfirmPassword");

			function validatePassword(){
			  if(inputPassword.value != inputConfirmPassword.value) {
			    inputConfirmPassword.setCustomValidity("Passwords Don't Match");
			  } else {
			    inputConfirmPassword.setCustomValidity('');
			  }
			}

			inputPassword.onchange = validatePassword;
			inputConfirmPassword.onkeyup = validatePassword;
	</script>
	</head>
	<body style="background-image: url('img/login_back.jpg');">
		<div class="form" style="padding-bottom:50px;">
		<?php echo $msg; ?>
		<form action="Signup.php" method="post">
			<div class="form-row">
			<span class="title">
				Sign Up
			</span>
			</div>
			<div class="form-row">
				<div class="form-group">
					<label for="">Fullname</label>
					<input size="50" type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required>
				</div>
			</div>
		  <div class="form-row">
			<div class="form-group">
				<label for="">Email</label>
				<input size="50" type="Email" class="form-control" id="inputEmail4" name="inputEmail4" placeholder="Email" required>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group">
				<label for="">Phone Number</label>
				<input size="50" type="text" class="form-control" id="inputnum" name="inputnum" placeholder="Phone number" required>
			</div>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
			<label for="">Address</label>
			<input size="50" type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Ex. P-4 Brgy. Mat-i . . . . . . ." required>
		  </div>
		  </div>
		  <div class="form-row">
			<div class="form-group">
			  <label for="">Username</label>
			  <input size="50" type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" required>
			</div>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
			  <label for="">Password</label>
			  <input size="50" type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
			</div>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
			  <label for="">Confirm Password</label>
			  <input size="50" type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Confirm Password" required>
			</div>
		  </div>
		  <div class="form-group">
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="gridCheck" required>
			  <label class="form-check-label" for="gridCheck">
				I agree to the <a href="" style="text-decoration: none" data-toggle="modal" data-target="#term">Terms and Condition</a>
			  </label>
			</div>
		  </div>

		  <div id="term" class="modal fade">  
          <div class="modal-dialog modal-xl">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h3 class="modal-title">Terms And Condition</h3>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  

                      <div class="modal-body" id="category_detail"> 
                      	<h5><b>User's Agreement</b></h5> 
			              <div class="form-group text-justify border overflow-auto pt-2 px-2" style="border-radius: 10px; overflow: scroll; height: 450px">
			            
			            <h8><b>Terms & Conditions</b></h8>
						<p>Please read these terms and conditions (“terms”, “terms and conditions”) carefully before using www.biologicsystemsph.com website operated by Biologic Systems Computer Center.</p>

						<h7><b>Conditions of Use</b></h7>

						<p>We will provide their services to you, which are subject to the conditions stated below in this document. Every time you visit this website, use its services or make a purchase, you accept the following conditions. This is why we urge you to read them carefully.</p>

						<h7><b>Privacy Policy</b></h7>

						<p>Before you continue using our website we advise you to read our privacy policy [link to privacy policy] regarding our user data collection. It will help you better understand our practices.</p>

						<h7><b>Copyright</b></h7>

						<p>Content published on this website (digital downloads, images, texts, graphics, logos) is the property of [name] and/or its content creators and protected by international copyright laws. The entire compilation of the content found on this website is the exclusive property of [name], with copyright authorship for this compilation by [name].</p>

						<h7><b>Communications</b></h7>

						<p>The entire communication with us is electronic. Every time you send us an email or visit our website, you are going to be communicating with us. You hereby consent to receive communications from us. If you subscribe to the news on our website, you are going to receive regular emails from us. We will continue to communicate with you by posting news and notices on our website and by sending you emails. You also agree that all notices, disclosures, agreements and other communications we provide to you electronically meet the legal requirements that such communications be in writing.</p>

						<h7><b>Trademark</b></h7>

						<p>Biologic Systems Computer Center trademarks may not be used in connection with any product or service that is not of ours, in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits Biologic Systems Computer Center . All other trademarks not owned by Biologic Systems Computer Center or its subsidiaries that appear on this site are the property of their respective owners.</p>

						<h7><b>License and Site Access</b></h7>

						<p>Biologic Systems Computer Center grants you a limited license to access and make personal use of this site and not to download (other than page caching) or modify it, or any portion of it, except with expressed written consent of Biologic Systems Computer Center. </p>

						<p>This license does not include any resale or commercial use of this site or its contents: any collection and use of any product listings, descriptions, or prices: any derivative use of this site or its contents: any downloading or copying of account information for the benefit of another merchant: or any use of data mining, robots, or similar data gathering and extraction tools. </p>

						<p>This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without expressed written consent of Biologic Systems Computer Center . </p>

						<p>You may not frame or utilize framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) of Biologic Systems Computer Center and our associates without express written consent. </p>

						<p>You may not use any meta tags or any other “hidden text” utilizing Biologic Systems Computer Center name or trademarks without the express written consent of Biologic Systems Computer Center. Any unauthorized use terminates the permission or license granted by Biologic Systems Computer Center.</p> 

						<p>You are granted a limited, revocable, and nonexclusive right to create a hyperlink to the home page of Biologic Systems Computer Center so long as the link does not portray Biologic Systems Computer Center, its associates, or their products or services in a false, misleading, derogatory, or otherwise offensive matter. </p>

						<p>You may not use any Biologic Systems Computer Center logo or other proprietary graphic or trademark as part of the link without express written permission.</p>

						<h7><b>Your Site Account</b></h7>

						<p>If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. If you are under 18, you may use our website only with involvement of a parent or guardian. Biologic Systems Computer Center and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion.
						REVIEWS, COMMENTS, EMAILS, AND OTHER CONTENT</p>

						<p>Visitors may post reviews, comments, and other content: and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of “spam.” </p>

						<p>You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content. </p>

						<p>Biologic Systems Computer Center reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.</p>

						<h7><b>RISK OF LOSS</b></h7>

						<p>All items purchased from Biologic Systems Computer Center are made pursuant to a shipment contract. This basically means that the risk of loss and title for such items pass to you upon our delivery to the carrier.</p>
						PRODUCT DESCRIPTIONS

						<p>Biologic Systems Computer Center and its associates attempt to be as accurate as possible. However, Biologic Systems Computer Center does not warrant that product descriptions or other content of this site is accurate, complete, reliable, current, or error-free. If a product offered by Biologic Systems Computer Center itself is not as described, your sole remedy is to return it in unused condition.</p> 

						<p>DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY THIS SITE IS PROVIDED BY BIOLOGIC SYSTEMS COMPUTER CENTER ON AN “AS IS” AND “AS AVAILABLE” BASIS. </p>

						<p>BIOLOGIC SYSTEMS COMPUTER CENTER MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK. </p>

						<p>BIOLOGIC SYSTEMS COMPUTER CENTER WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF THIS SITE, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES.</p>

						<h7><b>Applicable Law</b></h7>

						<p>By visiting this website, you agree that the laws of the Philippines, without regard to principles of conflict laws, will govern these terms and conditions, or any dispute of any sort that might come between Biologic Systems Computer Center and you, or your business partners and associates.</p>

						<h7><b>Disputes</b></h7>

						<p>Any dispute related in any way to your visit to this website or to products you purchase from us shall be arbitrated by courts in the Philippines and you consent to exclusive jurisdiction and venue of such courts.</p>

						<h7><b>Comments, Reviews, and Emails</b></h7>

						<p>Visitors may post comments as long as it is not obscene, illegal, defamatory, threatening, infringing of intellectual property rights, invasive of privacy or injurious in any other way to third parties. Content has to be free of software viruses, political campaign, and commercial solicitation.</p>

						<p>We reserve all rights (but not the obligation) to remove and/or edit such content.</p>

						<h7><b>User Account</b></h7>

						<p>If you are an owner of an account on this website, you are solely responsible for maintaining the confidentiality of your private user details (username and password). You are responsible for all activities that occur under your account or password.</p>

						<p>We reserve all rights to terminate accounts, edit or remove content and cancel orders in their sole discretion.</p>

						<h7><b>SITE POLICIES, MODIFICATION, AND SEVERABILITY</b></h7>

						<p>Please review our other policies, such as our Privacy and Returns policy, posted on this site. These policies also govern your visit to Biologic Systems Computer Center. We reserve the right to make changes to our site, policies, and these Terms and Conditions at any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p>

						<h7><b>QUESTIONS:</b></h7>

						<p>Questions regarding our Terms and Conditions, Privacy Policy, Return Policy, or other policy related material can be directed to our support staff by clicking on the “Contact Us” link. Or you can email us at: biologicsystemsph@gmail.com</p>
			                  
		                 </div>
		                
                      </div>
                      <div class="modal-footer">
                      	   <button type="button" class="btn btn-primary" onclick="check()" style="margin-right: 940px" data-dismiss="modal">Accept</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div> 
                </div>  
          </div>  
      </div>

		  <!--Add Profile Pic-->
		  <div id="category" class="modal fade">  
          <div class="modal-dialog modal-md">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h4 class="modal-title">Add Profile Picture</h4>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  
                    <form method="post">
                      <div class="modal-body" id="category_detail">  
			              <div class="form-group text-center">
			                  <img id="img" src="img/icons/admin.jpg" class="mb-2 rounded-circle" width="200" height="200" />
		                 </div> 
		                 <div class="text-center">
			                 <label for="set" class="btn btn-outline-primary set p-2" style="font-size: 12px; padding-left: 3px; cursor: pointer;"><i class="fas fa-plus-circle"></i> Add Profile Picture</label>
			                   <input type="file" id="set" class="form-control" id="inputimage" name="inputimage" accept="/image" style="display:none;" onchange="readURL(this);" />
		                 </div>
                      </div>  
                      <div class="modal-footer">
                           <input type="submit" class="btn btn-primary" name="bsave" value="Signup">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                    </form>
               </div>  
          </div>  
      </div>
		  <button class="btn btn-primary" data-toggle="modal" data-target="#category">Sign up</button>
		  <a class="btn btn-outline-primary ml-3" style="border:none;"href="login.php">Log in</a>
		</form>
		
		</div>
		<script type="text/javascript">
			function check() {
				    document.getElementById("gridCheck").checked = true;
			}
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
	</body>
</html>