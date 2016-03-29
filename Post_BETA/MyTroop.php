<?php 
session_start();
include 'query.php'; 
//echo $_SESSION['tid'];

if(!isset($_SESSION['user']))
{
	$_SESSION['noLog'] = 1;
	header('location: CreateUser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Change Page Tiltle Here -->
	<title>My Troop</title> 
	<?php include 'bootstrap.html';?>
</head>
<body>

<?php
if(isset($_SESSION['EditScout']))
{ ?>
	<script>
	
	alert("Scout Succesfully Edited!");

	</script>
<?php
	unset($_SESSION['EditScout']);
} ?>

<!---------------------------------------------------------------- NAV BAR -------------------------------------------------------->
<?php include 'navBar.php'; ?>


<!-------------------------------------------------------------- TABS ------------------------------------------------------------->
<div class="container">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>My Troop</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">All Scouts</a></li>
                    <li><a href="#Tab2" data-toggle="tab">Events</a></li>
                    <li><a href="#Tab3" data-toggle="tab">Finances</a></li>
                    <li><a href="#Tab4" data-toggle="tab">Badges</a></li>
					<li><a href="#Tab5" data-toggle="tab">Awards</a></li>
					<li><a href="#Tab6" data-toggle="tab">Journeys</a></li>
					<li><a href="#Tab7" data-toggle="tab">Earned</a></li>
					<li style="float: right;"><a href="AddScout.php">+Add a Scout</a></li>
										
                </ul>
				
				<!-- All Scouts tab and collapsing panel start -->
				
                <div class="tab-content my-tab"> 
                    <div class="tab-pane active" id="Tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>All Scouts</h3>
								
								<?php
									$scouts = getAllScouts();
									foreach($scouts as $scout){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="S<?php echo $scout["SID"]; ?>" href="#collapseS<?php echo $scout["SID"];?>"><?php echo $scout["Name"]; ?></a>
												<!-- id tag has capital S before sid and collapse has capital S to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseS<?php echo $scout["SID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<td>Rank: <?php echo $scout["Ranks"];?> </td>																	
															</tr>
															<tr>
																<td>Grade: <?php echo $scout["Grade"];?> </td>																	
															</tr>
															<tr>
																<td>Date of Birth: <?php echo $scout["DoB"];?> </td>																	
															</tr>
															<tr>
																<td> Contact info: <?php echo $scout["address"];?>, <?php echo $scout["PhoneNumber"];?>, <?php echo $scout["email"];?> </td>
															</tr>
															<tr>
																<td>Parents: <?php echo $scout["Parents"];?> </td>																	
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="ScoutRecord.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $scout["SID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Scout Records </button>
																	</form> 
																	<form action="EditScout.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $scout["SID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Edit </button>
																	</form> 
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					
					<!-- Events tab and collapsing panel start -->
					
					<div class="tab-pane" id="Tab2">  
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Events</h3>
							   
							   <?php
									$events = getAllEvents();
									foreach($events as $event){
								?>
							   
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="E<?php echo $event["EID"]; ?>" href="#collapseE<?php echo $event["EID"];?>">
												
												<table class="table-hover" style="width: 90%;">
													<tr>
														<td style=" text-align: left;"><?php echo $event["Event"];  ?></td>														
														<td style=" text-align: right;"><?php echo $event["TheDate"];  ?></td>
													</tr>
												</table>
												
												</a>
												<!-- id tag has capital E before eid and collapse has capital E to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseE<?php echo $event["EID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
														<table  style="width: 90%;">														
															<tbody>
																<tr>
																	<td>*data*</td>																	
																</tr>
																<tr>														
																	<td align="right"> <button href= "scoutRecords.php" class="btn btn-secondary btn-lg">Event Records</button> </td>
																</tr>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					
					<!-- financial tab and collapsing panel start -->
					
                    <div class="tab-pane" id="Tab3">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Finances</h3>
								
								<?php
									$finances = getAllFinance();
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="F<?php echo $finance["FID"]; ?>" href="#collapseF<?php echo $finance["FID"];?>"><?php echo $finance["Purpose"];  ?></a>
												<!-- id tag has capital F before fid and collapse has capital F to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseF<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
														<table  style="width: 90%;">														
															<tbody>
																<tr>
																	<td>Cost: <?php echo $finance["Amount"];?></td>																	
																</tr>
																<tr>														
																	<td align="right"> <button class="btn btn-secondary btn-lg">Financial Records</button> </td>
																</tr>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					
					<!-- Badges tab and collapsing panel start -->
					
                   <div class="tab-pane" id="Tab4">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Badges</h3>
								
								<?php
									$badges = getAllBadges();
									foreach($badges as $badge){
										
										$array = getScoutCountForBadge($badge["BAID"]);
										
										if($array[0] != 0 || $array[1] != 0 || $array[2] != 0 ){
											
								?>
								
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $badge["BAID"]; ?>" href="#collapseB<?php echo $badge["BAID"];?>"><?php echo $badge["Name"];  ?></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseB<?php echo $badge["BAID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
														<table  style="width: 90%;">														
															<tbody>
																<tr>
																	<td>Number of Scouts Earned: <?php echo $array[1]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Awarded: <?php echo $array[2]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Started: <?php echo $array[0]; ?></td>					
												
																</tr>
																<tr>															
																	<td align="right"> 
																		<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																			<input type="hidden" name="BTab" value="<?php echo $badge["BAID"][0]; ?>">	
																			<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"];?>">
																			<button type="submit" class="btn btn-secondary btn-lg">Update Records </button>
																		</form>  
																	</td>
																</tr>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
                    </div> 
					
					<!-- Awards tab and collapsing panel start -->
					
					<div class="tab-pane" id="Tab5">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Awards</h3>
								
								<?php
									$awards = getAllAwards();
									foreach($awards as $award){
										
										$array = getAwardScoutCount($award["AID"]);
										
										if($array[0] != 0 || $array[1] != 0 || $array[2] != 0 ){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="A<?php echo $award["AID"]; ?>" href="#collapseA<?php echo $award["AID"];?>"><?php echo $award["Name"];  ?></a>
												<!-- id tag has capital A before aid and collapse has capital A to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseA<?php echo $award["AID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container">													          
														<table  style="width: 90%;">														
															<tbody>
																<tr>
																	<td>Number of Scouts Earned: <?php echo $array[1]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Awarded: <?php echo $array[2]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Started: <?php echo $array[0]; ?></td>																	
																</tr>
																<tr>															
																	<td align="right"> 
																		<form action="UpdateAwardRecords.php" method="post">																		
																			<input type="hidden" name="AID" value="<?php echo $award["AID"]; ?>">	
																			<button type="submit" class="btn btn-secondary btn-lg">Update Records </button>
																		</form> 
																	</td>
																</tr>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
                    </div>
					
					<!-- Journeys tab and collapsing panel start -->
					
					<div class="tab-pane" id="Tab6">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Journeys</h3>
								
								<?php
									$journeys = getAllJourneys();
									foreach($journeys as $journey){
										
								foreach(getQuestsForJourney($journey["JID"]) as $quest)
								{
										$array = getScoutCountForJourneyQuest($quest["QID"]);						
																				
										if($array[0] != 0 || $array[1] != 0 || $array[2] != 0 ){
								
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="J<?php echo $journey["JID"]; ?>" href="#collapseJ<?php echo $journey["JID"];?>"><?php echo $journey["Name"];  ?></a>
												<!-- id tag has capital J before jid and collapse has capital J to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseJ<?php echo $journey["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
														<table  style="width: 90%;">														
															<tbody>
																<tr>
																	<td>Number of Scouts Earned: <?php echo $array[1]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Awarded: <?php echo $array[2]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Started: <?php echo $array[0]; ?></td>																	
																</tr>
																<tr>																
																	<td align="right"> 
																		<form action="UpdateJourney.php" method="post">																		
																			<input type="hidden" name="JID" value="<?php echo $journey["JID"]; ?>">	
																			<button type="submit" class="btn btn-secondary btn-lg">Update Records </button>
																		</form> 
																	</td>
																</tr>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } } } ?>
                            </div>
                        </div>
                    </div>
					
					<!--                -->
					
					
					
					<div class="tab-pane" id="Tab7">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Badges</h3>
								
								<?php
									$badges = getAllBadges();
									foreach($badges as $badge){
										
										$array = getScoutCountForBadge($badge["BAID"]);
										
										if($array[1] != 0){
											
								?>
								
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $badge["BAID"]; ?>" href="#collapseBE<?php echo $badge["BAID"];?>"><?php echo $badge["Name"];  ?></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseBE<?php echo $badge["BAID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
														<table  style="width: 90%;">														
															<tbody>
															<?php
																if($scouts = getEarnedByBadge($badge["BAID"]))
																{
																foreach($scouts as $scout){
																$s = getScout($scout);
																?>
																<tr>
																	<td>Number of Scouts Earned: <?php echo $s["Name"]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Awarded: <?php echo $array[2]; ?></td>																	
																</tr>
																<tr>
																	<td>Number of Scouts Started: <?php echo $array[0]; ?></td>					
												
																</tr>
																<tr>															
																	<td align="right"> 
																		<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																			<input type="hidden" name="BTab" value="<?php echo $badge["BAID"][0]; ?>">	
																			<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"];?>">
																			<button type="submit" class="btn btn-secondary btn-lg">Update Records </button>
																		</form>  
																	</td>
																</tr>
																<?php }} ?>
															</tbody>
														</table>
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
                    </div> 
					
				</div>	
			</div>
		</div>
</div>			
	
</body>
	
</html>	