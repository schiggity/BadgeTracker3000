<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a href="MyTroop.php"><div class="navbar-brand"><span class="glyphicon glyphicon-home"></span></span></div></img></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Troop<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
			<li><a href="MyTroop.php">My Troop</a></li>	
			<li><a href="AddScout.php">Add Scout</a></li>
			
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Badges<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
			<li><a href="BadgeOverview.php">Badge Overview</a></li>
			<li><a href="UpdateBadgeRecords.php">Badge Update</a></li>
		  
		  </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Journeys<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
			<li><a href="Journeys.php">Journeys</a></li>
			<li><a href="UpdateJourney.php">Update Journeys</a></li>
		  
		  </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Awards & Bridging<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
			<li><a href="awardBridge.php">Awards & Bridges</a></li>
			<li><a href="UpdateAwardRecords.php">Update Awards</a></li>
			<li><a href="UpdateBridgeRecords.php">Update Bridges</a></li>
		  
		  </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Finances & Events<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
			<li><a href="Financial.php">Finances</a></li>
			<li><a href="Event.php">Events</a></li>
		  
		  </ul>
        </li>
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <?php if(isset($_SESSION['user'])){ 
         echo '<li><a href="#">Welcome <b>' . $_SESSION['user'] . '</b></a></li>';
		 echo '<li><a href="LogoutOP.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
        }
		else{
		echo '<li><a href="CreateUser.php">Log-In or Create User</a></li>';
		}?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>