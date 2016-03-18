<?php 
include 'query.php'; 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Template</title> <!-- Change Page Tiltle Here -->
  <!---------------------------------------------------- Stuff that is necessary for Bootstrap --------------------------------------------->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CreateUserCSS.css">
</head>
<body>

<?php
if(isset($_SESSION['Error']))
{ ?>
	<script>
	
	alert("<?php echo $_SESSION['Error']; ?>");

	</script>
<?php
	unset($_SESSION['Error']);
} ?>

<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php';?>


<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- Intentionally left blank -->
        </div>
        <div id="CreateUserBlock" class="col-md-8">
            <div id="CreateUser" class="col-md-6">
				<h1>Create New User</h1>
				<form role="form" method="post" action="CreateUserAuth.php">
					
					<div class="col-md-6"> <!--Enter First name -->
						<div class="form-group">
							<!--<label for="FirstName">First</label>-->
							<input class="form-control" id="FirstName" name="FirstName" type="text" placeholder="First Name" required>
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<!--<label for="LastName">Last</label>-->
							<input class="form-control" id="LastName" name="LastName" type="text" placeholder="Last Name"required>
						</div>
					</div>
					
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<!--<label for="Email">Email</label>-->
							<input class="form-control" id="Email" name="Email" type="text" placeholder="Email"required>
						</div>
					</div>
					
					
					<div class="col-md-12"> <!--Enter Username -->
						<div class="form-group">
							<!--<label for="Username">Username</label>-->
							<input class="form-control" id="Username" name="Username" type="text" placeholder="Username"required>
						</div>
					</div>
					<div class="col-md-12"> <!--Enter password -->
						<div class="form-group">
							<!--<label for="password">Password:</label>-->
							<input type="password" class="form-control" id="Password" name="Password" placeholder="User Password"required>
						</div>
					</div>
					<div class="col-md-12"> <!--Confirm password -->
						<div class="form-group">
							<!--<label for="password">Confirm Password:</label>-->
							<input type="password" class="form-control" id="CPassword" name="CPassword" placeholder="Confirm User Password"required>
						</div>
					</div>
					
					<div class="col-md-6"> <!--Enter Troop Number -->
						<div class="form-group">
							<!--<label for="TroopNum">Troop Number</label>-->
							<input class="form-control" id="TroopNum" name="TroopNum" type="text" placeholder="Troop Number"required>
						</div>
					</div>
					
					<div class="col-md-6"> <!--Enter Troop Password -->
						<div class="form-group">
							<!--<label for="TroopNum">Troop Number</label>-->
							<input class="form-control" id="TroopPass" name="TroopPass" type="text" placeholder="Troop Password"required>
						</div>
					</div>
					<div class="col-md-6">
					<!-- intentionally left blank -->
					</div>
					<div class="col-md-5" style="line-height: 1em;">
						Are you creating a new troop?
					</div>
					<div class="col-md-1" style="line-height: 1em;">
					<!--<label for="TroopNum">Are you creating a new troop?</label> <!--New Troop? -->
						<div class="form-group">
							<input  id="TroopCheck" name="TroopCheck" type="checkbox" value ="isset" checked>
						</div>
					</div>
					<div name="Council" class="col-md-6"> <!--Enter Council -->
						<div class="form-group">
							<input class="form-control" id="Council" name="Council" type="text" placeholder="Council Name" hidden>
						</div>
					</div>
					<div name = "Leader" class="col-md-6"> <!--Enter Troop Leader -->
						<div class="form-group">
							<input class="form-control" id="Leader" name="Leader" type="text" placeholder="Troop Leader">
						</div>
					</div>
					
					<button type="submit" class="btn btn-default pull-right">Submit</button>
				</form>
			</div>
			<div id="AlreadyUser" class="col-md-6">
				<h1>Log-In</h1>
				<form role="form" method="post" action="LoginAuth.php">
					<div class="col-md-12"> <!--Enter Username -->
						<div class="form-group">
							<!--<label for="Username">Username</label>-->
							<input type="text" class="form-control" id="Username" name="Username" placeholder = "Username">
						</div>
					</div>
					<div class="col-md-12"> <!--Enter password -->
						<div class="form-group">
							<!--<label for="password">Password:</label>-->
							<input type="password" class="form-control" id="Password" name="Password" placeholder= "Password">
						</div>
					</div>
					
					
					
					<button type="submit" class="btn btn-default pull-right">Log-In</button>
				</form>
			</div>
        </div>
		<div class="col-md-2">
            <!-- Intentionally left blank -->
        </div>
    </div>
</div>
</body>
</html>

<script>
$("#TroopCheck").change(function(){
	if($(this).prop("checked")){
		$('#Council').show();
		$('#Leader').show();
	}
	else
	{
		$('#Council').hide();
		$('#Leader').hide();
	}
});
</script>
