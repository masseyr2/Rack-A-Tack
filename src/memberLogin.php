<?PHP session_start();
	include("db_connect.php");
	$tempUsername = cleaning($_POST["username"]);
	$tempPassword = cleaning($_POST["password"]);
	$tempPassword = md5($tempPassword);
	


	if((strcmp($_SESSION["member_logged_in"],"yes") == 0))
	{
		?> <META HTTP-EQUIV="Refresh"
          CONTENT="1; URL=http://rack-a-tack.club/"><?
	}
	else
	{
		
		$queryCheck = "SELECT * FROM Users WHERE LeagueID = 1 AND Username = '". $tempUsername. "' AND Password = '". $tempPassword."'";
		
		$results = $dbc->query($queryCheck);
		while($row = $results->fetch_array())
		{
			$Login_UserID = $row['UserID'];
			$Login_LeagueID = $row['LeagueID'];
			$Login_Username = $row['Username'];
		}
		$_SESSION["member_logged_in"] = "yes"; 
		$_SESSION["member_Username"] = $Login_Username;
		$_SESSION["LeagueID"] = $Login_LeagueID;
		$_SESSION["member_UserID"] = $Login_UserID;
		
		  ?>
	 <META HTTP-EQUIV="Refresh"
          CONTENT="1; URL=http://rack-a-tack.club/">
	  <?PHP
		
	}
?>
<head>
	<meta charset="utf-8">
	<title>Rack-A-Tack: Member Login</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="staff/css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="staff/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<div class="container">
			<div class="top">
				<h1 id="title" class="hidden"><span id="logo">Checking Login Credentials </span></h1>
			</div>
	</div>
</body>