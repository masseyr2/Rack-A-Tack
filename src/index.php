<?PHP session_start();
	$_SESSION['LID'] = 1;
	 
	
?>
<!DOCTYPE HTML>
<!--
	Halcyonic by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Rack-A-Tack Tournaments</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">
						<div class="row">
							<div class="12u">

								<!-- Logo -->
									<h1><a href="#" id="logo"  ><br>Rack-A-Tack<br><span class="LogoTours">Tournaments</span></a></h1>

								 <?PHP include("nav.php"); 
									if($_SESSION['member_logged_in'] == "yes") 
									{
										echo menu(1);
									}
									else
									{
										echo menu(0);
									}
									
								 ?>

							</div>
						</div>
					</header>
					<div id="banner">
						<div class="container">
							<div class="row">
								<div class="6u 12u(mobile)">

									<?php if($_SESSION['member_logged_in'] == "yes")
									{
										$banner = "<!-- Banner Copy -->
										<p>Welcome to Rack-A-Tack <span class='NameLoggedIn'>" . $_SESSION["member_Username"]. "</span> </p>";
										
									}
									else
									{
										$banner ='<!-- Banner Copy -->
										<p>Do you like playing word board games with twists? Do you like competitions?  (New Homepage) </p>
										<a href="register.php" class="button-big">Register</a>
										<a href="memberLogin.html" class="button-big">Login</a>';
									} 
									 echo $banner;
									
									?>
									
								</div>
								<div class="6u 12u(mobile)">

									<!-- Banner Image -->
										<a href="#" class="bordered-feature-image"><img src="images/ComingSoon.jpg" alt="" /></a>

								</div>
							</div>
						</div>
					</div>
				</div> 

			<!-- Features -->
				<div id="features-wrapper">
					<div id="features">
						<div class="container">
							<div class="row" style="height:600px;">
								
							</div>
						</div>
					</div>
				</div>

			<!-- Content -->
				<div id="content-wrapper">
					<div id="content">
						<div class="container">
							<div class="row">
								<div class="4u 12u(mobile)">
									<!--<h2> Statistics and Other Fun Information will be coming in the future.</h2>
									 Box #1 
										<section>
											<header>
												<h2>Who We Are</h2>
												<h3>A subheading about who we are</h3>
											</header>
											<a href="#" class="feature-image"><img src="images/pic05.jpg" alt="" /></a>
											<p>
												Duis neque nisi, dapibus sed mattis quis, rutrum accumsan sed.
												Suspendisse eu varius nibh. Suspendisse vitae magna eget odio amet mollis
												justo facilisis quis. Sed sagittis mauris amet tellus gravida lorem ipsum.
											</p>
										</section>
								-->
								</div>
								<!-- <div class="4u 12u(mobile)">

									<!-- Box #2 
										<section>
											<header>
												<h2>What We Do</h2>
												<h3>A subheading about what we do</h3>
											</header>
											<ul class="check-list">
												<li>Sed mattis quis rutrum accum</li>
												<li>Eu varius nibh suspendisse lorem</li>
												<li>Magna eget odio amet mollis justo</li>
												<li>Facilisis quis sagittis mauris</li>
												<li>Amet tellus gravida lorem ipsum</li>
											</ul>
										</section>

								</div>
								<div class="4u 12u(mobile)">

									<!-- Box #3 
										<section>
											<header>
												<h2>What People Are Saying</h2>
												<h3>And a final subheading about our clients</h3>
											</header>
											<ul class="quote-list">
												<li>
													<img src="images/pic06.jpg" alt="" />
													<p>"Neque nisidapibus mattis"</p>
													<span>Jane Doe, CEO of UntitledCorp</span>
												</li>
												<li>
													<img src="images/pic07.jpg" alt="" />
													<p>"Lorem ipsum consequat!"</p>
													<span>John Doe, President of FakeBiz</span>
												</li>
												<li>
													<img src="images/pic08.jpg" alt="" />
													<p>"Magna veroeros amet tempus"</p>
													<span>Mary Smith, CFO of UntitledBiz</span>
												</li>
											</ul>
										</section>

								</div> -->
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="8u 12u(mobile)"><pre>
								<? print_r($_SESSION);?></pre>
								<!-- Links 
									<section>
										<h2>Links to Important Stuff</h2>
										<div>
											<div class="row">
												<div class="3u 12u(mobile)">
													<ul class="link-list last-child">
														<li><a href="#">Neque amet dapibus</a></li>
														<li><a href="#">Sed mattis quis rutrum</a></li>
														<li><a href="#">Accumsan suspendisse</a></li>
														<li><a href="#">Eu varius vitae magna</a></li>
													</ul>
												</div>
												<div class="3u 12u(mobile)">
													<ul class="link-list last-child">
														<li><a href="#">Neque amet dapibus</a></li>
														<li><a href="#">Sed mattis quis rutrum</a></li>
														<li><a href="#">Accumsan suspendisse</a></li>
														<li><a href="#">Eu varius vitae magna</a></li>
													</ul>
												</div>
												<div class="3u 12u(mobile)">
													<ul class="link-list last-child">
														<li><a href="#">Neque amet dapibus</a></li>
														<li><a href="#">Sed mattis quis rutrum</a></li>
														<li><a href="#">Accumsan suspendisse</a></li>
														<li><a href="#">Eu varius vitae magna</a></li>
													</ul>
												</div>
												<div class="3u 12u(mobile)">
													<ul class="link-list last-child">
														<li><a href="#">Neque amet dapibus</a></li>
														<li><a href="#">Sed mattis quis rutrum</a></li>
														<li><a href="#">Accumsan suspendisse</a></li>
														<li><a href="#">Eu varius vitae magna</a></li>
													</ul>
												</div>
											</div>
										</div>
									</section>
							-->
							</div>
							<div class="4u 12u(mobile)">

								<!-- Blurb
									<section>
										<h2>An Informative Text Blurb</h2>
										<p>
											Duis neque nisi, dapibus sed mattis quis, rutrum accumsan sed. Suspendisse eu
											varius nibh. Suspendisse vitae magna eget odio amet mollis. Duis neque nisi,
											dapibus sed mattis quis, sed rutrum accumsan sed. Suspendisse eu varius nibh
											lorem ipsum amet dolor sit amet lorem ipsum consequat gravida justo mollis.
										</p>
									</section>
							-->
							</div>
						</div>
					</footer>
				</div>

			<!-- Copyright -->
				<div id="copyright">
					&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 UP</a>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>