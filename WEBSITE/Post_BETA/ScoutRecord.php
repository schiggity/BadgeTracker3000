<?php 
session_start();

include 'query.php';
 
include 'bootstrap.html';

if(!isset($_SESSION['user']))
{
	$_SESSION['noLog'] = 1;
	header('location: CreateUser.php');
}
#badge requirement delete
if(isset($_POST['requirements'])){
	deleteBadgeReq($_POST['requirements'],$_POST['sid']);
	unset($_POST['requirements']);	
}

if(isset($_POST['Jrequirements'])){
	deleteJourneyReq($_POST['Jrequirements'],$_POST['sid']);
	unset($_POST['Jrequirements']);	
}

if(isset($_POST['BRrequirements'])){
	deleteBridgeReq($_POST['BRrequirements'],$_POST['sid']);
	unset($_POST['BRrequirements']);	
}

if(isset($_POST['Arequirements'])){
	deleteAwardReq($_POST['Arequirements'],$_POST['sid']);
	unset($_POST['Arequirements']);	
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
$valid = false;
if(isset($_POST['sid']))
{
	$healthArray = getHealthRecords($_POST['sid']);
	$valid = true;
	$sid = $_POST['sid'];
}
else if(isset($_SESSION['editHealth']))
{ ?>
	<script>
	
	alert("Health Records Changed Successfully!");

	</script>
<?php
	$healthArray = getHealthRecords($_SESSION['sid']);
	$valid = true;
	$sid = $_SESSION['sid'];
	unset($_SESSION['editHealth']);	
} else if(isset($_SESSION['sid'])){
	$healthArray = getHealthRecords($_SESSION['sid']);
	$valid = true;
	$sid = $_SESSION['sid'];	
}
if($valid){
	

?>



<head>
  <title>Scout Records</title> <!-- Change Page Tiltle Here -->
  </head>
<body>


<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php'; ?>
<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container">
<?php $scout = getscout($sid);?>
        <div class="row-fluid">
            <div class="col-md-6">
                <h1>Scout Records - <?php echo $scout["Name"]; ?></h1>

			</div>
			
			<div class="col-md-6">
			<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Rank
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="#daisy">Daisy</a></li>
				<li><a href="#brownie">Brownie</a></li>
				<li><a href="#junior">Junior</a></li>
				<li><a href="#cadette">Cadette</a></li>
				<li><a href="#senior">Senior</a></li>
				<li><a href="#ambassador">Ambassador</a></li>
			</ul>
			</div>
			</div>
			
			<div class="col-md-12">
				<!--<h2>*NAME*'s Record</h2>-->
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Badges" data-toggle="tab">Badges</a></li>
                    <li><a href="#Journeys" data-toggle="tab">Journeys</a></li>
                    <li><a href="#Awards" data-toggle="tab">Awards/Bridging</a></li>
                    <li><a href="#HealthRecords" data-toggle="tab">Health records</a></li>
					
					
                </ul>
                <div class="tab-content my-tab">
					<!---------------------------------Badges Tab------------------------------------->
                    <div class="tab-pane active" id="Badges">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Badges</h3>
							</div>
							<div class="col-md-12">
							
								<a id="daisy"></a>
								<h4>Daisey</h4>
								
								<?php
								$badges = getBadgesByScoutByRank($sid, 'd');
								if($badges)
								{
								foreach($badges as $badge){
									
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php 
								} 
								}
								?>
								<a id="brownie"></a>
								<h4>Brownie</h4>
								<?php
								$badges = getBadgesByScoutByRank($sid, "brownie");
								if(count($badges) != 0)
								{
								foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } }?>
								<a id="junior"></a>
								<h4>Junior</h4>
								<?php
								$badges = getBadgesByScoutByRank($sid, 'j');
								if($badges)
								{
								foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } } ?>
								<a id="cadette"></a>
								<h4>Cadette</h4>
								<?php
								$badges = getBadgesByScoutByRank($sid, 'c');
								if($badges)
								{
								foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } }?>
								<a id="senior"></a>
								<h4>Senior</h4>
								<?php
								$badges = getBadgesByScoutByRank($sid, 's');
								if($badges)
								{
								foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } } ?>
								<a id="ambassador"></a>
								<h4>Ambassador</h4>
								<?php
								$badges = getBadgesByScoutByRank($sid, 'a');
								if($badges)
								{
								foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForBadge($badge["BAID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBR($req["BARID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='requirements[]' value='" . $req["BARID"] . "'></td>";
															}
															echo "</tr>";
														}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } } ?>
								 
							
                            </div>
                        </div>
                    </div>
					<!---------------------------------Journeys Tab------------------------------------->
                    <div class="tab-pane" id="Journeys">
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Journeys</h3>
								<a id="daisy"></a>
								</div>
								
							<div class="col-md-12">
							
								<a id="daisy"></a>
								<h4>Daisey</h4>
								
								<?php
								$journeys = getJourneyByScoutByRank($sid, 'd');
								if($journeys != 'null'){
								
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php }} ?>
								<a id="brownie"></a>
								<h4>Brownie</h4>
								<?php
								$journeys = getJourneyByScoutByRank($sid, 'b');
								if($journeys != 'null'){
								
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php }} ?>
								<a id="junior"></a>
								<h4>Junior</h4>
								<?php
								$journeys = getJourneyByScoutByRank($sid, 'j');
								if($journeys != 'null'){
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } }?>
								<a id="cadette"></a>
								<h4>Cadette</h4>
								<?php
								$journeys = getJourneyByScoutByRank($sid, 'c');
								if($journeys != 'null'){
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } }?>
								<a id="senior"></a>
								<h4>Senior</h4>
								<?php
								$journeys = getJourneyByScoutByRank($sid, 's');
								if($journeys != 'null'){
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php }} ?>
								<a id="ambassador"></a>
								<h4>Ambassador</h4>
								<?php
								$journeys = getJourneyByScoutByRank($sid, 'a');
								if($journeys != 'null'){
								foreach($journeys as $journey){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo $journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
												<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getQuestsForJourney($journey["JID"]) as $quest){
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getRequirementsForJourneyQuest($quest["QID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteJR($req["RID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='Jrequirements[]' value='" . $req["RID"] . "'></td>";
															}
															echo "</tr>";
														}
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php } }?>
								
							
                            </div>
                        </div>
                    </div>
					<!---------------------------------Awards Tab------------------------------------->
                    <div class="tab-pane" id="Awards">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Awards</h3>
								<?php
								$awards = getAwardsByScout($sid);
								if($awards)
								{
								foreach($awards as $award){
									
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $award["Name"]; ?>" href="#collapse<?php echo $award["AID"]?>"><?php echo $award["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $award["AID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													
													foreach(getAwardRequirements($award["AID"]) as $req){
														$Name = str_replace(array('"','\''), "", $req["Name"]);
														$enabled = ifCompleteAR($req["ARID"],$sid);
														echo "<tr>";
														echo "<td>";
														echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
														echo "</td>";
														echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
														echo "<td>";
														echo  $enabled ."<br>" ;
														echo "</td>";
														if(isset($enabled)){
															echo "<td> <input type='checkbox' name='Arequirements[]' value='" . $req["ARID"] . "'></td>";
														}
														echo "</tr>";	
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php 
								} 
								}
								?>
								
								<h3>Bridges</h3>
								<?php
								$bridges = getBridgesByScout($sid);
								if($bridges)
								{
								foreach($bridges as $bridge){
									
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $bridge["Name"]; ?>" href="#collapse<?php echo $bridge["BID"]?>"><?php echo $bridge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $bridge["BID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">
													<?php
													echo "<table><form action='ScoutRecord.php' method='POST'>";
													echo "<tr>";
													echo "<td> <h3>Requirements</h3> </td>";
													echo "<td>  </td>";
													echo "<td> <h3>Date Completed</h3> </td>";
													foreach(getBridgeQuests($bridge["BID"]) as $quest){
														
														echo "<tr>";
														echo "<td>";
														echo "<b>" . $quest["Name"] . ":</b><br>";
														echo "</td>";
														echo "</tr>";
														foreach(getBridgeRequirementsByQuest($quest["BQID"]) as $req){
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$enabled = ifCompleteBRR($req["BRID"],$sid);
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo  $enabled ."<br>" ;
															echo "</td>";
															if(isset($enabled)){
																echo "<td> <input type='checkbox' name='BRrequirements[]' value='" . $req["BRID"] . "'></td>";
															}
															echo "</tr>";
															}
														
													}
													echo "<input type='hidden' name='sid' id='sid' value='". $sid ."'>";
													echo "<tr><td><button type ='submit'> Delete Selected</button></td></tr>";
													echo "</form></table>";
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php 
								} 
								}
								?>
                            </div>
                        </div>
                    </div>
					<!---------------------------------Health Records Tab------------------------------------->
				<div class="tab-pane" id="HealthRecords">
					<div class="row">
						<div class="col-md-12">
							<h3>Health Records <button type="button" class="btn btn-default pull-right" onclick="enable()">Edit <span class="glyphicon glyphicon-pencil"></span> </button> </h3>
							<form role="form" method="post" action="HealthRecOP.php">
							<input type="hidden" name="sid" value="<?php echo $sid;?>">
								<div class="col-md-6">
									<p> <b>Primary Contact: </b></p>
									<div class="form-group">
										<input class="form-control" id="PrimaryName" name="PrimaryName" type="text" placeholder="Primary Contact Name" value="<?php echo $healthArray["Pname"];?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="PrimaryNum" name="PrimaryNum" type="text" placeholder="Phone Number" value="<?php echo $healthArray["Pphone"];?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="PrimaryRel" name="PrimaryRel" type="text" placeholder="Relationship" value="<?php echo $healthArray["Prel"];?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<p> <b>Secondary Contact: </b></p>
									<div class="form-group">
										<input class="form-control" id="SecondaryName" name="SecondaryName" type="text" placeholder="Secondary Contact Name" value="<?php echo $healthArray["Sname"];?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="SecondaryNum" name="SecondaryNum" type="text" placeholder="Phone Number" value="<?php echo $healthArray["Sphone"];?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="SecondaryRel" name="SecondaryRel" type="text" placeholder="Relationship" value="<?php echo $healthArray["Srel"];?>" disabled>
									</div>
								</div>
								
								<div class="col-md-12">
									<p><!-- Intentionally Left Blank --></p>
								</div>
								
								<div class="col-md-4" style="border-right: 1px solid #ccc;">
									<p> <b>Allergies: </b></p>
									<div class="form-group">
										<input class="form-control" id="Allergy1" name="Allergy1" type="text" placeholder="Allergy 1" value="<?php echo $healthArray["Allergies"][0]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy2" name="Allergy2" type="text" placeholder="Allergy 2" value="<?php echo $healthArray["Allergies"][1]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy3" name="Allergy3" type="text" placeholder="Allergy 3" value="<?php echo $healthArray["Allergies"][2]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy4" name="Allergy4" type="text" placeholder="Allergy 4" value="<?php echo $healthArray["Allergies"][3]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy5" name="Allergy5" type="text" placeholder="Allergy 5" value="<?php echo $healthArray["Allergies"][4]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy6" name="Allergy6" type="text" placeholder="Allergy 6" value="<?php echo $healthArray["Allergies"][5]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy7" name="Allergy7" type="text" placeholder="Allergy 7" value="<?php echo $healthArray["Allergies"][6]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy8" name="Allergy8" type="text" placeholder="Allergy 8" value="<?php echo $healthArray["Allergies"][7]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy9" name="Allergy9" type="text" placeholder="Allergy 9" value="<?php echo $healthArray["Allergies"][8]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy10" name="Allergy10" type="text" placeholder="Allergy 10" value="<?php echo $healthArray["Allergies"][9]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy11" name="Allergy11" type="text" placeholder="Allergy 11" value="<?php echo $healthArray["Allergies"][10]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Allergy12" name="Allergy12" type="text" placeholder="Allergy 12" value="<?php echo $healthArray["Allergies"][11]; ?>" disabled>
									</div>
								</div>
								<div class="col-md-4" style="border-right: 1px solid #ccc;">
									<p> <b>Illness: </b></p>
									<div class="form-group">
										<input class="form-control" id="Illness1" name="Illness1" type="text" placeholder="Illness 1" value="<?php echo $healthArray["Illness"][0]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness2" name="Illness2" type="text" placeholder="Illness 2" value="<?php echo $healthArray["Illness"][1]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness3" name="Illness3" type="text" placeholder="Illness 3" value="<?php echo $healthArray["Illness"][2]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness4" name="Illness4" type="text" placeholder="Illness 4" value="<?php echo $healthArray["Illness"][3]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness5" name="Illness5" type="text" placeholder="Illness 5" value="<?php echo $healthArray["Illness"][4]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness6" name="Illness6" type="text" placeholder="Illness 6" value="<?php echo $healthArray["Illness"][5]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness7" name="Illness7" type="text" placeholder="Illness 7" value="<?php echo $healthArray["Illness"][6]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness8" name="Illness8" type="text" placeholder="Illness 8" value="<?php echo $healthArray["Illness"][7]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness9" name="Illness9" type="text" placeholder="Illness 9" value="<?php echo $healthArray["Illness"][8]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness10" name="Illness10" type="text" placeholder="Illness 10" value="<?php echo $healthArray["Illness"][9]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness11" name="Illness11" type="text" placeholder="Illness 11" value="<?php echo $healthArray["Illness"][10]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Illness12" name="Illness12" type="text" placeholder="Illness 12" value="<?php echo $healthArray["Illness"][11]; ?>" disabled>
									</div>
								</div>
								<div class="col-md-4">
									<p> <b>Other: </b></p>
									<div class="form-group">
										<input class="form-control" id="Other1" name="Other1" type="text" placeholder="Other 1" value="<?php echo $healthArray["Other"][0]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other2" name="Other2" type="text" placeholder="Other 2" value="<?php echo $healthArray["Other"][1]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other3" name="Other3" type="text" placeholder="Other 3" value="<?php echo $healthArray["Other"][2]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other4" name="Other4" type="text" placeholder="Other 4" value="<?php echo $healthArray["Other"][3]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other5" name="Other5" type="text" placeholder="Other 5" value="<?php echo $healthArray["Other"][4]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other6" name="Other6" type="text" placeholder="Other 6" value="<?php echo $healthArray["Other"][5]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other7" name="Other7" type="text" placeholder="Other 7" value="<?php echo $healthArray["Other"][6]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other8" name="Other8" type="text" placeholder="Other 8" value="<?php echo $healthArray["Other"][7]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other9" name="Other9" type="text" placeholder="Other 9" value="<?php echo $healthArray["Other"][8]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other10" name="Other10" type="text" placeholder="Other 10" value="<?php echo $healthArray["Other"][9]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other11" name="Other11" type="text" placeholder="Other 11" value="<?php echo $healthArray["Other"][10]; ?>" disabled>
									</div>
									<div class="form-group">
										<input class="form-control" id="Other12" name="Other12" type="text" placeholder="Other 12" value="<?php echo $healthArray["Other"][11]; ?>" disabled>
									</div>
								</div>
								<div class="col-md-12">
									<p> <b>Notes: </b></p>
									<div class="form-group">
										<textarea class="form-control" rows="6" id="Notes" name="Notes" style="resize:none;" disabled><?php echo $healthArray["Notes"]; ?></textarea>
									</div>
									<a href="ScoutRecord.php#HealthRecords"><button type="button" class="btn btn-default pull-left" onclick="disable()">Cancel</button></a>
									<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Scout">Submit</button>
									
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	
	<script>
		function enable()
		{
			$("#PrimaryName").removeAttr('disabled');
			$("#PrimaryNum").removeAttr('disabled');
			$("#PrimaryRel").removeAttr('disabled');
			
			$("#SecondaryName").removeAttr('disabled');
			$("#SecondaryNum").removeAttr('disabled');
			$("#SecondaryRel").removeAttr('disabled');
			
			$("#Allergy1").removeAttr('disabled');
			$("#Allergy2").removeAttr('disabled');
			$("#Allergy3").removeAttr('disabled');
			$("#Allergy4").removeAttr('disabled');
			$("#Allergy5").removeAttr('disabled');
			$("#Allergy6").removeAttr('disabled');
			$("#Allergy7").removeAttr('disabled');
			$("#Allergy8").removeAttr('disabled');
			$("#Allergy9").removeAttr('disabled');
			$("#Allergy10").removeAttr('disabled');
			$("#Allergy11").removeAttr('disabled');
			$("#Allergy12").removeAttr('disabled');
			
			$("#Illness1").removeAttr('disabled');
			$("#Illness2").removeAttr('disabled');
			$("#Illness3").removeAttr('disabled');
			$("#Illness4").removeAttr('disabled');
			$("#Illness5").removeAttr('disabled');
			$("#Illness6").removeAttr('disabled');
			$("#Illness7").removeAttr('disabled');
			$("#Illness8").removeAttr('disabled');
			$("#Illness9").removeAttr('disabled');
			$("#Illness10").removeAttr('disabled');
			$("#Illness11").removeAttr('disabled');
			$("#Illness12").removeAttr('disabled');
			
			$("#Other1").removeAttr('disabled');
			$("#Other2").removeAttr('disabled');
			$("#Other3").removeAttr('disabled');
			$("#Other4").removeAttr('disabled');
			$("#Other5").removeAttr('disabled');
			$("#Other6").removeAttr('disabled');
			$("#Other7").removeAttr('disabled');
			$("#Other8").removeAttr('disabled');
			$("#Other9").removeAttr('disabled');
			$("#Other10").removeAttr('disabled');
			$("#Other11").removeAttr('disabled');
			$("#Other12").removeAttr('disabled');
			
			$("#Notes").removeAttr('disabled');
		}
		
		function disable()
		{
			$("#PrimaryName").attr('disabled', 'disabled');
			$("#PrimaryNum").attr('disabled', 'disabled');
			$("#PrimaryRel").attr('disabled', 'disabled');
			
			$("#SecondaryName").attr('disabled', 'disabled');
			$("#SecondaryNum").attr('disabled', 'disabled');
			$("#SecondaryRel").attr('disabled', 'disabled');
			
			$("#Allergy1").attr('disabled', 'disabled');
			$("#Allergy2").attr('disabled', 'disabled');
			$("#Allergy3").attr('disabled', 'disabled');
			$("#Allergy4").attr('disabled', 'disabled');
			$("#Allergy5").attr('disabled', 'disabled');
			$("#Allergy6").attr('disabled', 'disabled');
			$("#Allergy7").attr('disabled', 'disabled');
			$("#Allergy8").attr('disabled', 'disabled');
			$("#Allergy9").attr('disabled', 'disabled');
			$("#Allergy10").attr('disabled', 'disabled');
			$("#Allergy11").attr('disabled', 'disabled');
			$("#Allergy12").attr('disabled', 'disabled');
			
			$("#Illness1").attr('disabled', 'disabled');
			$("#Illness2").attr('disabled', 'disabled');
			$("#Illness3").attr('disabled', 'disabled');
			$("#Illness4").attr('disabled', 'disabled');
			$("#Illness5").attr('disabled', 'disabled');
			$("#Illness6").attr('disabled', 'disabled');
			$("#Illness7").attr('disabled', 'disabled');
			$("#Illness8").attr('disabled', 'disabled');
			$("#Illness9").attr('disabled', 'disabled');
			$("#Illness10").attr('disabled', 'disabled');
			$("#Illness11").attr('disabled', 'disabled');
			$("#Illness12").attr('disabled', 'disabled');
			
			$("#Other1").attr('disabled', 'disabled');
			$("#Other2").attr('disabled', 'disabled');
			$("#Other3").attr('disabled', 'disabled');
			$("#Other4").attr('disabled', 'disabled');
			$("#Other5").attr('disabled', 'disabled');
			$("#Other6").attr('disabled', 'disabled');
			$("#Other7").attr('disabled', 'disabled');
			$("#Other8").attr('disabled', 'disabled');
			$("#Other9").attr('disabled', 'disabled');
			$("#Other10").attr('disabled', 'disabled');
			$("#Other11").attr('disabled', 'disabled');
			$("#Other12").attr('disabled', 'disabled');
			
			$("#Notes").attr('disabled', 'disabled');
		}
	</script>
	
<?php  
}
else
{
	echo "<h1>Scout record not found, please go back and try again.</h1>";
}
?>
</body>

</html>

