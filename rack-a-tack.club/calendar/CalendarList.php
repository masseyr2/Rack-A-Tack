<?PHP session_start();
	  include("../db_connect.php");
	  
	  function dateCheck()
	  {
		if(!(isset($_GET["date"])))
		{
			$date = date("Y-m-d");
			
		}
		else
		{
			$newDate = strtotime(cleaning($_GET["date"]));
			$date = date("Y-m-d", $newDate);
		}
		return $date;
	  }
	  function getAllTournaments($dbc, $date)
	  {
		$Query = "SELECT * FROM Tourney WHERE DATE(ScheduledDate) = '".$date . "'";
		
		
		$registerTable = "<table class='standing'>
							<tr>
								<th>#</th>
								<th> </th>
								<th>Tourney Name</th>
								<th># of Players</th>
								<th>Game Format</th>
								<th>Game Location</th>
								<th>Date & Time</th>
 
								</tr>";
		
		$results = $dbc->query($Query);
		 
		while($row = $results->fetch_array())
		{
			$registerTable.="<tr>
								<td>". $row["TourneySystemID"] . "</td>
								<td><a href='../tourney_check.php?N=".$row["TourneySystemID"] ."'> Register </a></td>
								<td><a href='../tourney.php?N=".$row["TourneySystemID"] ."'> ".$row["TourName"] . "</a></td>
								<td>" . getPlayerCount($dbc, $row["TourneySystemID"])."</td>
								<td>" . getGameFormat($dbc, $row["GameRulesID"])."</td>
								<td>". getGameLocation($dbc, $row["GameRoomID"])."</td>
								<td>". $row["ScheduledDate"]."<br>".$row["ScheduledTime"]. "</td>
								
							</tr>"; 
							 
		}
		$registerTable .="</table>";
		return $registerTable;
		
		
	  }
	  // Copied from staff/tourney/TourneyCollection.php
	  function getTourneyID($TourneyID)
	 {
		return $TourneyID;
	 }
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
	 function getGameFormat($dbc, $UserID)
	 {
		$usernameQ = "SELECT RulesName FROM  TourneyRules WHERE RulesID = ". $UserID;
		$results = $dbc->query($usernameQ);
		
		while($row = $results->fetch_array())
		{
			$Name = $row["RulesName"];
		}
		return $Name;
	 }
	 
	 function getPlayerCount($dbc, $TourneyID)
	 {
		$PlayerQ = "SELECT COUNT(TourneySystemID) as PlayerCount FROM TourneyRegister WHERE TourneySystemID =". $TourneyID;
		$results = $dbc->query($PlayerQ);
		
		while($row = $results->fetch_array())
		{
			$PlayerCount = $row["PlayerCount"];
		}
		return $PlayerCount;
	 }
	 
	 function getGameLocation($dbc, $RoomID)
	 {
		$GGLQ  = "SELECT * FROM GameRoom JOIN Gamesite ON GameRoom.GameSiteID = Gamesite.GamesiteID WHERE GameRoomID = ". $RoomID;
		$results = $dbc->query($GGLQ);
		
		while($row = $results->fetch_array())
		{
			$Name .= $row["GameRoom"]." @ ".$row["GamesiteName"]."<br>(". $row["GameURL"].")";
		}
		return $Name;
	 }
	 function getAllTourneys($dbc, $UserID, $LeagueID)
	 {
		$count = 1;
		$registerQ = "SELECT * FROM Tourney WHERE LeagueID = ". $LeagueID ." AND HostID = ". $UserID ." ORDER BY ScheduledDate DESC";
		//echo "<br>". $registerQ;
		$registerTable = "<table class='standing'>
							<tr>
								<th>#</th>
								<th> </th>
								<th>Tourney Name</th>
								<th># of Players</th>
								<th>Game Format</th>
								<th>Game Location</th>
								<th>Date & Time</th>
 
								</tr>";
		
		$results = $dbc->query($registerQ);
		 
		while($row = $results->fetch_array())
		{
			$registerTable.="<tr>
								<td>". $row["TourneySystemID"] . "</td>
								<td><a href='TourneyInfo.php?D=".$row["TourneySystemID"] ."'> <img src='../images/trash.png' class='trash' alt='Delete Tourney'> </a></td>
								<td><a href='TourneyInfo.php?N=".$row["TourneySystemID"] ."'> ".$row["TourName"] . "</a></td>
								<td>" . getPlayerCount($dbc, $row["TourneySystemID"])."</td>
								<td>" . getGameFormat($dbc, $row["GameRulesID"])."</td>
								<td>". getGameLocation($dbc, $row["GameRoomID"])."</td>
								<td>". $row["ScheduledDate"]."<br>".$row["ScheduledTime"]. "</td>
								
							</tr>"; 
							 
		}
		$registerTable .="</table>";
		return $registerTable;
	 }
	 
	 function getGameSiteInfo($dbc, $GSID)
		{
			$queryRules = "SELECT * FROM Gamesite WHERE GamesiteID= ". $GSID;
			$results = $dbc->query($queryRules);
			$output_GameRooms = " @ ";
			while($row = $results->fetch_array())
			{
				$output_GameRooms .= $row["GamesiteName"]."  --- (". $row["GameURL"].")";
				
			}
			
			return $output_GameRooms;
		}

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Rack-A-Tack League Calender</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
			<?PHP include("../nav.php"); ?> 
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
									Today's Date is: <?=dateCheck();?>
									<hr>
									<?=getAllTournaments($dbc, dateCheck()); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
							
								 								