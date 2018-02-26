<!DOCTYPE html>
<html lang="en">
<?php
	include("db_connect.php");
		 
		if(isset($_POST['submit']))
		{
		$tempUsername = cleaning($_POST["username"]);
	    $tempPassword = cleaning($_POST["password"]);
	    $tempPassword = md5($tempPassword);
		
		function isInvalidUsername($tempUsername)
		{
			global $dbc;
			
			$r = $dbc->query("SELECT * FROM Users Where Username = '". $tempUsername. "'");
			
			if(mysqli_num_rows($r) == 0)
			{
				
				return true;
			}
			
			return false;
			
		}
		
		function isInvalidPassword($tempPassword, $tempUsername)
		{
			global $dbc;
			$r2 = $dbc->query("SELECT Password FROM Users Where Username = '". $tempUsername. "'");
			
			if($tempPassword != $r2->fetch_Object()->Password)
			{
				return true;
			}
			return false;
			
		}
		if(isInvalidUsername($tempUsername))
		{
			$errorUser = "username does not exist";
			
		}
		
		else if(isInvalidPassword($tempPassword, $tempUsername))
		{
			$errorPassword = "password is not correct";
		}
		
		
		else
		{
			echo '<script>window.location.href = "memberLogin.php";</script>';
		}
		}
			
	?>
<head>
	<meta charset="utf-8">
	<title>Rack-A-Tack: Member Login</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="staff/css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="staff/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Rack<span>-A-</span>Tack<br><span class="smallerHeading">Member Login</span></span></h1>
		</div>
		<div class="login-box animated fadeInUp">
		<form method="POST" action="memLogin.php"> 
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<label for="username">Username</label>
			<br/>
			<input type="text" id="username" name="username" required> 
			<br/>
			<?php echo $errorUser ?>
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" name="password" id="password" required>
			<br/>
			<?php echo $errorPassword ?>
			<br/>
			<button id = "submitButton" type="submit" name="submit">Sign In</button>
			<br/>
			<a href="#"><p class="small">Forgot your password?</p></a>
			</form>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});

	
</script>

</html>
