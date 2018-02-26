<?PHP session_start();
	$LeagueID = 1;
	include("db_connect.php");
 ?>
<?PHP 
	function getStandings($dbc, $LeagueID)
	{
		$count = 1;
		$membersQuery = "SELECT * FROM Users WHERE LeagueID = 1 ORDER BY CurrentRating DESC";
		$results = $dbc->query($membersQuery);
		$tableHeader = "<table class='standing'>
							<tr>
								<th>#</th>
								<th>Username</th>
								<th>Current Rating</th>
								<th>Highest Rating</th>
								<th>Highest Ranking</th>
								<th>Game Wins</th>
								<th>Game Losses</th>
								<th>Tournament Wins</th>
								<th>Tournament Losses</th>
							</tr>";
		while($row = $results->fetch_array())
		{
			$tableBody .= "<tr>
							  <td>". $count ."</td>
							  <td>". $row['Username'] ."</td>
							  <td>". $row['CurrentRating'] ."</td>  
							  <td>". $row['HighestRating'] ."</td>
							 <td>".  $row['HighestRanking']."</td>
							  <td>". $row['GameWins'] ."</td>
							  <td>". $row['GameLosses'] ."</td>
							  <td>". $row['TourWins'] ."</td>
							 <td>".  $row['TourCount'] ."</td>
							</tr>";
							$count++;
		}
		$tableEnd = "</table>";
		$CompletedTable = $tableHeader . $tableBody . $tableEnd;
		return $CompletedTable;
	}
	
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Rack-A-Tack League Member Standings</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<style>
	form{
		width:50%; margin-left:auto;margin-right:auto; display:block; text-align:center;
	}
	input{
		width:50%; margin-left:auto;margin-right:auto; display:block;
	}
	.standing{
		width: 100%; border: 5px solid silver;
		text-align:center;
		
	}
	table{
	margin-left: auto; margin-right:auto; 
	}
	td{
		border: 3px solid black; 
	}
	</style>
	<body class="subpage">
		<div id="page-wrapper">
		<!-- Header -->
						<div id="header-wrapper">
							<header id="header" class="container">
								<div class="row">
									<div class="12u">

								<!-- Logo -->
									<h1><a href="#" id="logo"  ><br>Rack-A-Tack<br><span class="LogoTours">Tournaments</span></a></h1>
			<?PHP include("nav.php"); ?>
									</div>
								</div>
							</header>
						</div>
			<!-- Content -->
				<div id="content-wrapper">
					<div id="content">
						<div class="container">
							<div class="row">
								<div class="12u">

									<!-- Main Content -->
										<section>
											<header>
												<h2>League Standings</h2>
												<h3>Where are you ranked currently?</h3>
											</header>
											<?PHP
											 echo getStandings($dbc, $LeagueID);
											?>
												
										</section>

								</div>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="8u 12u(mobile)">
 
								 
						</div>
					</footer>
				</div>

			<!-- Copyright -->
				<div id="copyright">
					&copy; Rack-A-Tack.club  All rights reserved. | Design: <a href="http://html5up.net">Ryan Massey, Masterz.us</a>
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