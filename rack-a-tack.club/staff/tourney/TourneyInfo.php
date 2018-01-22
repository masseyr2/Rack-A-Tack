<?PHP session_start();
	include("../../db_connect.php");
	$LeagueID = cleaning($_SESSION["LID"]);
	$TourneyID = cleaning($_GET["N"]);
	$SystemID_Delete = cleaning($_GET["D"]);
	 
	 if(isset($_GET['D']))
	 {
		$deleteTourneyQ = "DELETE FROM Tourney WHERE TourneySystemID = ".$SystemID_Delete ;
		$dbc->query($deleteTourneyQ);
		if($dbc->error)
		{
			$response = "<div class='error'> Please contact Support with the error message: " . $dbc->error . "</div>";
			
		}
		else
		{
			$response ="It has been deleted.";
		}
		return $response;
	 }
	 
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
	 function getWhoIsRegistered($dbc, $TourneyID)
	 {
		$registerQ = "SELECT * FROM TourneyRegister WHERE TourneySystemID = ". $TourneyID;
		$count = 0;
		//echo $registerQ;
		$registerTable = "<table class='players'>
							<tr>
								<th>#</th>
								<th>Username</th>
								<th>Game Wins</th>
								<th>Game Losses</th>";
		$results = $dbc->query($registerQ);
		
		while($row = $results->fetch_array())
		{
			$count++;
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
			$output .= "<p>". $row['Rules'] ."</p>";
		}
		return $output;
	 }
	 function getLink($TourneyID)
	 {
		$Link = "http://rack-a-tack.club/tourney.php?N=" . $TourneyID;
		return "<a href='". $Link."'target='tourney'>Player's Registration</a>";
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
	.players{
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
                        <h3>Tourney Management</h3>
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
                        <a href="TourneyCollection.php" class="active-link" ><i class="fa fa-star "></i>Your Tourneys</a>
					</li>
					 
                </div>
 
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
					<div class="row"> 
						<div class="col-md-12">
						 <h2>Tourney # <?=getTourneyID($TourneyID);?></h2>   
						 <hr />
						 </div>
					</div>              
					 <!-- /. ROW  -->
					 <blockquote>
					  <h2>Quick Links</h2>
					   <?=getLink($TourneyID);?>
					 </blockquote>
					<h2>Players Table</h2>					
					<blockquote>
					  
					  <?=getWhoIsRegistered($dbc,  $TourneyID);?>
					  </blockquote>
						<h2>Tournament Game Rules</h2>
						<blockquote>
					  	<?=getTournamentRulesID($dbc,  $TourneyID);?>
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
