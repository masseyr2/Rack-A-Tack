<?php session_start();
	session_destroy();// destroy session, it will remove ALL session settings

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Rack-A-Tack: Member Logout</title>

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
			<h1 id="title" class="hidden"><span id="logo">Rack<span>-A-</span>Tack<br></span></h1>
		</div>
		<div class="login-box animated fadeInUp" style="height:30px; padding:10px;">
		 You are successfully Logged out!
		</div>
		<META HTTP-EQUIV="Refresh"
          CONTENT="2; URL=http://rack-a-tack.club">
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