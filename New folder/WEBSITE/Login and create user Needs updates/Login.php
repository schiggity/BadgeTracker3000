<?php
session_start();
?>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="LoginStyle.css">
	</head>
	<body>
		<div id = "Header">
			<a href = "start.html">
		<img src = "home2.png" height = 100% width = 4% style = "float:left;" >
            </a>
            <h1>Rules of the road pre-test login</h1>
		</div>
		
		<div id = "DeadSpace">
		</div>
		
		<div id ="Middle">
		
			
			<div id = "Name_Password">
			
				<div id = "Middle_Deadspace">
				</div>
			
				<form name="Info" action="LoginAuthentication.php" method="post";>
					<table border = "1" id = "Login_Table">
						<tr>
							<td style= "text-align: center;"><h2>Login</h2></td>
						</tr>
						
						<tr>
							<td><p> Username: 
							<input type="text" name="Username" required></p></td>
						</tr>
						<tr>
							<td><p> Password:
							<input type="password" name="Password" required></p></td>
						</tr>
						<tr>
							<td><a href = "Start.html"><button type="button">Return to Homepage</button></a></td>
							<td><button type="submit">Login</button></td>
						</tr>
					<table>
				</form>
			</div>
		</div>
		
	</body>
</html>