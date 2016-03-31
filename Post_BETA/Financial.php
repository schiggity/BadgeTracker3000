<?php include 'query.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Change Page Tiltle Here -->
	<title>Financial Tracking</title> 
	<?php include 'bootstrap.html';?>
</head>
<body>

<!---------------------------------------------------------------- NAV BAR -------------------------------------------------------->
<?php include 'navBar.php'; ?>


<!-------------------------------------------------------------- TABS ------------------------------------------------------------->
<div class="container">
        <div class="row-fluid">
            <div class="col-md-12">
                <h1>Financial Tracking</h1>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#Tab1" data-toggle="tab">All</a></li>
                    <li><a href="#Tab2" data-toggle="tab">Events</a></li>
                    <li><a href="#Tab3" data-toggle="tab">Cookies</a></li>
                    <li><a href="#Tab4" data-toggle="tab">Nuts and Candy</a></li>
					<li><a href="#Tab5" data-toggle="tab">Special Purpose</a></li>
					<li style="float: right;"><a href="/addFinance.php">+Add Finances</a></li>
					
					
										
                </ul>
				
				<!-- All Scouts tab and collapsing panel start -->
				
                <div class="tab-content my-tab"> 
                    <div class="tab-pane active" id="Tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>All Finances</h3>
								
								<?php
									$finances = getAllFinance();
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse0<?php echo $finance["FID"];?>"><?php echo $finance["FID"];  ?></a>
												
											</h4>
										</div>
										<div id="collapse0<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<p> Need to echo out scout, amount owed, amount paid											
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="/ScoutRecords.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Financial Records </button>
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
									$finances = getFinanceByType('1%');
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse1<?php echo $finance["FID"];?>"><?php echo $finance["FID"];  ?></a>
												
											</h4>
										</div>
										<div id="collapse1<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<p> Need to echo out scout, amount owed, amount paid											
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="/ScoutRecords.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Financial Records </button>
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
					
					<!--                -->
					
					<div class="tab-pane" id="Tab3">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Cookies</h3>
								
								<?php
									$finances = getFinanceByType('2%');
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse2<?php echo $finance["FID"];?>"><?php echo $finance["FID"];  ?></a>
												
											</h4>
										</div>
										<div id="collapse2<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<p> Need to echo out scout, amount owed, amount paid											
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="/ScoutRecords.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Financial Records </button>
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
					
					
					<!--                -->
					
					<div class="tab-pane" id="Tab4">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Nuts and Candy</h3>
								
								<?php
									$finances = getFinanceByType('3%');
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse3<?php echo $finance["FID"];?>"><?php echo $finance["FID"];  ?></a>
												
											</h4>
										</div>
										<div id="collapse3<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<p> Need to echo out scout, amount owed, amount paid											
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="/ScoutRecords.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Financial Records </button>
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
					
					<!--                -->
					
					<div class="tab-pane" id="Tab5">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Special Purpose</h3>
								
								<?php
									$finances = getFinanceByType('4%');
									foreach($finances as $finance){
								?>
								
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse4<?php echo $finance["FID"];?>"><?php echo $finance["FID"];  ?></a>
												
											</h4>
										</div>
										<div id="collapse4<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
											<ul class="list-group">
												<div class="container"> 													            
													<table  style="width: 90%;">														
														<tbody>
															<tr>
																<p> Need to echo out scout, amount owed, amount paid											
															</tr>
															<tr>				
																<td align="right"> 
																	<form action="/ScoutRecords.php" method="post">																		
																		<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
																		<button type="submit" class="btn btn-secondary btn-lg">Financial Records </button>
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
					
					<!--                -->
				</div>
				</div>	
			</div>
		</div>
</div>			
	
</body>
	
</html>	