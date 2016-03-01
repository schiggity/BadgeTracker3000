<?php 
include 'query.php'; 
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

<?php include 'navBar.html'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container">
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journey/daisy/<?php echo $j["JID"]?>.png"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																</tr>
																
																<tr>
																
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/brownie/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/junior/<?php echo $q["QID"]?>.jpg"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/caddette/<?php echo $q["QID"]?>.png"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/senior/<?php echo $q["QID"]?>.png"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
												<a data-toggle="collapse" href="#collapse<?php echo $j["JID"]; ?>"><?php echo $j["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $j["JID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<?php foreach(getQuestsForJourney($j["JID"]) as $q){?>
													<p><b><?php echo $q["Name"]?></b></p>            
														<table  style="width: 90%;">														
															<tbody><?php $c = getScoutCountForJourneyQuest($q["QID"]); ?>
																<tr>
																<td rowspan="4"><img src="IMG/Journeys/ambassador/<?php echo $q["QID"]?>.png"></td>
																<td align="right" >Number of Scouts Earned: <?php echo $c[1]; ?></td>
																<td rowspan="2" align ="right"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $q["QID"]?>">Badge Requirements</button></td>
																		
																
																
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
																</tr>
																
																<tr>
																<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
																<td rowspan="2" align ="right">
																	<a href="/UpdateJourneyRecords.php#<?php echo $q["QID"] ?>" >
																		<button class="btn btn-secondary btn-lg">&nbsp&nbsp&nbsp Update Records &nbsp&nbsp&nbsp</button>
																	</a>
																</td>
																</tr>
																
																<tr>														
																
																<!-- Modal -->
																	<div id="Modal<?php echo $q["QID"]?>" class="modal fade" role="dialog">
																	
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
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
</body>
</html>

