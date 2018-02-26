<?PHP
									if($_SESSION['member_logged_in'] == "yes") 
									{
										echo menu(1);
									}
									else
									{
										echo menu(0);
									}								 

function menu($login)
{
	if($login == 1)
	{
		$menu = ' 				<!-- Nav -->
									<nav id="nav">
										<a href="/index.php">Home</a>
										<a href="/calendar/CalendarList.php">Today\'s Tournaments</a>
										<a href="/calendar/">Calendar</a>
										<a href="/ranking.php">Standings</a>
										<a href="/staff.php">Directors</a>
										<a href="/staff">Staff Login</a>
										<a href="/logout.php">Logout</a>
										
									</nav>';
	}
	else
	{
		$menu = ' 				<!-- Nav -->
									<nav id="nav">
										<a href="/index.php">Home</a>
										<a href="/register.php">Join League</a>
										<a href="/memLogin.php">Member Login</a>
										<a href="/staff.php">Directors</a>
										<a href="/staff">Staff Login</a>
										
									</nav>';
	}
	

					
		return $menu;
}			