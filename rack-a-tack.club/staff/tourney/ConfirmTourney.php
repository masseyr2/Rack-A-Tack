<?PHP session_start();
	include("../../db_connect.php");
	$LID = $_SESSION['Staff_LID'];
	$UserID = $_SESSION['Staff_UserID'];
	$Username = $_SESSION['Staff_Username'];
	$StaffRankID = $_SESSION['Staff_RankID'];
	
	//Tournament fields posted
	$TournamentName = addslashes(cleaning($_POST['TournamentName']));
	$Month = cleaning($_POST['Month']);
	$Day = cleaning($_POST['Day']);
	$year = cleaning($_POST['year']);
	$StartHour = cleaning($_POST['StartHour']);
	$StartMinute = cleaning($_POST['StartMinute']);
	$TourneyType = cleaning($_POST['TourneyType']);
	$PlayersPerTeam = cleaning($_POST['PlayersPerTeam']);
	$SelectedGameSite = cleaning($_POST['SelectedGameSite']);
	$SelectedGameFormat = cleaning($_POST['SelectedGameFormat']);
	$GameTime = cleaning($_POST['GameTime']);
	$AT = addslashes(cleaning($_POST['AT']));  
	
	function createTourney($dbc, $LID,$UserID,$TournamentName,$Month,$Day,$year,$StartHour,$StartMinute,$TourneyType,$PlayersPerTeam,$SelectedGameSite,$SelectedGameFormat,$GameTime,$AT)
	{
		$ScheduledDate = $year . "-" .$Month . "-" . $Day;
		$ScheduledTime = $StartHour.  ":" . $StartMinute . ":00";
		$INSERTQ = "INSERT INTO Tourney(LeagueID,
										HostID,
										TourName,
										TourneyTypeID,
										PlayersPerTeamID,
										GameRoomID,
										GameRulesID,
										GameTimer,
										ScheduledDate,
										ScheduledTime,
										AdditionalRules) VALUES(". $LID. "," 
																 . $UserID. ",'"
																 . $TournamentName. "',"
																 . $TourneyType. ","
																 . $PlayersPerTeam. ","
																 . $SelectedGameSite. ","
																 . $SelectedGameFormat. ",'"
																 . $GameTime. "','"
																 . $ScheduledDate. "','"
																 . $ScheduledTime. "','"
																 . $AT. "')";
		//echo $INSERTQ;
		$dbc->query($INSERTQ);
		if($dbc->error) { $response =  $dbc->error;}
		else 
		{
			$lastID = $dbc->insert_id;
			$newID = $lastID + 1000;
			$TourneySystemQ = "UPDATE Tourney SET TourneySystemID =". $newID ." WHERE TourneyID =". $lastID;
			//echo $TourneySystemQ;
			$dbc->query($TourneySystemQ);
			$response =  "<div id='Nextstep'>Your Tourney ID is " . $newID ."</div><a href='CreateTourney.php'>Schedule another tourney!</a>"; 
			 //header("Location: LeagueCreation.php");  
		}
		return $response;
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
					 <?=createTourney($dbc,$LID,$UserID,$TournamentName,$Month,$Day,$year,$StartHour,$StartMinute,$TourneyType,$PlayersPerTeam,$SelectedGameSite,$SelectedGameFormat,$GameTime,$AT);?>
					 
               
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
