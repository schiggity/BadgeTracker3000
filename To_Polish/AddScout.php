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
							<input class="form-control" id="FirstName" name="FirstName" type="text" pattern="[A-Za-z]+" required>
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<label for="LastName">Last</label>
							<input class="form-control" id="LastName" name="LastName" type="text" type="text" pattern="[A-Za-z]+" required>
						</div>
					</div>
					<div class="col-md-8"> <!--Enter Scout ID -->
						<div class="form-group">
							<label for="ScoutID">Scout ID #</label>
							<input class="form-control" id="ScoutID" name="ScoutID" type="text" pattern="[0-9]+">
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
							<input class="form-control" id="day" name="day" type="text" maxlength="2" placeholder="DD" type="text" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])"required>
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Month)-->
						<div class="form-group">
							<input class="form-control" id="month" name="month" type="text" maxlength="2" placeholder="MM" pattern="(0[1-9]|1[012])"required>
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Year)-->
						<div class="form-group">
							<input class="form-control" id="year" name="year" type="text" maxlength="4" placeholder="YYYY" pattern="[0-9]{4}" required>
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Address -->
						<div class="form-group">
							<label for="Address">Address</label>
							<input class="form-control" id="Address" name="Address" type="text" required>
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="PhoneNumAC" name="PhoneNumAC" type="text" maxlength="3" placeholder="555" pattern="[0-9]{3}" required>
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Phone Number -->
						<div class="form-group">
							<input class="form-control" id="PhoneNum" name="PhoneNum" type="text" maxlength="8" placeholder="555-5555" pattern="([0-9]{3})-([0-9]{4})" required>
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Backup Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Backup Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNumAC" name="BackupPhoneNumAC" type="text" maxlength="3" placeholder="555" pattern="[0-9]{3}">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Backup Phone Number -->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNum" name="BackupPhoneNum" type="text" maxlength="8" placeholder="555-5555" pattern="([0-9]{3})-([0-9]{4})">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Email</label>
							<input class="form-control" id="Email" name="Email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Invalid Email">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 1 -->
						<div class="form-group">
							<label for="TroopNum">Parent(s) or Parental Gaurdian(s)</label>
							<input class="form-control" id="Parent1" name="Parent1" type="text" pattern="[A-Za-z]+ [A-Za-z]+" required>
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 2 -->
						<div class="form-group">
							<input class="form-control" id="Parent2" name="Parent2" type="text" pattern="[A-Za-z]+ [A-Za-z]+">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Grade</label>
							<select class="form-control" id="Grade" name="Grade" required>
                                <option>Pre-K</option>
                                <option>Kindergarten</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>05</option>     
								<option>06</option> 
								<option>07</option> 
								<option>08</option> 
								<option>09</option> 
								<option>10</option> 
								<option>11</option> 
								<option>12</option>  
                              </select>
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
                        <div class="form-group">
                            <label for="TroopNum">Rank</label>
                            <select class="form-control" id="Rank" name="Rank" required>
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

<script>

$('#NoID').click(function(){
$('#ScoutID').attr('disabled', this.checked)
$('#ScoutID').attr('required',! this.checked)

});

</script>


</body>
</html>