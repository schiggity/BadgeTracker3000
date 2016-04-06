<?php 
include 'query.php'; 
session_start(); 

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
	<title>Journey Overview</title> 
	<?php include 'bootstrap.html';?>
</head>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<body>

<?php include 'navBar.php'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="col-md-1">
</div>
<div class="col-md-10">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>Journeys</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">Daisies</a></li>
                    <li><a href="#Tab2" data-toggle="tab">Brownies</a></li>
                    <li><a href="#Tab3" data-toggle="tab">Juniors</a></li>
                    <li><a href="#Tab4" data-toggle="tab">Cadettes</a></li>
					<li><a href="#Tab5" data-toggle="tab">Seniors</a></li>
					<li><a href="#Tab6" data-toggle="tab">Ambassadors</a></li>
					
                </ul>
                <div class="tab-content my-tab">  <!-- Daisies tab and collapsing panel start -->
                    <div class="tab-pane active" id="Tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Daisies</h3>
								<?php
									$journeys = getJourneysByRank("daisy");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journey/daisy/<?php echo $j["JID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																</tr>
																
																<tr>
																
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="1">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form> 
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
	<!-- Brownies tab and collapsing panel start -->
                    <div class="tab-pane" id="Tab2">  
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Brownies</h3>
								<?php
									$journeys = getJourneysByRank("brownie");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/brownie/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="2">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form> 
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Tab3">  <!-- Juniors tab and collapsing panel start -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Juniors</h3>
								<?php
									$journeys = getJourneysByRank("junior");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/junior/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="3">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form> 
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Tab4">  <!-- Cadettes tab and collapsing panel start -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Cadettes</h3>
								<?php
									$journeys = getJourneysByRank("cadette");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/caddette/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="4">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane" id="Tab5">  <!-- Seniors tab and collapsing panel start -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Seniors</h3>
								<?php
									$journeys = getJourneysByRank("senior");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/senior/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="5">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form> 
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane" id="Tab6">  <!-- Ambassadors tab and collapsing panel start -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Ambassadors</h3>
								<?php
									$journeys = getJourneysByRank("ambassador");
									foreach($journeys as $j){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><div class="row"><?php echo $j["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/ambassador/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Journey Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																<form action="UpdateJourney.php#<?php echo $q["QID"] ?>" method="post">
																	<input type="hidden" name="BTab" value="6">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $j["JID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
																</form> 
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying <span class="glyphicon glyphicon-list-alt"></span> Journey Requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $q["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getRequirementsForJourneyQuest($q["QID"]) as $req){
																						$Name = str_replace(array('"','\''), "", $req["Name"]);
																						$Comments = str_replace(array('"','\''), "", $req["Comments"]);
																						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
																					}
																				?>
																				</p>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																
																
																	
																</tr>
															
															</tbody>
														</table>
													<?php }?>
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-1">
</div>
</body>
</html>

