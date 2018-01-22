<?PHP session_start();
	include("../../db_connect.php");
	function addRule($dbc, $formatName, $rules)
	{
	
	}
	function getAllCurrentRules($dbc)
	{
		$count = 1;
		$getAllQuery = "SELECT * FROM TourneyRules ORDER by RulesName ASC";
		$results = $dbc->query($getAllQuery);
		$output_head = "<table>
							<tr>
								<th style='width:50px;'>#</th>
								<th>Twist Name</th>
								<th>Times Played</th>
							</tr>";
		while($row = $results->fetch_array())
		{
			$output_body.= "<tr>
								<td rowspan='2'>". $count. "</td>
								<td>". $row["RulesName"] ."</td>
								<td>". $row["UsedCount"] ."</td>
								</tr>
								<tr><td colspan='2'>". $row["Rules"]."</td></tr>";			
		$count++; 
		}
		return $output_head . $output_body ."</table>";
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Twists</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
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
	margin-left: auto; margin-right:auto; width:75%; 
	}
	th{ text-align:center;}
	td{
		border: 3px solid black; padding:5px; text-align:center;
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
                        <h3 class="textLogo">Possible Tournament Rules</h3>
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
					<!--<li >
                        <a href="#" class="active-link" ><i class="fa fa-pencil "></i>Tourney Basics <span class="badge" style="float:right">Step 1</span></a>
					</li>
					<li >
                        <a href="#" ><i class="fa fa-pencil "></i>Pick Game Rules <span class="badge" style="float:right">Step 2</span></a>
					</li>
					<li >
                        <a href="#" ><i class="fa fa-pencil "></i>Confirmation <span class="badge" style="float:right">Step 3</span></a>
					</li> -->
				</ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Formats List </h2>   
                    </div>
					<?=getAllCurrentRules($dbc);?>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
              
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
