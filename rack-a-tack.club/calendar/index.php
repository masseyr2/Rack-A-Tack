<?PHP session_start();
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
									<div id="calendar">
												<?PHP
											// Get current year, month and day
										list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

										// Get current year and month depending on possible GET parameters
										if (isset($_GET['month'])) {
											list($iMonth, $iYear) = explode('-', $_GET['month']);
											$iMonth = (int)$iMonth;
											$iYear = (int)$iYear;
										} else {
											list($iMonth, $iYear) = explode('-', date('n-Y'));
										}

										// Get name and number of days of specified month
										$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
										list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

										// Get previous year and month
										$iPrevYear = $iYear;
										$iPrevMonth = $iMonth - 1;
										if ($iPrevMonth <= 0) {
											$iPrevYear--;
											$iPrevMonth = 12; // set to December
										}

										// Get next year and month
										$iNextYear = $iYear;
										$iNextMonth = $iMonth + 1;
										if ($iNextMonth > 12) {
											$iNextYear++;
											$iNextMonth = 1;
										}

										// Get number of days of previous month
										$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

										// Get numeric representation of the day of the week of the first day of specified (current) month
										$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

										// On what day the previous month begins
										$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

										// If previous month
										$bPreviousMonth = ($iFirstDayDow > 0);

										// Initial day
										$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

										$bNextMonth = false;
										$sCalTblRows = '';

										// Generate rows for the calendar
										for ($i = 0; $i < 5; $i++) { // 6-weeks range
											$sCalTblRows .= '<tr>';
											for ($j = 0; $j < 7; $j++) { // 7 days a week

												$sClass = '';
												if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
													$sClass = 'today';
												} elseif (!$bPreviousMonth && !$bNextMonth) {
													$sClass = 'current';
												}
												$sCalTblRows .= '<td class="'.$sClass.'"><a href="CalendarList.php?date='.$iMonth.'/'.$iCurrentDay.'/'. $iYear. '">'.$iCurrentDay.'</a></td>'; 

												// Next day
												$iCurrentDay++;
												if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
													$bPreviousMonth = false;
													$iCurrentDay = 1;
												}
												if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
													$bNextMonth = true;
													$iCurrentDay = 1;
												}
											}
											$sCalTblRows .= '</tr>';
										}

										// Prepare replacement keys and generate the calendar
										$aKeys = array(
											'__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
											'__next_month__' => "{$iNextMonth}-{$iNextYear}",
											'__cal_caption__' => $sMonthName . ', ' . $iYear,
											'__cal_rows__' => $sCalTblRows,
										);
										$sCalendarItself = strtr(file_get_contents('templates/calendar.html'), $aKeys);

										// AJAX requests - return the calendar
										if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
											header('Content-Type: text/html; charset=utf-8');
											echo $sCalendarItself;
											exit;
										}

										$aVariables = array(
											'__calendar__' => $sCalendarItself,
										);
										echo strtr(file_get_contents('templates/index.html'), $aVariables);

										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
								
								 