<?PHP session_start();
	include("../db_connect.php");
	//print_r($_POST);
	$UsernameTemp = cleaning($_POST['username']);
	$PasswordTemp = md5(cleaning($_POST['password']));
	
	$loginQuery = "SELECT * FROM Users WHERE Username ='" . $UsernameTemp . "' AND Password = '". $PasswordTemp."'";
	//echo $loginQuery;
	
	$results = $dbc->query($loginQuery);
	//if the user didn't enter a username/pass correctly
	if($dbc->error)
	{  ?>
		 <META HTTP-EQUIV="Refresh"
			  CONTENT="1; URL=http://rack-a-tack.club/staff/index.php?loginError=Y">
	 <? } 
	 else  // Username exists in the database
	 {
		while($row = $results->fetch_array())
		{
			$Staff_UserID = $row['UserID'];
			$Staff_LeagueID = $row['LeagueID'];
			$Staff_Username = $row['Username'];
		}
		$subQuery = "SELECT * FROM LeagueStaff WHERE UserID = ". $Staff_UserID. " AND LeagueID = ". $Staff_LeagueID;
		$subResults = $dbc->query($subQuery);
		if($dbc->error)
		{  ?>
			 <META HTTP-EQUIV="Refresh"
				  CONTENT="1; URL=http://rack-a-tack.club/staff/index.php?loginError=Y">
		 <? } 
		else
		{
			while($row = $subResults->fetch_array())
			{
				$Staff_UserID = $row['UserID'];
				$Staff_LeagueID = $row['LeagueID'];
				$Staff_StaffRankID = $row['StaffRankID'];
			}
			 $_SESSION['Staff_UserID'] = $Staff_UserID;
			 $_SESSION['Staff_LID'] = $Staff_LeagueID;
			 $_SESSION['Staff_Username'] = $Staff_Username;
			 $_SESSION['Staff_RankID'] = $Staff_StaffRankID;
			 $_SESSION['Staff_Logged_In'] = "Yes";
			 /*<META HTTP-EQUIV="Refresh"
				  CONTENT="0; URL=http://masterzcreations.com/college/capstone/index.php?action=already_logged_in"> */
				  ?>
			 <META HTTP-EQUIV="Refresh"
				  CONTENT="1; URL=http://rack-a-tack.club/staff/main.php">
		 <? } 
		 }?>
<head>
	<meta charset="utf-8">
	<title>Rack-A-Tack: Staff Login</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<div class="container">
			<div class="top">
				<h1 id="title" class="hidden"><span id="logo">Checking Login Credentials </span></h1>
			</div>
	</div>
</body>