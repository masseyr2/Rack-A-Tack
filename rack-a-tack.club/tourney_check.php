<?PHP session_start();
	include("db_connect.php");
	$LeagueID = cleaning($_SESSION["LID"]);
	$TourneyID = cleaning($_GET["N"]);
	$UserID = cleaning($_SESSION["member_UserID"]);
	
 ?>
<?PHP 
	
	function checkLogin()
	{
		if(!isset($_SESSION["member_logged_in"]))
		{
			$output_check = "<div class='alert'> are currently, not logged in. Please <a href='register.php'> your account</a>. Or <a href='memberLogin.html'>Login</a> and then return here to check in for the tournament.</div>";
		}
		else
		{
			$output_check = "<a href='tourney_check.php?N=".$_GET["N"]."'>Check-IN/Registration</a>"; 
		}
		return $output_check;
	
	}
	
	function registerForTourney($dbc, $TourneyID, $UserID)
	{
		$queryCheck = "SELECT * FROM TourneyRegister WHERE UserID = ". $UserID ." AND TourneySystemID = ". $TourneyID;
		$dbc->query($queryCheck);
		if(!$dbc->error)
		{
			$insertQuery = "INSERT INTO TourneyRegister (TourneySystemID, UserID) VALUES(". $TourneyID.",". $UserID.")";
			$dbc->query($insertQuery);
			if($dbc->error)
			{
				return "Please contact the host for assistance. ". $dbc->errorno;
			}
			else{ return "Thanks,". $_SESSION["member_Username"]. ", You are all checked in. <a href=tourney.php?N=". $TourneyID .">View Rules & Additional Info</a>"; }
		}
	}
	
	function getTourneyName($dbc, $TourneyID)
	{
		$TourneyNameQ = "SELECT TourName FROM Tourney WHERE TourneyID=".$TourneyID;
		$results = $dbc->query($TourneyNameQ);
		
		while($row = $results->fetch_array())
		{
			$name = $row["TourName"];
		}
		return $name; 
	}
	function getTourneyInfo($dbc, $TourneyID)
	{
		$TourneyInfo = "<table>
							<tr><th>Tourney #:</th><td>";
	
	}
	function getPlayers($dbc, $LeagueID, $TourneyID)
	 {
		$registerQ = "SELECT * FROM TourneyRegister WHERE LeagueID = ". $LeagueID ." AND TourneyID = ". $TourneyID;
		$registerTable = "<table class='players'>
							<tr>
								<th>#</th>
								<th>Username</th>
								<th>Game Wins</th>
								<th>Game Losses</th>";
		$results = $dbc->query($registerQ);
		
		while($row = $results->fetch_array())
		{
			$registerTable.="<tr>
								<td>". $count . "</td>
								<td>". getUsername($dbc, $row["UserID"]) . "</td>
								<td>". $row["GameWins"]."</td>
								<td>". $row["GameLosses"]. "</td>
							</tr>"; 
		}
		$registerTable .="</table>";
		return $registerTable;
	 }
	
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Rack-A-Tack Tourney Page</title>
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
	.players{
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
									<h1><a href="index.php" id="logo">Rack-A-Tack</a></h1>
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
												<h2>Rack-A-Tack Tourney Page: <?=getTourneyName($dbc,$TourneyID);?></h2>
												<pre><? //print_r($_SESSION);?></pre>
												<h3>Tourney Check-IN/Registration, Tourney Rules, and Statistics</h3>
												
											</header>
											 <?=registerForTourney($dbc,$TourneyID, $UserID); ?>
												
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