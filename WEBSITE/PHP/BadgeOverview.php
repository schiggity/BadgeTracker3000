<?php include 'query.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Badge Overview</title> <!-- Change Page Tiltle Here -->
  <!-- Stuff that is necessary for Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="TemplateCSS.css">
</head>
<body>

<!---------------------------------------------------------------- NAV BAR -------------------------------------------------------->
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
	  <img class="navbar-brand" src="girlscout2.png"></img>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<!-- Navigation dropdown -->
		<ul class="nav navbar-nav">        
			<li class="dropdown"> 
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Navigation <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#"></a></li>
					<li><a href="home.html">Home</a></li>
					<li><a href="BadgeTracking.html">Badge Tracking</a></li>
					<li><a href="BadgeOverview.html">Badge Overview</a></li>
					<li><a href="Journeys.html">Journeys</a></li>
				</ul>
			</li>		
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#">Welcome User</a></li>        
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-------------------------------------------------------------- TABS ------------------------------------------------------------->
<div class="container">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>Badge Overview</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">Daisies</a></li>
                    <li><a href="#Tab2" data-toggle="tab">Brownies</a></li>
                    <li><a href="#Tab3" data-toggle="tab">Juniors</a></li>
                    <li><a href="#Tab4" data-toggle="tab">Cadettes</a></li>
					<li><a href="#Tab5" data-toggle="tab">Seniors</a></li>
					<li><a href="#Tab6" data-toggle="tab">Ambassadors</a></li>
				</ul>
                <div class="tab-content my-tab">  
<!----------------------------------------- Daisies tab collapsing panel start ------------------------------------------->                    
					
					<div class="tab-pane active" id="Tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Daisies</h3>
								<?php
									$badges = getBadgesByRank("daisy");
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
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
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
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
<!----------------------------------------- Brownies tab collapsing panel start ------------------------------------------->					
                    <div class="tab-pane" id="Tab2">  
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Brownies</h3>
								<?php
									$badges = getBadgesByRank("brownie");
									foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"];?> href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["Name"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
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
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
<!----------------------------------------- Juniors tab collapsing panel start ------------------------------------------->					
                    <div class="tab-pane" id="Tab3">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Juniors</h3>
								<?php
									$badges = getBadgesByRank("junior");
									foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																				<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
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
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
<!----------------------------------------- Cadettes tab collapsing panel start ------------------------------------------->					
                    <div class="tab-pane" id="Tab4">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Cadettes</h3>
								<?php
									$badges = getBadgesByRank("cadette");
									foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																				<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
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
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
<!----------------------------------------- Seniors tab collapsing panel start ------------------------------------------->					
					<div class="tab-pane" id="Tab5">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Seniors</h3>
								<?php
									$badges = getBadgesByRank("senior");
									foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
																					}
																				
																				
																				?>
																				</p>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>	
																</div>	
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
<!----------------------------------------- Ambassadors tab collapsing panel start ------------------------------------------->					
					<div class="tab-pane" id="Tab6">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Ambassadors</h3>
								<?php
									$badges = getBadgesByRank("ambassador");
									foreach($badges as $badge){
								?>
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 
													<p>***DESCRIPTION***</p>            
													<table  style="width: 90%;">														
														<tbody>
															<tr><?php $c = getScoutCountForBadge($badge["BAID"]); ?>
																<td>Number of Scouts Earned: <?php echo $c[1]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															<tr>
																<td>Number of Scouts Started: <?php echo $c[0]; ?></td>																	
															</tr>
															<tr>														
																<!-- modal activated by button -->
																<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>

																<!-- Modal -->
																<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																		<!-- Modal content displaying badge requirements-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
																			</div>
																			<div class="modal-body">
																				<p>
																				<?php
																					foreach(getQuestsForBadge($badge["BAID"]) as $quest){
																						echo "<b>" . $quest["Name"] . ":</b><br>";
																						foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
																							echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $req["Name"] . "<br>";											
																						}
																					}
																				
																				
																				?>
																				</p>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>	
																</div>	
																<td align="right"> <button class="btn btn-secondary btn-lg">Update Records</button> </td>
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>
