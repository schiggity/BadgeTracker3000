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
	<title>Awards & Bridges</title> 
	<?php include 'bootstrap.html';?>
</head>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<body>

<?php include 'navBar.php'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------>
<div class="col-md-1">
</div>
<div class="col-md-10">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>Awards & Bridges</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">Awards</a></li>
                    <li><a href="#Tab2" data-toggle="tab">Bridges</a></li>
				</ul>
                <div class="tab-content my-tab">  
<!----------------------------------------- Awards tab collapsing panel start ------------------------------------------->                    
					
					<div class="tab-pane active" id="Tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Awards</h3>
								<?php
									$awards = getAllAwards();
									foreach($awards as $award){
								?>
								<!-- Modal -->
								<div id="Modal<?php echo $award["AID"]?>" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content displaying award requirements-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title"><?php echo $award["Name"]?></h4>
											</div>
											<div class="modal-body">
												<p>
												<?php
													foreach(getAwardRequirements($award["AID"]) as $req){
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
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $award["AID"]; ?>" href="#collapse<?php echo $award["AID"]?>"><div class="row"><?php echo $award["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $award["AID"]?>" class="panel-collapse collapse" >
											<ul class="list-group">
												<div class="container-fluid"> 
													       
													<table  style="width: 90%;">														
														<tbody><?php $c = getAwardScoutCount($award["AID"]); ?>
															<tr>
															<td rowspan="4"><img src="img/awards/<?php echo $award["AID"] ?>.jpg"></td>
															<td align="right">Number of Scouts Earned: <?php echo $c[1]; ?></td>
															<td rowspan="2" align="right"><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $award["AID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Award Requirements</button></td>
															</tr>
															
															<tr>
															
															<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															
															<tr>
															<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>
															<td rowspan="2" align ="right">
																<form action="UpdateAwardRecords.php#<?php echo $award["AID"]; ?>" method="post">
																	<input type="hidden" name="BTab" value="1">	
																	<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $award["AID"] ?>">	
																	<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
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
<!----------------------------------------- Bridges tab collapsing panel start ------------------------------------------->					
                    <div class="tab-pane" id="Tab2">  
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Bridges</h3>
								<?php
									$bridges = getAllBridges();
									foreach($bridges as $bridge){
								?>
								<!-- Modal-->
								<div id="Modal<?php echo $bridge["BID"]?>B" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content displaying bridge requirements-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title"><?php echo $bridge["Name"]?></h4>
											</div>
											<div class="modal-body">
												<p>
												<?php
													foreach(getBridgeQuests($bridge["BID"]) as $quest){
														echo "<b>" . $quest["Name"] . ":</b><br>";
														foreach(getBridgeRequirementsByQuest($quest["BQID"]) as $req){
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
												<a data-toggle="collapse" id="<?php echo $bridge["Name"];?>B" href="#collapse<?php echo $bridge["BID"]?>B"><div class="row"><?php echo $bridge["Name"]; ?></div></a>
											</h4>
										</div>
										<div id="collapse<?php echo $bridge["BID"]?>B" class="panel-collapse collapse" >
											<ul class="list-group">
												<div class="container-fluid"> 
													           
													<table  style="width: 90%;">														
														<tbody><?php $c = getBridgeScoutCount($bridge["BID"]); ?>
															<tr>
															<td rowspan="4"><img src="img/bridges/<?php echo $bridge["BID"] ?>.jpg"></td>
															<td align="right">Number of Scouts Earned: <?php echo $c[1]; ?></td>
															<td rowspan="2" align="right"> <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Modal<?php echo $bridge["BID"]?>"><span class="glyphicon glyphicon-list-alt"></span> Bridge Requirements</button></td>
															</tr>
															
															<tr>
															
															<td align="right">Number of Scouts Awarded: <?php echo $c[2]; ?></td>																	
															</tr>
															
															<tr>
															
															<td align="right">Number of Scouts Started: <?php echo $c[0]; ?></td>	
															<td rowspan="2" align ="right">															
															<form action="UpdateBridgeRecords.php#<?php echo $bridge["BID"]; ?>" method="post">
																<input type="hidden" name="BTab" value="1">	
																<input type="hidden" name="Bcollapse" value="<?php echo "collapse" . $bridge["BID"] ?>">
																<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-refresh"></span> Update Records </button>
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
	<div class="col-md-1">
</div>
</body>
</html>

