<?php 
include 'query.php'; 
session_start();

if(!isset($_SESSION['user']))
{
	$_SESSION['noLog'] = 1;
	header('location: CreateUser.php');
}
if(isset($_SESSION['IDUN'])){
	echo "<script>alert('Scout ID Unavailable!');</script>";
	$scout = $_SESSION['IDUN'];
	unset($_SESSION['IDUN']);
}
else{
	$scout = $_POST['sid'];
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
$scoutinfo = getScout($scout);
list($first,$last) = split(" ",$scoutinfo["Name"]);
list($year,$month,$day) = split("-",$scoutinfo["DoB"]);
$address = $scoutinfo["address"];
$area1 = substr($scoutinfo["PhoneNumber"],1, 3);
$rest1 = substr($scoutinfo["PhoneNumber"],5);
$area2 = substr($scoutinfo["BackupPhone"],1, 3);
$rest2 = substr($scoutinfo["BackupPhone"],5);
$email = $scoutinfo["email"];
list($parent1,$parent2) = split(" & ",$scoutinfo["Parents"]);
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
			<form action="MyTroop.php" method="POST">
				<input type = "hidden" name="deleteScout" value="<?php echo $first . ", " . $last;?>">
				<input type = "hidden" name="sid" value="<?php echo $sid; ?>">
				<h1>Edit Scout <button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Scout"><span class="glyphicon glyphicon-trash"></span> Delete Scout</button></h1>
			</form>
				
				<form role="form" method="post" action="EditTroopOp.php">
					<div class="col-md-12">
						<label>Name</label>
					</div>
					<div class="col-md-6"> <!--Enter First name -->
						<div class="form-group">
							<label for="FirstName">First</label>
							<input class="form-control" id="FirstName" name="FirstName" type="text" pattern="[A-Za-z]+" value ="<?php echo $first;?>" title="No numbers, spaces, or symbols">
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<label for="LastName">Last</label>
							<input class="form-control" id="LastName" name="LastName" pattern="[A-Za-z]+" type="text" value ="<?php echo $last;?>" title="No numbers, spaces, or symbols">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Scout ID -->
						<div class="form-group">
							<label for="ScoutID">Scout ID #</label>
							<input class="form-control" id="ScoutID" name="ScoutID" pattern="[0-9]+" type="text" value ="<?php echo $sid;?>" title="Only numbers allowed">
						</div>
					</div>
				
					<div class="col-md-12">
						<label>Date of Birth</label>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Day)-->
						<div class="form-group">
							<input class="form-control" id="day" name="day" type="text" maxlength="2" placeholder="DD" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])" value ="<?php echo $day;?>" title="Only numbers allowed">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Month)-->
						<div class="form-group">
							<input class="form-control" id="month" name="month" type="text" maxlength="2" placeholder="MM" pattern="(0[1-9]|1[012])" value ="<?php echo $month;?>" title="Only numbers allowed">
						</div>
					</div>
					<div class="col-md-4"> <!--Enter Date of Birth (Year)-->
						<div class="form-group">
							<input class="form-control" id="year" name="year" type="text" maxlength="4" placeholder="YYYY" pattern="[0-9]{4}" value ="<?php echo $year;?>" title="Only numbers allowed">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Address -->
						<div class="form-group">
							<label for="Address">Address</label>
							<input class="form-control" id="Address" name="Address" type="text"  value ="<?php echo $address;?>">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="PhoneNumAC" name="PhoneNumAC" type="text" maxlength="3" placeholder="555" pattern="[0-9]{3}" value ="<?php echo $area1;?>" title="Only numbers allowed">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Phone Number -->
						<div class="form-group">
							<input class="form-control" id="PhoneNum" name="PhoneNum" type="text" maxlength="8" placeholder="555-5555" pattern="([0-9]{3})-([0-9]{4})" value ="<?php echo $rest1;?>" title="Must be in 555-5555 format">
						</div>
					</div>
					<div class="col-md-12">
						<label for="TroopNum">Backup Phone Number</label>
					</div>
					<div class="col-md-3"> <!--Enter Backup Phone Number Area Code-->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNumAC" name="BackupPhoneNumAC" type="text" maxlength="3" placeholder="555" pattern="[0-9]{3}"  value ="<?php echo $area2;?>" title="Only numbers allowed">
						</div>
					</div>
					<div class="col-md-9"> <!--Enter Backup Phone Number -->
						<div class="form-group">
							<input class="form-control" id="BackupPhoneNum" name="BackupPhoneNum" type="text" maxlength="8" placeholder="555-5555" pattern="([0-9]{3})-([0-9]{4})" value ="<?php echo $rest2;?>" title="Must be in 555-5555 format">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<label for="TroopNum">Email</label>
							<input class="form-control" id="Email" name="Email" type="text" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,3}$" value ="<?php echo $email;?>" title="Enter a valid email address, eg. Example@gmail.com">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 1 -->
						<div class="form-group">
							<label for="TroopNum">Parent(s) or Parental Gaurdian(s)</label>
							<input class="form-control" id="Parent1" name="Parent1" type="text" pattern="[A-Za-z]+ [A-Za-z]+" value ="<?php echo $parent1;?>" title="First and last name required">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter Parent 2 -->
						<div class="form-group">
							<input class="form-control" id="Parent2" name="Parent2" type="text" pattern="[A-Za-z]+ [A-Za-z]+" value ="<?php echo $parent2;?>" title="First and last name required">
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
                            <select class="form-control" id="Rank" name="Rank">
                                <option><?php echo $rank;?></option>
                                <option>Daisy</option>
                                <option>Brownie</option>
                                <option>Junior</option>
                                <option>Cadette</option>
                                <option>Senior</option>
                                <option>Ambassador</option> 

                              </select>
                        </div>
					</div>
					
					<input type="hidden" name="oldsid" value="<?php echo $_POST['sid']; ?>">
					<div class="row">
						<div class="col-md-6">
							<a href="MyTroop.php"><button type="button" class="btn btn-default pull-Left"><span class="glyphicon glyphicon-remove"></span> Cancel</button></a>
						</div>
						
						<div class="col-md-6">
							<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Scout"><span class="glyphicon glyphicon-floppy-disk"></span> Submit</button>
						</div>
					</div>
				</form>
				<div class="col-md-6">
					<p> &nbsp </p>
				</div>
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