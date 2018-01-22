<?PHP session_start();
	include("../../db_connect.php");
	
	function tournamentFormats($dbc)
	{
		$queryTypes = "SELECT * FROM TourneyType";
		$results = $dbc->query($queryTypes);
		$output_TourneyFormats = "<select name='TourneyType' required>
							<option value=''>Select Type</option>";
		while($row = $results->fetch_array())
		{
			$output_TourneyFormats .='<option value="'.$row["TourneyTypeID"].'">'. $row["TournamentTypeName"] .' ('.$row['TournamentTypeShortName']. ')</option>';
		}
		$output_TourneyFormats .="</select>";
		return $output_TourneyFormats;
	}
	function PlayersPerTeam($dbc)
	{
		$queryTypes = "SELECT * FROM PlayersPerTeam";
		$results = $dbc->query($queryTypes);
		$output_TourneyFormats = "<select name='PlayersPerTeam' required>
							<option value=''>Select #</option>";
		while($row = $results->fetch_array())
		{
			$output_TourneyFormats .='<option value="'.$row["PlayersPerTeamID"].'">'. $row["TournamentTypeName"] .' ('.$row['PlayersPerTeam']. ')</option>';
		}
		$output_TourneyFormats .="</select>";
		return $output_TourneyFormats;
	}
	
	function populateLocationsDDBox($dbc)
	{
		$queryRules = "SELECT * FROM Gamesite";
		$results = $dbc->query($queryRules);
		$output_GameRooms = "<select name='SelectedGameSite' required>
							<option value=''>Select Game</option>";
		while($row = $results->fetch_array())
		{
			$output_GameRooms .= "<option value='". $row["GamesiteID"]."'>" 
			. $row["GamesiteName"]." &nbsp;&nbsp;&nbsp;(". $row["GameURL"].")</option>\n";
			
		}
		
		return $output_GameRooms."</select>";
	}
		function populateGameLocationsDDBox($dbc)
		{
			$queryRules = "SELECT * FROM GameRoom";
			$results = $dbc->query($queryRules);
			$output_GameRooms = "<select name='SelectedGameSite' required>
								<option value=''>Select Game</option>";
			while($row = $results->fetch_array())
			{
				$output_GameRooms .= "<option value='". $row["GameRoomID"]."'>" 
				. $row["GameRoom"]. getGameSiteInfo($dbc, $row["GameSiteID"]). "</option>\n";
				
			}
			
			return $output_GameRooms."</select>";
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
	function populateFormatsDDBox($dbc)
	{
		$queryRules = "SELECT * FROM TourneyRules";
		$results = $dbc->query($queryRules);
		$output_formats = "<select name='SelectedGameFormat' required>
							<option value=''>Select Game Format</option>";
		while($row = $results->fetch_array())
		{
			$output_formats .= "<option value='". $row["RulesID"]."'>" . $row["RulesName"]."</option>\n";
		}
		return $output_formats."</select>";
	}
	function buildDate()
	{
		$monthsArray = array("January","February","March","April","May","June","July","August","September","October","November","December");
		$monthNumber = date("m");
		$monthName = date("F");
		$day = date("d");
		$monthsOutput ='<select name="Month" required><option value="'.$monthNumber.'">'. $monthName.'</option>';
		for($a = 0; $a < 9; $a++)
		{
			$monthsOutput.= '<option value="0'.$a.'">'.$monthsArray[$a].'</option>';
		}
		for($a = 10; $a < 12; $a++)
		{
			$monthsOutput.= '<option  value="'.$a.'">'.$monthsArray[$a].'</option>'; 
		}
		$monthsOutput.="</select>";
		$days = '<select  name="Day"><option value="'.$day.'">'. $day.'</option>';
		for($b = 1; $b < 32; $b++)
		{
			 $days.='<option value="'.$b.'">' . $b.'</option>';
		}
		$days.="</select>";
		$year = '<input style="width:70px; border:none;" name="year" value="'. date("Y").'">';
		return $monthsOutput . $days . $year;
	}
	
	function buildTime()
	{
		$hours = '<select name="StartHour" required>
				<option value="">H</option>
				<option  value="00">Midnight (12)</option>';
				for($a = 1; $a <= 11; $a++)
				{
					$hours.= '<option style="background-color:blue; color: white;" value="0'.$a.'">'.$a.' AM</option>'; 
				}
				$hours.='<option value="12" >Noon (12)</option>';
				for($a = 13; $a <= 23; $a++)
				{
					$i = $a-12;
				
					$hours.= '<option name="StartHour"  value="'.$a.'">'.$i.' PM</option>';
				}
				$hours.="</select>";
		$minutes ='<select name="StartMinute" required> <option name="StartMinute" value="">M</option>';
				for($i = 0; $i <= 59; $i++ )
				{
					if($i < 10)
					{
						$minutes .= '<option name="StartMinute" value="0'.$i.'">0'.$i.'</option>';
					}
					else
					{
						$minutes .='<option name="StartMinute" value="'.$i.'">'.$i.'</option>';
					}
				}
				$minutes.="</select>";
				
		return $hours. ":" . $minutes; 
	}
	function buildGameTimers()
	{
		$Timers = '<select name="GameTime" required><option value="">Select Game Time</option><option value="Classic"> (GP)Classic</option>
		<option value="Faster Turn"> (GP)Faster Turn</option>';
		 for($a = 5; $a <= 16; $a++)
				{
					if(($a != 9)&&($a != 11)&&($a != 12)&&($a != 13)&&($a != 14))
					$Timers.= '<option value="'.$a.' Minutes ('.$a.'/0)">'.$a.' Minutes ('.$a.'/0)</option>'; 
				}
				$Timers.="</select>";
		return $Timers;
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
                        <h3>Create Tourney</h3>
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
                        <a href="#" class="active-link" ><i class="fa fa-star "></i>Tourney Creation Steps</a>
					</li>
					<li >
                        <a href="#" >Name Tournament <span class="badge" style="float:right">Step 1</span></a>
					</li>
					<li >
                        <a href="#" >Choose Date & Time <span class="badge" style="float:right">Step 2</span></a>
					</li>
					<li >
                        <a href="#" >Choose Tournament Structure<br>-->Single Elimination, <br> one chance to lose, <br>-->Double Elimination, <br>2 chances to lose then out <br>-->Swiss,<br> Players Every round till 1 winner w/ no losses.<br><span class="badge" style="float:right">Step 3</span><br></a>
					</li>
					<li >
                        <a href="#" >Choose Players Per Team<span class="badge" style="float:right">Step 4</span></a>
					</li>
					<li >
                        <a href="#" >Choose Game Location<span class="badge" style="float:right">Step 5</span></a>
					</li>
					<li >
                        <a href="#" >Choose Game Format<span class="badge" style="float:right">Step 6</span></a>
					</li>
					<li >
                        <a href="#" >Choose Game Time<span class="badge" style="float:right">Step 7</span></a>
					</li>
					<li >
                        <a href="#" >Additional Information<span class="badge" style="float:right">Step 8</span></a>
					</li>
					<li >
                        <a href="#" >Confirm and Create Tourney<span class="badge" style="float:right">Step 9</span></a>
					</li>
                </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row"> 
                    <div class="col-md-12">
                     <h2>Tourney Creation</h2>   
                     <hr />
					 </div>
                </div>              
                 <!-- /. ROW  -->
                 <blockquote>
				 <form method="POST" action="ConfirmTourney.php">
					<h3>Tournament Name</h3>
					<input type="text" name="TournamentName" required> 
					<h3>Date of Tournament</h3>
						<h5 style="font-style: italic; position:relative; left:15px;" ><b>Note: </b>Today's date is pre-populated for you</h5>
					 <?=buildDate();?> 
					 <h3>Starting Time of First Round</h3>
					 <?=buildTime();?>
					 <h3>Tournament Structure</h3>
					<?=tournamentFormats($dbc);?>
					<h3>Players Per Team</h3>
					<h5 style="font-style: italic; position:relative; left:15px;" ><b>Note: </b>Currently 1 vs 1 is only working currently</h5>  
					<?=PlayersPerTeam($dbc);?>
					<h3>Tournament Game Location</h3>
					 <?=populateGameLocationsDDBox($dbc);?>
					<h3>Pick The Game format</h3>
					<?=populateFormatsDDBox($dbc);?> 
                    <h3>Game Time</h3>
					<?=buildGameTimers();?>
					<h3>Additional Information</h3>
					<textarea name="AT" cols=50, rows=5></textarea>
					<hr/>
					<button type="submit">Create Tournament</button> 

				</form>
              </blockquote>
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
