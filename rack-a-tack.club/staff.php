<?PHP session_start();
	$LeagueID = 1;
	include("db_connect.php");
 ?>
<?PHP 
	/* foreach ($_POST as $key => $val) { $t = $key; $$t = $val;
		// echo "POST -- KEYS = " . $t . "AND Values = " . $$t . "<br>";
		$tempK = strtolower($t);
		$tempV = strtolower($$t);
		// echo "POST -- KEYS = " . $tempK . "AND Values = " . $tempV . "<br>";
		if(strpos($tempV,"select") > 0) {
			exit("We are sorry, you are trying to access an invalid area....") ;
			 }
		if(strpos($tempV,"file") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }
		if(strpos($tempV,"rand(") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	 
		if(strpos($tempV,"'0=") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempV,"_schema") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempV,"etc") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempV,"passwd") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempV,"union") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
			 
		if(strpos($tempK,"select") > 0) {
			exit("We are sorry, you are trying to access an invalid area....") ;
			 }
		if(strpos($tempK,"file") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }
		if(strpos($tempK,"rand(") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	 
		if(strpos($tempK,"'0=") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempK,"_schema") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempK,"etc") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempK,"passwd") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ;
			 }	
		if(strpos($tempK,"union") > 0) {
			exit("We are sorry, we are not accepting your input at this time....") ; 
			 }	

	 } */
	
	function getStaff($dbc, $rankID) // , $LeagueID = 1;
	{
		$count = 1;
		$membersQuery = "SELECT * FROM LeagueStaff WHERE LeagueID = 1 AND StaffRankID = ". $rankID;
		//echo $membersQuery;
		$results = $dbc->query($membersQuery);
		$tableHeader = "<table class='standing'>
							<tr>
								<th>Username</th>
								<th>Completed Tournaments</th>
								<th>Staff Since</th>
								<th>Status</th>
								 
							</tr>";
		while($row = $results->fetch_array())
		{
			$UserIDTemp = $row['UserID'];
			//echo "UserID = ". $UserIDTemp . "<br>";
			$tableBody .= "<tr>
							  <!-- <td>". $count ."</td> -->
							  <td>". getUsername($dbc, $UserIDTemp) ."</td>
							  <td>". getCompletedTourneys($dbc, $UserIDTemp) ."</td> 
							  <td>". getStaffSince($dbc, $UserIDTemp) ."</td> 
							   <td>". getStaffStatus($dbc, $UserIDTemp) ."</td> 
							</tr>";
							$count++;
		}
		$tableEnd = "</table>";
		$CompletedTable = $tableHeader . $tableBody . $tableEnd;
		return $CompletedTable;
	}
	function getUsername($dbc, $UserID)
	{
		$subQuery = "SELECT Username FROM Users WHERE UserID = ". $UserID;
		$subResults = $dbc->query($subQuery);
		while($row = $subResults->fetch_array())
		{
			$returnName = $row['Username'];
		}
		return $returnName . "";
	}
	function getCompletedTourneys($dbc, $UserID)
	{
		$subQuery = "SELECT * FROM LeagueStaff WHERE UserID = ". $UserID;
		$subResults = $dbc->query($subQuery);
		while($row = $subResults->fetch_array())
		{
			$returnName = $row['CompletedTourneys'];
		}
		return $returnName . "";
	}
	function getStaffSince($dbc, $UserID)
	{
		$subQuery = "SELECT * FROM LeagueStaff WHERE UserID = ". $UserID;
		$subResults = $dbc->query($subQuery);
		while($row = $subResults->fetch_array())
		{
			$newDate = strtotime($row['StaffSince']);
			$returnName = date("M d, Y",$newDate) ;
		}
		return $returnName . "";
	}
	function getStaffStatus($dbc, $UserID)
	{
		$subQuery = "SELECT * FROM LeagueStaff JOIN LeagueStaffStatus ON LeagueStaff.StatusLevelID = LeagueStaffStatus.StaffStatusID  WHERE UserID = ". $UserID;
		$subResults = $dbc->query($subQuery);
		while($row = $subResults->fetch_array())
		{
			$returnName = $row['StatusLevel'];
		}
		return $returnName . "";
	}
	?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Rack-A-Tack Staff</title>
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
		width:70%; margin-left:auto;margin-right:auto; display:block;
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
												<h2>League Staff</h2>
											</header>
											<h3>Admin Team</h3>
											<p>
											<?PHP echo getStaff($dbc, 4); ?>
											<p/>
											<p>
											<?PHP echo getStaff($dbc, 3); ?>
											</p>
											<h3>Head Tournament Directors</h3>
											<p>
											<?PHP echo getStaff($dbc, 2); ?>
											</p>
											<h3>Tournament Directors</h3>
											<p>
											<?PHP echo getStaff($dbc, 1); ?>
											</p>
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
					&copy; Masterz.us  All rights reserved. | Design: <a href="http://html5up.net">HTML5</a>
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