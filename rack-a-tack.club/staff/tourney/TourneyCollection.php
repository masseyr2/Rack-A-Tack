<?PHP session_start();
	include("../../db_connect.php");
	$UserID = cleaning($_SESSION["Staff_UserID"]);
	$LeagueID = cleaning($_SESSION["Staff_LID"]);
	$TourneyID = cleaning($_GET["N"]);
	 
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
	 function getTourneys($dbc, $UserID, $LeagueID)
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
	 function getOtherTourneys($dbc, $UserID, $LeagueID)
	 {
		$count = 1;
		$registerQ = "SELECT * FROM Tourney WHERE LeagueID = ". $LeagueID ." AND HostID != ". $UserID ." ORDER BY ScheduledDate DESC";
		//echo "<br>". $registerQ;
		$registerTable = "<table class='standing'>
							<tr>
								<th colspan='2'>#</th>
								<th>Director</th>
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
								<td>". getUsername($dbc,$row["HostID"]) . "</td>
								
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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tourney Creation</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
	 <link href="../assets/css/jquery.timepicker.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
	th{
		text-align:center;
	}
	td{
		border: 3px solid black; 
	}

</style>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
						  
                        <h2>Tourney Collection for <?=$_SESSION["Staff_Username"]; ?></h2>    
                    </a>
                </div>
              
                 <span class="logout-spn" >
                  <a href="#" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li >
                        <a href="../main.php" ><i class="fa fa-home "></i>Main Page </a>
					</li>
					<li >
                        <a href="CreateTourney.php" class="active-link" ><i class="fa fa-star "></i>New Tourney </a>
					</li>
					 
                </div>
 
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row"> 
                    <div class="col-md-12">
                     
                     <hr />
					 <blockquote>
						<?=getTourneys($dbc, $UserID, $LeagueID);?>  
					</blockquote>
					<?PHP 
					   if($_SESSION["Staff_RankID"] >= 2)
						{ ?>
					      <blockquote><H2>Other Director's Tournaments</h2>
						       <?=getOtherTourneys($dbc,$UserID, $LeagueID);?>  
					      </blockquote>
					<?	} ?>
					 </div>
                </div>              
                 <!-- /. ROW  -->
                 
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
             <div class="row">
                <div class="col-lg-12" >
                    
                </div>
        </div>
        </div>
          <script type='text/javascript'> 
		 
</script>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
	<script src="../assets/js/jquery.timepicker.js"></script>
	<script src="moment.js"></script>
    <script src="combodate.js"></script>
   
</body>
</html>
