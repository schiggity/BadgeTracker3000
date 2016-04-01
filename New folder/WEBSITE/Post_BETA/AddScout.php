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
  <title>Add Scout</title> <!-- Change Page Tiltle Here -->
  <!---------------------------------------------------- Stuff that is necessary for Bootstrap --------------------------------------------->
  <?php include 'bootstrap.html';?>
  <link rel="stylesheet" type="text/css" href="CreateUserCSS.css">
</head>
<body>
<?php
if(isset($_SESSION['AddedScout']))
{ ?>
	<script>
	
	alert("Scout Succesfully Added!");

	</script>
<?php
	unset($_SESSION['AddedScout']);
} ?>
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
				<h1>Add New Scout</h1>
				<form role="form" method="post" action="AddTroopOp.php">
					<div class="col-md-12">
						<label>Name</label>
					</div>
					<div class="col-md-6"> <!--Enter First name -->
						<div class="form-group">
							<label for="FirstName">First</label>
							<input class="form-control" id="FirstName" name="FirstName" type="text">
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<label for="LastName">Last</label>
							<input class="form-control" id="LastName" name="LastName" type="text">
						</div>
					</div>
					<div class="col-md-8"> <!--Enter Scout ID -->
						<div class="form-group">
							<label for="ScoutID">Scout ID #</label>
							<input class="form-control" id="ScoutID" name="ScoutID" type="text">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Scout ID -->
						<div class="form-group form-inline">
							<div class="checkbox">
								<label for="NoID">Scout has no Scout ID</label>
								<input class="form-control" id="NoID" name="NoID" type="checkbox">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<label>Date of Birth</label>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Day)-->
						<div class="form-group">
							<input class="form-control" id="day" name="day" type="text" maxlength="2" placeholder="DD">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Month)-->
						<div class="form-group">
							<input class="form-control" id="month" name="month" type="text" maxlength="2" placeholder="MM">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Year)-->
						<div class="form-group">
							<input class="form-control" id="year" name="year" type="text" maxlength="4" placeholder="YYYY">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Address -->
						<div class="form-group">
							<label for="Address">Address</label>
							<input class="form-control" id="Address" name="Address" type="text">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="PhoneNumAC" name="PhoneNumAC" type="text" maxlength="3" placeholder="555">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Phone Number -->
						<div class="form-group">
							<input class="form-control" id="PhoneNum" name="PhoneNum" type="text" maxlength="8" placeholder="555-5555">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Backup Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Backup Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNumAC" name="BackupPhoneNumAC" type="text" maxlength="3" placeholder="555">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Backup Phone Number -->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNum" name="BackupPhoneNum" type="text" maxlength="8" placeholder="555-5555">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Email</label>
							<input class="form-control" id="Email" name="Email" type="text">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 1 -->
						<div class="form-group">
							<label for="TroopNum">Parent(s) or Parental Gaurdian(s)</label>
							<input class="form-control" id="Parent1" name="Parent1" type="text">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 2 -->
						<div class="form-group">
							<input class="form-control" id="Parent2" name="Parent2" type="text">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Grade</label>
							<input class="form-control" id="Grade" name="Grade" type="text" placeholder="ex: 11">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
                        <div class="form-group">
                            <label for="TroopNum">Rank</label>
                            <select class="form-control" id="Rank" name="Rank">
                                <option>Daisy</option>
                                <option>Brownie</option>
                                <option>Junior</option>
                                <option>Cadette</option>
                                <option>Senior</option>
                                <option>Ambassador</option>                                
                              </select>
                        </div>
                    </div>
					<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Scout">Submit</button>
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