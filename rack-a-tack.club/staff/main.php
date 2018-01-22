<?PHP session_start(); ?>
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
                    <a class="navbar-brand" href="main.php">
                        <h2 class="textLogo">Rack-A-Tack Management</h2>

                    </a>
                    
                </div>
              
                <span class="logout-spn" >
                  <a href="/logout.php" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="active-link">
                        <a href="admin.php" ><i class="fa fa-desktop "></i>Main Menu <span class="badge">All</span></a> 
                    </li>
                    <?PHP if($_SESSION['Staff_RankID'] >= 3){ ?>
					<li>
                        <a href="admin.php" ><i class="fa fa-desktop "></i>Admin Tools<span class="badge">Level 3+</span></a>
                    </li>
                   <? }?>
					<?PHP if($_SESSION['Staff_RankID'] >= 2){ ?>
                    <li>
                        <a href="ui.html"><i class="fa fa-table "></i>HTD Tools  <span class="badge">Level 2</span></a>
                    </li>
					 <? }?>
					<?PHP if($_SESSION['Staff_RankID'] >= 1){ ?>
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
                    <div class="col-lg-12">
                     <h2>All Tools</h2>   
                    </div>
                </div>               
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome <?=$_SESSION['Staff_Username'];?> </strong> 
                        </div>
                       
                    </div>
                    </div>
					<!-- /. ROW  --> 
				<div class="row">
                    <div class="col-lg-12">
						<h2>Tournament Director Tools</h2>   
                    </div>
                </div>
			 <!-- /. ROW  --> 
             <div class="row text-center pad-top">
				 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                      <div class="div-square">
                           <a href="tourney/CreateTourney.php" >
								<i class="fa fa-rocket fa-5x"></i>
								<h4>Create New Tournament</h4>
							</a>
                      </div>
                  </div> 
				  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                      <div class="div-square">
                           <a href="tourney/TourneyCollection.php" >
								<i class="fa fa-pencil fa-5x"></i>
								<h4>Tourney Management</h4>
							</a>
                      </div>
                  </div> 
				  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                      <div class="div-square">
                           <a href="tourney/_ManageRules.php" >
								<i class="fa fa-book fa-5x"></i>
								<h4>Formats Book</h4>
							</a>
                      </div>
                  </div> 
			 </div>
			 <?PHP if($_SESSION['Staff_RankID'] >= 2){ ?>
			 <!-- /. ROW  --> 
				<div class="row">
                    <div class="col-lg-12">
						<h2> HTD Tools</h2>   
                    </div>
                </div>
				<!-- /. ROW  --> 
             <div class="row text-center pad-top">
				 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                      <div class="div-square">
                           <a href="addStaff.php" >
								<i class="fa fa-plus fa-5x"></i>
								<h4>Staff List</h4>
							</a>
                      </div>
                  </div> 
				   
			 </div>
			  <? }?>
			 <!-- /. ROW  --> 
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
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
    
   <?PHP
		print_r($_SESSION);
   ?>
</body>
</html>
