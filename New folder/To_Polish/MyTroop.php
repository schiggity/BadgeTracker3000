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
} 

if(isset($_POST['BAwarded']) && isset($_POST['names'])){
	markAwarded("badge",$_POST['names'],$_POST['BAwarded']);
	echo '<script> alert("Badges marked as Awarded!");</script>';
}


else if(isset($_POST['JAwarded']) && isset($_POST['names'])){
	markAwarded("quest",$_POST['names'],$_POST['JAwarded']);
	echo '<script> alert("Journeys marked as Awarded!");</script>';	
}


else if(isset($_POST['AAwarded']) && isset($_POST['names'])){
	markAwarded("award",$_POST['names'],$_POST['AAwarded']);	
	echo '<script> alert("Awards marked as Awarded!");</script>';
}


else if(isset($_POST['BRAwarded']) && isset($_POST['names'])){
	rankUp($_POST['names']);
	markAwarded("bridge",$_POST['names'],$_POST['BRAwarded']);
	echo '<script> alert("Bridges marked as Awarded!");</script>';	
}
else if(isset($_POST['BRAwarded']) || isset($_POST['AAwarded']) || isset($_POST['JAwarded']) || isset($_POST['BAwarded'])){
	echo "<script>alert('No Scouts Selected to be Awarded!');</script>";
}

if(isset($_POST['deleteScout'])){
	deleteScout($_POST['sid']);
	echo '<script> alert("'. $_POST['deleteScout']. ' Has Been Deleted!");</script>';
}



?>

<!---------------------------------------------------------------- NAV BAR -------------------------------------------------------->
<?php include 'navBar.php'; ?>
<!-------------------------------------------------------------- TABS ------------------------------------------------------------->
<script>
$(document).ready(function(){

  if(window.location.hash != "") {
      $('a[href="' + window.location.hash + '"]').click()
  }

});
</script>

