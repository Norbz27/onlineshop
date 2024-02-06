<?php
	session_start();
	include_once('dbconnect.php');
	$msg = ''; $display ='';
	$bLogin = isset($_POST['bLogin']) ? $_POST['bLogin'] : '';
	if($bLogin == 'Login'){
		$fetch_user_exists = mysqli_query($conn, "select * from user_account where Username = '$_POST[username]' and Password = '$_POST[password]'") or die(mysqli_error($conn));

		$delivery_service = mysqli_query($conn, "select * from delivery_service where Username = '$_POST[username]' and Password = '$_POST[password]'") or die(mysqli_error($conn));
		
		if(mysqli_num_rows($fetch_user_exists) >= 1){
			$_SESSION['PASSWORD'] = $_POST['password'];
			$_SESSION['USERNAME'] = $_POST['username'];
			
			header("Location: index.php");
		}else if (mysqli_num_rows($delivery_service) >= 1) {
			$_SESSION['PASSWORD'] = $_POST['password'];
			$_SESSION['USERNAME'] = $_POST['username'];
			s
			header("Location: dashboard/delivery_service.php");
		}else if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
			header("Location: dashboard/admin.php");
		}else{
			$msg = '<div size="50" style="margin-top:-50px;" class="alert alert-danger text-center" role="alert">Invalid username and/or password, Please try again!</div>';
		}

		$result = mysqli_query($conn, "select User_ID from user_account where Username like '$_POST[username]' and Password  like '$_POST[password]'") or die(mysqli_error($conn));
		$result1 = mysqli_query($conn, "select * from delivery_service where Username = '$_POST[username]' and Password = '$_POST[password]'") or die(mysqli_error($conn));

		if(mysqli_num_rows($result) >= 1){
			while($rowUsers = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      			$u_id = $rowUsers['User_ID'];
      			$display = '<input size="50" type="hidden" class="form-control" id="user_id" name="user_id" value="'.$u_id.'">';
				$_SESSION['USER_ID'] = $u_id;
			}
		}else if(mysqli_num_rows($result1) >= 1){
			while($rowUsers = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
      			$u_id = $rowUsers['delivery_Id'];
      			$display = '<input size="50" type="hidden" class="form-control" id="user_id" name="user_id" value="'.$u_id.'">';
				$_SESSION['USER_ID'] = $u_id;
			}
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
	<link rel="import" href="index.php">
	<link rel="stylesheet" href="css/form.css">
	<script>
			
			
	</script>

	</head>
	<body style="background-image: url('img/login_back.jpg');">

		<div class="form" style="padding-bottom:87px; padding-top:140px; padding-right:80px;">
		<?php echo $msg; ?>
		<form action="login.php" method="post">
			<div class="form-row">
			<span class="title">
				Log in
			</span>
			</div>
			<div class="form-row">
				<div class="form-group">
					<label for="">Username</label>
					<?php echo $display; ?>
					<input size="50" type="text" class="form-control" id="username" name="username" placeholder="username" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group">
					<label for="">Password</label>
					<input size="50" type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
					<input style="margin-top:10px; margin-left: 2px;" type="checkbox" onclick="checked()"><i style="font-size:12px; font-style:none;">Show Password</i>
				</div>
			</div>
		  <input type="submit" style="margin-top:30px; width: 410px; height: 35px; margin-left: 13px" class="btn btn-primary" name="bLogin" id="login" value="Login"><br/>
		  <span class="ml-3" style="font-size: 13px">Dont have an account?</span><a type="submit" class="ml-1" style="margin-top:30px; border:none;font-size: 13px; font-style: italic;"href="Signup.php">Signup</a>
		</form>
		
		</div>
		<script type="text/javascript">
			function checked() {
				var x = document.getElementById("pass");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
	</body>
</html>