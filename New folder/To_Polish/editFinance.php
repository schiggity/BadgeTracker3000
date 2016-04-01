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
			
				<h1>Edit Finance</h1>
				<form role="form" method="post" action="editFinanceOp.php">
				
					<?php
						$fid = $_POST['sid'];
						//echo $fid;
						
						$finances = getFinanceByFID($fid);
						foreach($finances as $finance){
					?>
					<input type="hidden" name="fid" value="<?php echo $_POST['sid']; ?>">
					<div class="col-md-12">
						<label>Purpose</label>
						
					
					
					<div class="col-md-12">
					<?php echo $finance["Purpose"]; ?>
					</div>
					</div>
						<?php } ?>
					<!--Scout Amount owed Amount paid -->
					
					
					
					<div class="col-md-6">
						<label>Scouts</label>
					</div>
					
					<div class="col-md-6">
						<label>Paid in Full?</label>
					</div>
					
					
						<?php
						$scouts = getScoutsByFID($_POST['sid']);
						foreach($scouts as $scout){
						?>
						
						<div class="col-md-6"> <!--Full payment boolean -->
						<?php echo $scout['Name']; ?>
						</div>
						
						<div class="col-md-6"> <!--Full payment boolean -->
							<div class="form-group">
							<input class="align-left" id="fullPay" name="FullPay[]" value="<?php echo $scout["SID"]; ?>" <?php if(getPayment($_POST['sid'] , $scout["SID"])){ echo "checked"; } ?> type="checkbox">
							</div>
						</div>
						
						
						<?php } ?>
				
					<div class="col-md-12"> <!--Enter Amount -->
						<div class="form-group">
							<label for="Amount">Edit Amount</label>
							<input class="form-control" id="Amount" name="Amount" type="text" pattern="[0-9]+" value="<?php echo $finance["Amount"] ?>" placeholder="<?php echo $finance["Amount"] ?>">
						</div>
					</div>
					
					<div class="col-md-12"> <!--Enter Purpose -->
						<div class="form-group">
							<label for="Purpose">Edit Purpose</label>
							<input class="form-control" id="Purpose" name="Purpose" type="text" value="<?php echo $finance["Purpose"] ?>" placeholder="<?php echo $finance["Purpose"] ?>" >
						</div>
					</div>
				
				
				
				
					<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Edit Finance">Submit</button>
				</form>
			</div>				
		</div>			
    </div>
</div>

</body>
</html>