<div class="col-md-1">
</div>
<div id="Middle" class="col-md-10">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>My Troop</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">All Scouts</a></li>
                    <li><a href="#Tab4" data-toggle="tab">Badges</a></li>
					<li><a href="#Tab5" data-toggle="tab">Awards</a></li>
					<li><a href="#Tab6" data-toggle="tab">Journeys</a></li>
					<li><a href="#Tab7" data-toggle="tab">Earned</a></li>
					<li><a href="#Tab8" data-toggle="tab">Shopping List</a></li>
					<li style="float: right;"><a href="AddScout.php"><span class="glyphicon glyphicon-plus"></span> Add a Scout</a></li>
										
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
												<a data-toggle="collapse" id="S<?php echo $scout["SID"]; ?>" href="#collapseS<?php echo $scout["SID"];?>"><div class="row"><?php echo $scout["Name"]; ?></div></a>
												<!-- id tag has capital S before sid and collapse has capital S to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseS<?php echo $scout["SID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
											<div class="container-fluid"> 
												<div class="col-md-3">				
													<p><b>Rank: </b><?php echo $scout["Ranks"];?></p>	
													
													<p><b>ID: </b><?php echo $scout["SID"];?></p>
													
													<p><b>Date of Birth: </b><?php echo $scout["DoB"];?></p>
												
													<p><b>Grade: </b><?php echo $scout["Grade"];?>	</p>															
											
												</div>	
												
												<div class="col-md-7">
													<p><b>Parents or Gaurdians: </b><?php echo $scout["Parents"];?></p>
												
													<p><b><u>Contact info: </u></b></p>
													<p><b>Address: </b><?php echo $scout["address"];?></p>
													<p><b>Phone Number: </b><?php echo $scout["PhoneNumber"];?></p>
													<p><b>Email: </b><?php echo $scout["email"];?></p>
												</div>
																													
												<div class="col-md-2">
													<form action="ScoutRecord.php" method="post">																		
														<input type="hidden" name="sid" value="<?php echo $scout["SID"]; ?>">	
														<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-book"></span> Scout Records </button>
													</form> 
													<p> &nbsp </p>
													<form action="EditScout.php" method="post">																		
														<input type="hidden" name="sid" value="<?php echo $scout["SID"]; ?>">	
														<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
													</form> 
												</div>	
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
												<a data-toggle="collapse" id="B<?php echo $badge["BAID"]; ?>" href="#collapseB<?php echo $badge["BAID"];?>"><div class="row"><?php echo $badge["Name"];  ?></div></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseB<?php echo $badge["BAID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 													            
														
													<div class="col-md-3">
														<p><b><u>Number of Scouts Earned: <?php echo $array[1]; ?></u></b></p>
														<?php
															$scouts = getEarnedByBadge($badge["BAID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>
														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Awarded: <?php echo $array[2]; ?></u></b></p>		
														<?php
															$scouts = getAwardedByBadge($badge["BAID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Started: <?php echo $array[0]; ?></u></b></p>	
														<?php
															$scouts = getStartedByBadge($badge["BAID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<form action="UpdateBadgeRecords.php#<?php echo $badge["BAID"]; ?>" method="post">
															<input type="hidden" name="BTab" value="<?php echo $badge["BAID"][0]; ?>">	
															<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $badge["BAID"];?>">
															<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update</button>
														</form>  
													</div>
													
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
												<a data-toggle="collapse" id="A<?php echo $award["AID"]; ?>" href="#collapseA<?php echo $award["AID"];?>"><div class="row"><?php echo $award["Name"];  ?></div></a>
												<!-- id tag has capital A before aid and collapse has capital A to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseA<?php echo $award["AID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 													            
														
													<div class="col-md-3">
														<p><b><u>Number of Scouts Earned: <?php echo $array[1]; ?></u></b></p>
														<?php
															$scouts = getEarnedByAward($award["AID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>
														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Awarded: <?php echo $array[2]; ?></u></b></p>		
														<?php
															$scouts = getAwardedByAward($award["AID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Started: <?php echo $array[0]; ?></u></b></p>	
														<?php
															$scouts = getStartedByAward($award["AID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<form action="UpdateAwardRecords.php#<?php echo $award["AID"]; ?>" method="post">
															<input type="hidden" name="BTab" value="<?php echo $badge["BAID"][0]; ?>">	
															<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $award["AID"];?>">
															<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update</button>
														</form>  
													</div>
													
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
												<a data-toggle="collapse" id="J<?php echo $quest["QID"]; ?>" href="#collapseJ<?php echo $quest["QID"];?>"><div class="row"><?php echo $quest["Name"];  ?></div></a>
												<!-- id tag has capital J before jid and collapse has capital J to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseJ<?php echo $quest["QID"]; ?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 													            
														
													<div class="col-md-3">
														<p><b><u>Number of Scouts Earned: <?php echo $array[1]; ?></u></b></p>
														<?php
															$scouts = getEarnedByJourneyQuest($quest["QID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>
														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Awarded: <?php echo $array[2]; ?></u></b></p>		
														<?php
															$scouts = getAwardedByJourneyQuest($quest["QID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<p><b><u>Number of Scouts Started: <?php echo $array[0]; ?></u></b></p>	
														<?php
															$scouts = getStartedByJourneyQuest($quest["QID"]);
															foreach($scouts as $s)
															{
																$name = getScout($s);
																echo "<p>". $name['Name'] . "</p>";
															}
														?>														
													</div>
													
													<div class="col-md-3">
														<form action="UpdateJourney.php#<?php echo $quest["QID"]; ?>" method="post">
															<input type="hidden" name="BTab" value="<?php echo $quest["QID"][0]; ?>">	
															<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $journey["JID"];?>">
															<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update</button>
														</form>  
													</div>
													
												</div>
											</ul>											
										</div>
									</div>
								</div>
								<?php } } } ?>
                            </div>
                        </div>
                    </div>
					
					<!--       Earned Tab         -->
					
					
					
					<div class="tab-pane" id="Tab7">  
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Badges</h3>
								
								<?php
									$badges = getAllBadges();
									foreach($badges as $badge){
										
										$array = getScoutCountForBadge($badge["BAID"]);
										
										if($array[1] > 0){
											
								?>
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $badge["BAID"]; ?>" href="#collapseBE<?php echo $badge["BAID"];?>"><div class="row"><?php echo $badge["Name"];  ?><div class="row"></div></div></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseBE<?php echo $badge["BAID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container-fluid"> 													            
															<form action="MyTroop.php#Tab7" method="POST">
															
															<div class="col-md-3">
																<b>Scouts Earned</b>
															</div>
															
															<div class="col-md-3">
																<b>Select to Award</b>
															</div>
															<div class="col-md-6">
																<input type="hidden" name="BAwarded" value="<?php echo $badge["BAID"];?>">
																<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-education"></span> Award Selected</button>
															</div>
															
															<?php
																if($scouts = getEarnedByBadge($badge["BAID"]))
																{
																foreach($scouts as $scout){
																$s = getScout($scout);
																?>
																<div class="col-md-3">
																	<td><?php echo $s["Name"]; ?></td>	
																</div>
																
																<div class="col-md-3">
																<input type="checkbox" name="names[]" value="<?php echo $s["SID"]; ?>"></td>
																</div>
																
																<div class="col-md-6">
																	<p> &nbsp </p>
																</div>
																<?php }} ?>
															</form>
																
														
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
						
						
						
						<div class="row">
                            <div class="col-md-12">
                                <h3>Journeys</h3>
								
								<?php
									$journeys = getAllJourneys();
									foreach($journeys as $j){
										$quests = getQuestsForJourney($j["JID"]);
										foreach($quests as $q){
										
										$array = getScoutCountForJourneyQuest($q["QID"]);
										
										if($array[1] > 0){
											
								?>
								
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $q["QID"]; ?>" href="#collapseJE<?php echo $q["QID"];?>"><div class="row"><?php echo $q["Name"];  ?><div class="row"></div></div></a>
												<!-- id tag has capital B before QID and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseJE<?php echo $q["QID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
															<form action="MyTroop.php#Tab7" method="POST">
															
															<div class="col-md-3">
																<b>Scouts Earned</b>
															</div>
															
															<div class="col-md-3">
																<b>Select to Award</b>
															</div>
															<div class="col-md-6">
																<input type="hidden" name="JAwarded" value="<?php echo $q["QID"];?>">
																<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-education"></span> Award Selected</button>
															</div>
															
															<?php
																if($scouts = getEarnedByJourneyQuest($q["QID"]))
																{
																foreach($scouts as $scout){
																$s = getScout($scout);
																?>
																<div class="col-md-3">
																	<td><?php echo $s["Name"]; ?></td>	
																</div>
																
																<div class="col-md-3">
																<input type="checkbox" name="names[]" value="<?php echo $s["SID"]; ?>"></td>
																</div>
																
																<div class="col-md-6">
																	<p> &nbsp </p>
																</div>
																<?php }} ?>
																</form>
																
														
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } }?>
                            </div>
                        </div>
						
						
						<div class="row">
                            <div class="col-md-12">
                                <h3>Awards</h3>
								
								<?php
									$awards = getAllAwards();
									foreach($awards as $a){
										
										$array = getAwardScoutCount($a["AID"]);
										//var_dump($array);
										if($array[1] > 0){
											
								?>
								
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $a["AID"]; ?>" href="#collapseAE<?php echo $a["AID"];?>"><div class="row"><?php echo $a["Name"];  ?><div class="row"></div></div></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseAE<?php echo $a["AID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
															<form action="MyTroop.php#Tab7" method="POST">
															
															<div class="col-md-3">
																<b>Scouts Earned</b>
															</div>
															
															<div class="col-md-3">
																<b>Select to Award</b>
															</div>
															<div class="col-md-6">
																<input type="hidden" name="AAwarded" value="<?php echo $a["AID"];?>">
																<button type="submit" class="btn btn-default btn-lg"> <span class="glyphicon glyphicon-education"></span>Award Selected</button>
															</div>
															
															<?php
																if($scouts = getEarnedByAward($a["AID"]))
																{
																foreach($scouts as $scout){
																$s = getScout($scout);
																?>
																<div class="col-md-3">
																	<td><?php echo $s["Name"]; ?></td>	
																</div>
																
																<div class="col-md-3">
																<input type="checkbox" name="names[]" value="<?php echo $s["SID"]; ?>"></td>
																</div>
																
																<div class="col-md-6">
																	<p> &nbsp </p>
																</div>
																<?php }} ?>
																</form>
																
														
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
						
						
						<div class="row">
                            <div class="col-md-12">
                                <h3>Bridges</h3>
								
								<?php
									$bridges = getAllBridges();
									foreach($bridges as $b){
										
										$array = getBridgeScoutCount($b["BID"]);
										//var_dump($array);
										if($array[1] > 0){
											
								?>
								
								
								
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="B<?php echo $b["BID"]; ?>" href="#collapseBRE<?php echo $b["BID"];?>"><div class="row"><?php echo $b["Name"];  ?><div class="row"></div></div></a>
												<!-- id tag has capital B before baid and collapse has capital B to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
											</h4>
										</div>
										<div id="collapseBRE<?php echo $b["BID"];?>" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
															<form action="MyTroop.php#Tab7" method="POST">
															
															<div class="col-md-3">
																<b>Scouts Earned</b>
															</div>
															
															<div class="col-md-3">
																<b>Select to Award</b>
															</div>
															<div class="col-md-6">
																<input type="hidden" name="BRAwarded" value="<?php echo $b["BID"];?>">
																<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-education"></span> Award Selected</button>
															</div>
															
															<?php
																if($scouts = getEarnedByBridge($b["BID"]))
																{
																foreach($scouts as $scout){
																$s = getScout($scout);
																?>
																<div class="col-md-3">
																	<td><?php echo $s["Name"]; ?></td>	
																</div>
																
																<div class="col-md-3">
																<input type="checkbox" name="names[]" value="<?php echo $s["SID"]; ?>"></td>
																</div>
																
																<div class="col-md-6">
																	<p> &nbsp </p>
																</div>
																<?php }} ?>
																</form>
																
														
												</div>
											</ul>											
										</div>
									</div>
								</div>
									<?php } } ?>
                            </div>
                        </div>
						
						
						
						
						
                    </div> 
					
					
					<!-----------------------------------------------SHOPPING LIST TAB----------------------------------------->
					
					<div class="tab-pane" id="Tab8">  
                        <div class="row">
                            <div class="col-md-12">
							<div class="row">
								<div class="col-md-10">
									<h3>Badges</h3>
								</div>
								<div class="col-md-2">
									<button type="button" onclick="window.location.href='printShop.php';" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-print"></span> Print</button>
								</div>
							</div>
								<div class="col-md-3">
									<p><b>Badges Needed</b></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p><b>Quantity Needed</b></p>
								</div>
								<div class="col-md-3">
									<p><b>Badges Needed</b></p>
								</div>
								
								<div class="col-md-3">
									<p><b>Quantity Needed</b></p>
								</div>
								
								<?php
									$badges = getAllBadges();
									foreach($badges as $badge){
										
										$array = getScoutCountForBadge($badge["BAID"]);
										
										if($array[1] > 0){
											
								?>
								
								<?php
									if($scouts = getEarnedByBadge($badge["BAID"]))
									{
										$s = 0;
										foreach($scouts as $scout){
										$s++;
										}
									}
								?>
								
								<div class="col-md-3">
									<p> <?php echo $badge["Name"]; ?></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p> <?php echo $s; ?></p>
								</div>
								
								
								
								
								
								
								
									<?php } } ?>
                            </div>
                        </div>
						
						
						
						<div class="row">
                            <div class="col-md-12">
							
                                <h3>Journeys</h3>
								
								<div class="col-md-3">
									<p><b>Journey Badges Needed</b></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p><b>Quantity Needed</b></p>
								</div>
								<div class="col-md-3">
									<p><b>Journey Badges Needed</b></p>
								</div>
								
								<div class="col-md-3">
									<p><b>Quantity Needed</b></p>
								</div>
								
								
								<?php
									$journeys = getAllJourneys();
									foreach($journeys as $j){
										$quests = getQuestsForJourney($j["JID"]);
										foreach($quests as $q){
										
										$array = getScoutCountForJourneyQuest($q["QID"]);
										
										if($array[1] > 0){
											
								?>
								
								<?php
									if($scouts = getEarnedByJourneyQuest($q["QID"]))
									{
										$s = 0;
										foreach($scouts as $scout){
											$s++;
										}
									}
								?>
								
								
								<div class="col-md-3">
									<p> <?php echo $q["Name"]; ?></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p> <?php echo $s; ?></p>
								</div>
								
								
								
								
								
								
								
								
									<?php } } }?>
                            </div>
                        </div>
						
						
						<div class="row">
                            <div class="col-md-12">
                                <h3>Awards</h3>
								
								<div class="col-md-3">
									<p><b>Award Badges Needed</b></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p><b>Quantity Needed</b></p>
								</div>
								<div class="col-md-3">
									<p><b>Award Badges Needed</b></p>
								</div>
								
								<div class="col-md-3">
									<p><b>Quantity Needed</b></p>
								</div>
								
								<?php
									$awards = getAllAwards();
									foreach($awards as $a){
										
										$array = getAwardScoutCount($a["AID"]);
										//var_dump($array);
										if($array[1] > 0){
											
								?>
								
								<?php
									if($scouts = getEarnedByAward($a["AID"]))
									{
										$s = 0;
										foreach($scouts as $scout){
										$s++;
										}
									}
								?>
								
								<div class="col-md-3">
									<p> <?php echo $a["Name"]; ?></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p> <?php echo $s; ?></p>
								</div>
								
								
								
								
								
									<?php } } ?>
                            </div>
                        </div>
						
						
						<div class="row">
                            <div class="col-md-12">
                                <h3>Bridges</h3>
								
								<div class="col-md-3">
									<p><b>Bridge Badges Needed</b></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p><b>Quantity Needed</b></p>
								</div>
								<div class="col-md-3">
									<p><b>Bridge Badges Needed</b></p>
								</div>
								
								<div class="col-md-3">
									<p><b>Quantity Needed</b></p>
								</div>
								
								<?php
									$bridges = getAllBridges();
									foreach($bridges as $b){
										
										$array = getBridgeScoutCount($b["BID"]);
										
										if($array[1] > 0){
											
								?>
								
								
								<?php
									if($scouts = getEarnedByBridge($b["BID"]))
									{
										$s = 0;
										foreach($scouts as $scout){
										$s++;
										}
									}
								?>
								
								<div class="col-md-3">
									<p> <?php echo $b["Name"]; ?></p>
								</div>
								
								<div class="col-md-3" style="border-right: 1px solid;">
									<p> <?php echo $s; ?></p>
								</div>
								
								
								
								
									<?php } } ?>
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