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
  <title>Template</title> <!-- Change Page Tiltle Here -->
  <!---------------------------------------------------- Stuff that is necessary for Bootstrap --------------------------------------------->
  <?php include 'bootstrap.html';?>
  <link rel="stylesheet" type="text/css" href="CreateUserCSS.css">
</head>
<body>

<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php'; ?>


<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- Intentionally left blank -->
        </div>
        <div id="CreateUserBlock" class="col-md-6">
		<div class="col-md-1">
            <!-- Intentionally left blank -->
        </div>
            <div id="addForm" class="col-md-10">
				<h1>Add Finance</h1>
				<form role="form" method="post" action="AddFinanceOp.php">
					<div class="col-md-6">
						<label>Select type</label>
					
					
					<div class="form-group">
					
					<select id="FinanceType" name="FinanceType" required>
					  <option value="">Select a Type</option>
					  <option value="1%">Event</option>
					  <option value="2%">Cookies</option>
					  <option value="3%">Nuts and Candy</option>
					  <option value="4%">Special Purpose</option>
					</select>
				
					</div>
					</div>
					<!--Scout Amount owed Amount paid -->
					
					<div class="col-md-6">
						<label>Select Scout</label>
						<div>
					 <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout">Scouts</button>
					</div>
					</div>
					
					<!---->
					<?php
					
					$scouts = getAllScouts();
					
					?>
					<!-- Modal content displaying Scout names-->
					<div id="ModalScout" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Scouts</h4>
								</div>
									<div class="modal-body">
										<div id="nameCheckboxes">
											<form method="post">
												<p>
													<?php
													foreach($scouts as $scout){
													echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
													}
													?>
													</p>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
									</div>
							</div>
						</div>	
					</div>
					
									
					<div class="col-md-12"> <!--Enter Amount -->
						<div class="form-group">
							<label for="Amount">Amount</label>
							<input class="form-control" id="Amount" name="Amount" pattern="[0-9]+" type="text">
						</div>
					</div>
					
					<div class="col-md-12"> <!--Enter Purpose -->
						<div class="form-group">
							<label for="Purpose">Purpose</label>
							<input class="form-control" id="Purpose" name="Purpose" type="text">
						</div>
					</div>
					
					
					
					
					<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Finance">Submit</button>
				</form>
			</div>
			<div class="col-md-1">
            <!-- Intentionally left blank -->
			</div>
        </div>
		<div class="col-md-3">
            <!-- Intentionally left blank -->
        </div>
    </div>
</div>
</body>
</html>
