<?php 
session_start();
include 'query.php';
 
include 'bootstrap.html';


?>

<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_POST['sid']))
{
?>
<head>
  <title>Scout Records</title> <!-- Change Page Tiltle Here -->
  </head>
<body>

<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php'; ?>
<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container">
<?php $scout = getscout($_POST['sid']);?>
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
                    <li><a href="#Awards" data-toggle="tab">Awards</a></li>
                    <li><a href="#Events" data-toggle="tab">Events</a></li>
					<li><a href="#Finances" data-toggle="tab">Finances</a></li>
					
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
								$badges = getBadgesByScoutByRank($_POST['sid'], 'd');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$badges = getBadgesByScoutByRank($_POST['sid'], "brownie");
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$badges = getBadgesByScoutByRank($_POST['sid'], 'j');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$badges = getBadgesByScoutByRank($_POST['sid'], 'c');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$badges = getBadgesByScoutByRank($_POST['sid'], 's');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$badges = getBadgesByScoutByRank($_POST['sid'], 'a');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteBR($req["BARID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
														
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 'd');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 'b');
								if($journeys != 'null'){
								echo "shit";
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 'j');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 'c');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 's');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								$journeys = getJourneyByScoutByRank($_POST['sid'], 'a');
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
													echo "<table>";
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
															echo "<tr>";
															echo "<td>";
															echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $Name;
															echo "</td>";
															echo "<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>";
															echo "<td>";
															echo ifCompleteJR($req["RID"],$_POST['sid']) ."<br>" ;
															echo "</td>";
															echo "</tr>";
														}
													}
													echo "</table>";
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse3">*COMPLETED AWARD NAME*</a>
											</h4>
										</div>
										<div id="collapse3" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">*AWARD DESCRIPTION*</li>
												<li class="list-group-item">*DATE COMPLETED*</li>
											</ul>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
					<!---------------------------------Events Tab------------------------------------->
                    <div class="tab-pane" id="Events">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Events</h3>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse4">*EVENT NAME*</a>
											</h4>
										</div>
										<div id="collapse4" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">*EVENT DESCRIPTION*</li>
												<li class="list-group-item">*EVENT DATE*</li>
												<li class="list-group-item">*EVENT COST*</li>
												<li class="list-group-item">*AMOUNTS PAID*</li>
											</ul>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
					<!---------------------------------Finances Tab------------------------------------->
					<div class="tab-pane" id="Finances">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Finances</h3>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse5">*FINANCE*</a>
											</h4>
										</div>
										<div id="collapse5" class="panel-collapse collapse">
											<ul class="list-group">
												<li class="list-group-item">*FINANCE DESCRIPTION*</li>
												<li class="list-group-item">*FINANCE DATE*</li>
												<li class="list-group-item">*FINANCE COST*</li>
												<li class="list-group-item">*AMOUNTS PAID*</li>
											</ul>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php } 
else
{
	echo "<h1>Scout record not found, please go back and try again.</h1>";
}
?>
</html>