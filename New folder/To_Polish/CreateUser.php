<?php 
include 'query.php'; 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create User/Login</title> <!-- Change Page Tiltle Here -->
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

<?php
if(isset($_SESSION['noLog']))
{ ?>
	<script>
	
	alert("Please log in or create an account before viewing this page");

	</script>
	
	
	
<?php
	unset($_SESSION['noLog']);
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
							<input class="form-control" id="FirstName" name="FirstName" type="text" pattern="[A-Za-z]+" placeholder="First Name" required>
						</div>
					</div>
					<div class="col-md-6"> <!--Enter Last name -->
						<div class="form-group">
							<!--<label for="LastName">Last</label>-->
							<input class="form-control" id="LastName" name="LastName" type="text" pattern="[A-Za-z]+" placeholder="Last Name"required>
						</div>
					</div>
					
					<div class="col-md-12"> <!--Enter Email -->
						<div class="form-group">
							<!--<label for="Email">Email</label>-->
							<input class="form-control" id="Email" name="Email" type="text" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email"required>
						</div>
					</div>
					
					
					<div class="col-md-12"> <!--Enter Username -->
						<div class="form-group">
							<!--<label for="Username">Username</label>-->
							<input class="form-control" id="Username" name="Username" type="text" pattern="[A-Za-z0-9]{4,25}$" placeholder="Username"required>
						</div>
					</div>
					<div class="col-md-12"> <!--Enter password -->
						<div class="form-group">
							<!--<label for="password">Password:</label>-->
							<input type="password" class="form-control" id="Password" name="Password" pattern="^(?=^.{5,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="User Password"required>
						</div>
					</div>
					<div class="col-md-12"> <!--Confirm password -->
						<div class="form-group" id="confirmPassword">
							<!--<label for="password">Confirm Password:</label>-->
							<input type="password" class="form-control" id="CPassword" name="CPassword" onkeyup="checkPass(); return false;" placeholder="Confirm User Password" required >
							<span id="confirmMessage" class="confirmMessage"></span>
						</div>
					</div>
					
					<div class="col-md-6"> <!--Enter Troop Number -->
						<div class="form-group">
							<!--<label for="TroopNum">Troop Number</label>-->
							<input class="form-control" id="TroopNum" name="TroopNum" type="text" pattern="[0-9]+" placeholder="Troop Number" required >
						</div>
					</div>
					
					<div class="col-md-6"> <!--Enter Troop Password -->
						<div class="form-group">
							<!--<label for="TroopNum">Troop Number</label>-->
							<input class="form-control" id="TroopPass" name="TroopPass" type="text" pattern="^(?=^.{3,}$)(?=.*[a-z])(?!.*\s).*$" placeholder="Troop Password" required >
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
							<input class="form-control" id="Council" name="Council" type="text" pattern="([A-Za-z]+)( )*([A-Za-z]*)" placeholder="Council Name" hidden>
						</div>
					</div>
					<div name = "Leader" class="col-md-6"> <!--Enter Troop Leader -->
						<div class="form-group">
							<input class="form-control" id="Leader" name="Leader" type="text"  pattern="([A-Za-z]+) ([A-Za-z]+)" placeholder="Troop Leader">
						</div>
					</div>
					
					<button type="submit" class="btn btn-default pull-right">Create New User</button>
				</form>
				<div class="col-md-12">
					&nbsp
				</div>
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
					
					<button type="submit" class="btn btn-default pull-right"><span class="glyphicon glyphicon-log-in"></span> Log-In</button>
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


function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('Password');
    var pass2 = document.getElementById('CPassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
	
	
	
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
		
		$('#confirmPassword').removeClass("form-group has-error has-feedback").addClass("form-group has-success has-feedback");
        //pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
		$('#confirmPassword').removeClass("form-group").addClass("form-group has-error has-feedback");
		$('#confirmPassword').removeClass("form-group has-success has-feedback").addClass("form-group has-error has-feedback");
        //pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  


$("#TroopCheck").change(function(){
	if($(this).prop("checked")){
		$('#Council').show();
		$('#Leader').show();
		$('#Council').attr('required',true);
		$('#Leader').attr('required',true);
	}
	else
	{
		$('#Council').hide();
		$('#Leader').hide();
		$('#Council').attr('required', false)
		$('#Leader').attr('required', false)
	}
});

</script>
