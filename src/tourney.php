<?PHP session_start();
	include("db_connect.php");
	$LeagueID = cleaning($_SESSION["LID"]);
	$TourneyID = cleaning($_GET["N"]);
	
 ?>
<?PHP
	function getUsername($dbc, $UserID)
	 {
		$usernameQ = "SELECT Username FROM  Users WHERE UserID = ". $UserID;
		$results = $dbc->query($usernameQ);
		
		while($row = $results->fetch_array())
		{
			$Name = $row["Username"];
		}
		return $Name;
	 }
 
	function checkLogin()
	{
		if(!isset($_SESSION["member_logged_in"]))
		{
			$output_check = "<div class='alert'>You are currently, not logged in. Please <a href='register.php'> register your account</a>. Or <a href='memberLogin.html'>Login</a> and then return here to check in for the tournament.</div>";
		}
		else
		{
			$output_check = "<a href='tourney_check.php?N=".$_GET["N"]."'>Check-IN/Registration for ". $_SESSION['member_Username']."</a>"; 
		}
		return $output_check;
	
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
	function getPlayers($dbc, $TourneyID)
	 {
		$registerQ = "SELECT * FROM TourneyRegister WHERE TourneySystemID = ". $TourneyID;
		//echo $registerQ;
		$count = 0;
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
			$count++;
		}
		$registerTable .="</table>";
		return $registerTable;
	 }
	function getTournamentRulesID($dbc, $TourneyID)
	 {
		$RulesSelectionQ = "SELECT GameRulesID, GameTimer, AdditionalRules FROM Tourney WHERE TourneySystemID = ". $TourneyID;
		//echo $RulesSelectionQ;
		$results = $dbc->query($RulesSelectionQ);
		
		while($row = $results->fetch_array())
		{
			$output = getTournamentRules($dbc, $row['GameRulesID']);
			$output .= $row['AdditionalRules'];
			$output .= "<br>Timer: ". $row['GameTimer'];
		}
		return $output;
	 }
	 function getTournamentRules($dbc, $RulesID)
	 {
		$RulesSelectionQ = "SELECT * FROM TourneyRules WHERE RulesID = ". $RulesID;
		$results = $dbc->query($RulesSelectionQ);
		//echo "<br>". $RulesSelectionQ;
		while($row = $results->fetch_array())
		{
			$output = "<h4>". $row['RulesName'] ."</h4>";
			$output .= "". $row['Rules'] ."";
		}
		return $output;
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
												<h3>Tourney Check-IN/Registration, Tourney Rules, and Statistics</h3>
												<p> <?=checkLogin();?></p>
											</header>
											<?=getTourneyInfo($dbc, $TourneyID);?>
											<?=getPlayers($dbc, $TourneyID);?>
											<hr>
											<h2>Tournament Game Rules</h2>
											<blockquote style='width:95%; display: block;margin-left:auto; margin-right:auto;'>
											<?=getTournamentRulesID($dbc,  $TourneyID);?>
										  </blockquote>	
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