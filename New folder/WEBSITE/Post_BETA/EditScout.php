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
  <title>Edit Scout</title> <!-- Change Page Tiltle Here -->
  <!---------------------------------------------------- Stuff that is necessary for Bootstrap --------------------------------------------->
  <?php include 'bootstrap.html';?>
  <link rel="stylesheet" type="text/css" href="CreateUserCSS.css">
</head>
<body>
<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php'; 
$scoutinfo = getScout($_POST['sid']);
list($first,$last) = split(" ",$scoutinfo["Name"]);
list($year,$month,$day) = split("-",$scoutinfo["DoB"]);
$address = $scoutinfo["address"];
$area1 = substr($scoutinfo["PhoneNumber"],0, 3);
$rest1 = substr($scoutinfo["PhoneNumber"],3);
$area2 = substr($scoutinfo["BackupPhone"],0, 3);
$rest2 = substr($scoutinfo["BackupPhone"],3);
$email = $scoutinfo["email"];
list($parent1,$parent2) = split("&",$scoutinfo["Parents"]);
$grade = $scoutinfo["Grade"];
$rank = $scoutinfo["Ranks"];
$sid = $scoutinfo["SID"];
?>


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
				<h1>Edit Scout</h1>
				<form role="form" method="post" action="EditTroopOp.php">
					<div class="col-md-12">
						<label>Name</label>
					</div>
					<div class="col-md-6"> <!--Enter First name -->
						<div class="form-group">
							<label for="FirstName">First</label>
							<input class="form-control" id="FirstName" name="FirstName" type="text" value ="<?php echo $first;?>">
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<label for="LastName">Last</label>
							<input class="form-control" id="LastName" name="LastName" type="text" value ="<?php echo $last;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Scout ID -->
						<div class="form-group">
							<label for="ScoutID">Scout ID #</label>
							<input class="form-control" id="ScoutID" name="ScoutID" type="text" value ="<?php echo $sid;?>">
						</div>
					</div>
				
					<div class="col-md-12">
						<label>Date of Birth</label>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Day)-->
						<div class="form-group">
							<input class="form-control" id="day" name="day" type="text" maxlength="2" placeholder="DD" value ="<?php echo $day;?>">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Month)-->
						<div class="form-group">
							<input class="form-control" id="month" name="month" type="text" maxlength="2" placeholder="MM" value ="<?php echo $month;?>">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Year)-->
						<div class="form-group">
							<input class="form-control" id="year" name="year" type="text" maxlength="4" placeholder="YYYY" value ="<?php echo $year;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Address -->
						<div class="form-group">
							<label for="Address">Address</label>
							<input class="form-control" id="Address" name="Address" type="text" value ="<?php echo $address;?>">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="PhoneNumAC" name="PhoneNumAC" type="text" maxlength="3" placeholder="555" value ="<?php echo $area1;?>">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Phone Number -->
						<div class="form-group">
							<input class="form-control" id="PhoneNum" name="PhoneNum" type="text" maxlength="8" placeholder="555-5555" value ="<?php echo $rest1;?>">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Backup Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Backup Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNumAC" name="BackupPhoneNumAC" type="text" maxlength="3" placeholder="555" value ="<?php echo $area2;?>">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Backup Phone Number -->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNum" name="BackupPhoneNum" type="text" maxlength="8" placeholder="555-5555" value ="<?php echo $rest2;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Email</label>
							<input class="form-control" id="Email" name="Email" type="text" value ="<?php echo $email;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 1 -->
						<div class="form-group">
							<label for="TroopNum">Parent(s) or Parental Gaurdian(s)</label>
							<input class="form-control" id="Parent1" name="Parent1" type="text" value ="<?php echo $parent1;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 2 -->
						<div class="form-group">
							<input class="form-control" id="Parent2" name="Parent2" type="text" value ="<?php echo $parent2;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Grade</label>
							<input class="form-control" id="Grade" name="Grade" type="text" placeholder="ex: 11" value ="<?php echo $grade;?>">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Rank</label>
							<input class="form-control" id="Rank" name="Rank" type="text" placeholder="ex: Senior" value ="<?php echo $rank;?>">
						</div>
					</div>
					
					<input type="hidden" name="oldsid" value="<?php echo $_POST['sid']; ?>">
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