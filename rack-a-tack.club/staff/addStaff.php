<?PHP session_start();

include("../db_connect.php");

	function getStaff($dbc) // , $LeagueID = 1;
	{
		$count = 1;
		$membersQuery = "SELECT * FROM LeagueStaff WHERE LeagueID = 1 ORDER BY StaffRankID DESC";
		//echo $membersQuery;
		$results = $dbc->query($membersQuery);
		$tableHeader = "<table class='standing'>
							<tr>
								<th>Count</th>
								<th>Username</th>
								<th>Current Rank</th>
								<th>Completed Tournaments</th>
								<th>Staff Since</th>
								<th>Status</th>
								<th>Edit/Remove</th> 
							</tr>";
		while($row = $results->fetch_array())
		{
			$UserIDTemp = $row['UserID'];
			$StaffRankID = $row['StaffRankID'];
			//echo "UserID = ". $UserIDTemp . "<br>";
			$tableBody .= "<tr>
							   <td>". $count ." 
							  <td>". getUsername($dbc, $UserIDTemp) ."</td>
							  <td>". getCurrentRank($dbc, $StaffRankID) ."</td>
							  <td>". getCompletedTourneys($dbc, $UserIDTemp) ."</td> 
							  <td>". getStaffSince($dbc, $UserIDTemp) ."</td> 
							  <td>". getStaffStatus($dbc, $UserIDTemp) ."</td> 
							  <td> <a href='#'><i class=\"fa fa-pencil-square-o fa-2x\"></i></a> 
							       <a href='#'><i class=\"fa fa-trash-o fa-2x\"></i></a></td>
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
	function getCurrentRank($dbc, $RankID)
	{
		$subQuery = "SELECT * FROM LeagueStaffRanking WHERE StaffRankID = ". $RankID;
		$subResults = $dbc->query($subQuery);
		while($row = $subResults->fetch_array())
		{
			$returnName = $row['StaffRank']; 
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
	function getAllUsers($dbc, $LeagueID)
	{
		$subQuery = "SELECT * FROM Users WHERE LeagueID = ". $LeagueID;
		$subResults = $dbc->query($subQuery);
		$output = "<select name='NewStaffAppoint'>
		                <option value='0'> Select</option>\n\t\t\t\t\t\t";
		while($row = $subResults->fetch_array())
		{
			$UserID = $row['UserID'];
			$Username = $row['Username'];
			$output .= "<option value='". $UserID. "'>". $Username."</option>\n\t\t\t\t\t\t";
			 
		}
		return $output . "
		</select>";
	}
	function getAllRanks($dbc)
	{
		$subQuery = "SELECT * FROM LeagueStaffRanking";
		$subResults = $dbc->query($subQuery);
		$output = "<select name='NewAssignedRank'>
		                <option value='0'> Select</option>\n\t\t\t\t\t\t";
		while($row = $subResults->fetch_array())
		{
			$RankID = $row['StaffRankID'];
			$Rank = $row['StaffRank'];
			$output .= "<option value='". $RankID . "'>". $Rank."</option>\n\t\t\t\t\t\t";
			 
		}
		return $output . "
		</select>";
	}
	function addNewStaffMember($dbc, $LeagueID, $UserID, $RankID)
	{
		$InsertQuery = "INSERT INTO LeagueStaff(LeagueID, UserID, StaffRankID, StatusLevelID) VALUE(". $LeagueID.",". $UserID .",". $RankID. ", 3)";
		$dbc->query($InsertQuery);
		if($dbc->errorno)
		{
			return $dbc->error;
		}
		else
		{
			return "Addition Successful";
		}
	}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rack-A-Tack Admin Area</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
	th{ text-align:center;}
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
                        <h2 class="textLogo">Rack-A-Tack Management</h2>
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
					<li class="active-link">
                        <a href="main.php" ><i class="fa fa-desktop "></i>Main Menu <span class="badge">All</span></a> 
                    </li>
                    <?PHP if($_SESSION['StaffRankID'] >= 3){ ?>
					<li>
                        <a href="admin.php" ><i class="fa fa-desktop "></i>Admin Tools<span class="badge">Level 3+</span></a>
                    </li>
                   <? }?>
					<?PHP if($_SESSION['StaffRankID'] >= 2){ ?>
                    <li>
                        <a href="ui.html"><i class="fa fa-table "></i>HTD Tools  <span class="badge">Level 2</span></a>
                    </li>
					 <? }?>
					<?PHP if($_SESSION['StaffRankID'] >= 1){ ?>
                    <li>
                        <a href="blank.html"><i class="fa fa-edit "></i>TD Tools  <span class="badge">Level 1</span></a>
                    </li>
					<? } ?>

                </ul>
			</div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Staff List </h2>   
                    </div>
                </div>    

					 
                 <!-- /. ROW  -->
                  <hr />
					<?PHP echo getStaff($dbc); ?> 
                 <!-- /. ROW  -->  
					<div class="row">
                    <div class="col-md-12">
                     <h2>Add New Staff</h2>   
                    </div>
                </div> 	
					<form name ="NewStaffAppointForm" method="POST" action="addStaff.php">
						<h3>Choose the Username ----- Choose the Ranking</h3>
						<h4><?=getAllUsers($dbc, 1); ?>   <?=getAllRanks($dbc); ?></h4>
						<input type="hidden" value="AddYes" name="Add1"> 
						 <input type="submit" value="submit" name="submit"> 
					</form>
					
					<?PHP
						if($_POST['Add1'])
						{
							?>
								<pre>
			<?print_r($_POST);?>  
			</pre> 
							<h3>Add <? echo getUsername($dbc, $_POST['NewStaffAppoint']); ?> as a <?=getCurrentRank($dbc,  $_POST['NewAssignedRank']); 
							
							$_SESSION["NewStaffAppoint"] = $_POST['NewStaffAppoint'];
							$_SESSION["NewStaffMemberName"] = getUsername($dbc, $_POST['NewStaffAppoint']);
							$_SESSION["NewAssignedRank"] = $_POST['NewAssignedRank'];
							?>  <pre> <? print_r($_SESSION);?> </pre>
							 
							
							<form name ="NewStaffAppointFormConfirm" method="POST" action="addStaff.php">
								<input type="hidden" name="AddUserID" value="<?=$_SESSION["NewStaffAppoint"]; ?>"> 
								<input type="hidden" name="AddRank" value="<?=$_SESSION["NewAssignedRank"]; ?>"> 
								<input type="Submit" name="YesButton" value="Yes">
								<input type="Button" name="NoButton" value="No">
								<input type="hidden" value="AddYes" name="Add2"> 
						  
							</form>
							<?PHP 
						}
						if($_POST['YesButton'])
						{
							echo addNewStaffMember($dbc, 1, $_SESSION["NewStaffAppoint"], $_SESSION["NewAssignedRank"]);
							
					?><pre>
			<?print_r($_POST);
			}?>  
			</pre> 
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
			
    
             <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;"  target="_blank">www.binarytheme.com</a>
                </div>
        </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>