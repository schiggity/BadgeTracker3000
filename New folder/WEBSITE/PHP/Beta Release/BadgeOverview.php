<?php 
include 'query.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Change Page Tiltle Here -->
	<title>Badge Overview</title> 
	<?php include 'bootstrap.html';?>
</head>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<body>

<?php include 'navBar.html'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------>
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" style="background: url(img/badges/Daisy/<?php echo $badge["BAID"] ?>.png) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
											<ul class="list-group">
												<div class="container"> 
													       
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
																
																
															<td align="right"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Badge Requirements</button></td>
															
															<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="1">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">	
																	<button type="submit" class="btn btn-secondary btn-lg">Update Records </button>
																</form> 
															</td>
															</tr>
															<tr>
															
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $badge["Name"];?>" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" style="background: url(img/badges/Brownie/<?php echo $badge["BAID"] ?>.png) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
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

																	
																<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="2">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" class="panel-collapse collapse" style="background: url(img/badges/Junior/<?php echo $badge["BAID"] ?>.png) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
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

																	
																<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="3">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" class="panel-collapse collapse" style="background: url(img/badges/Caddette/<?php echo $badge["BAID"] ?>.png) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
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

																	
																<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="4">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" class="panel-collapse collapse" style="background: url(img/badges/Senior/<?php echo $badge["BAID"] ?>.jpg) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
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

																
																<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="5">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">
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
								<!-- Modal shit -->
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
															$Name = str_replace(array('"','\''), "", $req["Name"]);
															$Comments = str_replace(array('"','\''), "", $req["Comments"]);
															echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<a href="#" data-toggle="tooltip" data-placement="right" title="'. $Comments . '">' . $Name. '</a>' . "<br>" ;
															
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo $badge["BAID"]?>"><?php echo $badge["Name"]; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse" class="panel-collapse collapse" style="background: url(img/badges/Ambassador/<?php echo $badge["BAID"] ?>.jpg) no-repeat; background-position: right; background-size:22%; filter: grayscale(.8);">
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

																	
																<td align="right"> 
																<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="6">
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"] ?>">																	
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

