<?php include 'query.php';
session_start();

if(isset($_POST['delete']))
{
	deleteFinance($_POST['delete']);
	echo "<script> alert('Financial record deleted'); </script>";
}
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
				
				<li class="active"><a href="#Tab2" data-toggle="tab">Events</a></li>
				<li><a href="#Tab3" data-toggle="tab">Cookies</a></li>
				<li><a href="#Tab4" data-toggle="tab">Nuts and Candy</a></li>
				<li><a href="#Tab5" data-toggle="tab">Special Purpose</a></li>
				<li style="float: right;"><a href="addFinance.php"><span class="glyphicon glyphicon-plus"></span> Add Finances</a></li>
				
				
									
			</ul>
			
			<!-- All Scouts tab and collapsing panel start -->
			
			<div class="tab-content my-tab"> 
				
				<!-- Events tab and collapsing panel start -->
				
				
				
				<div class="tab-pane active" id="Tab2">
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
											<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse<?php echo $finance["FID"];?>">
											
											<div class="row">
												<div class="col-md-4">
												<?php echo $finance["Purpose"];  ?>
												</div>
												<div class="col-md-4">
												$<?php echo $finance["Amount"];  ?>
												</div>
												<div class="col-md-4">
												<?php echo $finance["TheDate"];  ?>
												</div>
											</div>
											
											</a>
											
											
											
										</h4>
									</div>
									<div id="collapse<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
										<ul class="list-group">
											<div class="container"> 													          	
													
												<div class="col-md-6">
													<label>Scouts</label>
												</div>
												<div class="col-md-6">
													<label>Paid in Full?</label>
												</div>
												
												
													<?php
													$scouts = getScoutsByFID($finance['FID']);
													foreach($scouts as $scout){
													?>
													
													<div class="col-md-6"> <!--Full payment boolean -->
													<?php echo $scout['Name']; ?>
													</div>
													
													<div class="col-md-6"> <!--Full payment boolean -->
														<div class="form-group">
													
													<?php if(getPayment($finance['FID'] , $scout["SID"])){ 
														echo "yes";
														
													}
														else{
															echo "no";
														}
													?>
														</div>
													</div>
		
		
													<?php } ?>
																								
												<div class="row">
													<div class="col-md-6">
													<h4>Cost: $<?php echo $finance["Amount"];?></h4>
													</div>
															
													<div class="col-md-6">
														<form action="editFinance.php" method="post">																		
															<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
															<button type="submit" class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-pencil"></span> Edit Record</button>
														</form> 
														<form action="Financial.php" Method="POST">
														<input type="hidden" name="delete" value="<?php echo $finance["FID"]; ?>">	
														<button type="submit" class="btn btn-secondary btn-lg"><span class="glyphicon glyphicon-remove"></span> Delete Finance</button>
														</form>
													</div>	
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
											<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse<?php echo $finance["FID"];?>">
											
											<div class="row">
												<div class="col-md-4">
												<?php echo $finance["Purpose"];  ?>
												</div>
												<div class="col-md-4">
												$<?php echo $finance["Amount"];  ?>
												</div>
												<div class="col-md-4">
												<?php echo $finance["TheDate"];  ?>
												</div>
											</div>
											
											</a>
											
										</h4>
									</div>
									<div id="collapse<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
										<ul class="list-group">
											<div class="container"> 													          	
													
												<div class="col-md-6">
													<label>Scouts</label>
												</div>
												<div class="col-md-6">
													<label>Paid in Full?</label>
												</div>
												
												
												<?php
												$scouts = getScoutsByFID($finance['FID']);
												foreach($scouts as $scout){
												?>
												
												<div class="col-md-6"> <!--Full payment boolean -->
												<?php echo $scout['Name']; ?>
												</div>
												
												<div class="col-md-6"> <!--Full payment boolean -->
													<div class="form-group">
												
												<?php if(getPayment($finance['FID'] , $scout["SID"])){ 
													echo "yes";
													
												}
													else{
														echo "no";
													}
												?>
													</div>
												</div>
	
	
												<?php } ?>
																								
												<div class="row">
													<div class="col-md-6">
													<h4>Cost: $<?php echo $finance["Amount"];?></h4>
													</div>
															
													<div class="col-md-6">
														<form action="editFinance.php" method="post">																		
															<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
															<button type="submit" class="btn btn-secondary btn-lg">Edit Record</button>
														</form> 
														<form action="Financial.php" Method="POST">
														<input type="hidden" name="delete" value="<?php echo $finance["FID"]; ?>">	
														<button type="submit" class="btn btn-secondary btn-lg">Delete Finance</button>
														</form>
													</div>	
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
											<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse<?php echo $finance["FID"];?>">
											
											<div class="row">
												<div class="col-md-4">
												<?php echo $finance["Purpose"];  ?>
												</div>
												<div class="col-md-4">
												$<?php echo $finance["Amount"];  ?>
												</div>
												<div class="col-md-4">
												<?php echo $finance["TheDate"];  ?>
												</div>
											</div>
											
											</a>
											
										</h4>
									</div>
									<div id="collapse<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
										<ul class="list-group">
											<div class="container"> 													          	
													
												<div class="col-md-6">
												<label>Scouts</label>
												</div>
												<div class="col-md-6">
													<label>Paid in Full?</label>
												</div>
												
												
												<?php
												$scouts = getScoutsByFID($finance['FID']);
												foreach($scouts as $scout){
												?>
												
												<div class="col-md-6"> <!--Full payment boolean -->
												<?php echo $scout['Name']; ?>
												</div>
												
												<div class="col-md-6"> <!--Full payment boolean -->
													<div class="form-group">
												
												<?php if(getPayment($finance['FID'] , $scout["SID"])){ 
													echo "yes";
													
												}
													else{
														echo "no";
													}
												?>
													</div>
												</div>
	
	
												<?php } ?>
																							
												<div class="row">
													<div class="col-md-6">
													<h4>Cost: $<?php echo $finance["Amount"];?></h4>
													</div>
															
													<div class="col-md-6">
														<form action="editFinance.php" method="post">																		
															<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
															<button type="submit" class="btn btn-secondary btn-lg">Edit Record</button>
														</form> 
														<form action="Financial.php" Method="POST">
														<input type="hidden" name="delete" value="<?php echo $finance["FID"]; ?>">	
														<button type="submit" class="btn btn-secondary btn-lg">Delete Finance</button>
														</form>
													</div>	
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
											
											<a data-toggle="collapse" id="<?php echo $finance["FID"]; ?>" href="#collapse<?php echo $finance["FID"];?>">
											<div class="row">
												<div class="col-md-4">
												<?php echo $finance["Purpose"];  ?>
												</div>
												<div class="col-md-4">
												$<?php echo $finance["Amount"];  ?>
												</div>
												<div class="col-md-4">
												<?php echo $finance["TheDate"];  ?>
												</div>
											</div>
											
											</a>
											
										</h4>
										
									</div>
									
									<div id="collapse<?php echo $finance["FID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
										<ul class="list-group">
											<div class="container"> 													          	
													
												<div class="col-md-6">
												<label>Scouts</label>
												</div>
												<div class="col-md-6">
													<label>Paid in Full?</label>
												</div>
												
												
												<?php
												$scouts = getScoutsByFID($finance['FID']);
												foreach($scouts as $scout){
												?>
												
												<div class="col-md-6"> <!--Full payment boolean -->
												<?php echo $scout['Name']; ?>
												</div>
												
												<div class="col-md-6"> <!--Full payment boolean -->
													<div class="form-group">
													
													<?php if(getPayment($finance['FID'] , $scout["SID"])){ 
														echo "yes";
														
													}
														else{
															echo "no";
														}
													?>
													</div>
												</div>
	
	
												<?php } ?>
																								
												<div class="row">
													<div class="col-md-6">
													<h4>Cost: $<?php echo $finance["Amount"];?></h4>
													</div>
															
													<div class="col-md-6">
														<form action="editFinance.php" method="post">																		
															<input type="hidden" name="sid" value="<?php echo $finance["FID"]; ?>">	
															<button type="submit" class="btn btn-secondary btn-lg">Edit Record</button>
														</form> 
														<form action="Financial.php" Method="POST">
														<input type="hidden" name="delete" value="<?php echo $finance["FID"]; ?>">	
														<button type="submit" class="btn btn-secondary btn-lg">Delete Finance</button>
														</form>
													</div>	
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
				
				<!--                -->
			</div>
		</div>	
	</div>
</div>
			
	
</body>
	
</html>	