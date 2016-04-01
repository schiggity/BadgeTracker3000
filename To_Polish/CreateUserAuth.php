<?php
session_start();
include 'query.php';
include 'connect.php';
?>

<?php
	$Name = $_POST["FirstName"] . " " . $_POST["LastName"];
	$Username = $_POST["Username"];
	$Email = $_POST["Email"];
	$TroopNum = $_POST["TroopNum"];
	$Password = $_POST["Password"];
	$ConfirmPassword = $_POST["CPassword"];
	$TroopPassword = $_POST["TroopPass"];
	
	$Council = $_POST["Council"];
	$Leader = $_POST["Leader"];
	
	if(isset($_POST["TroopCheck"]))
	{
		$TroopCheck = $_POST["TroopCheck"];
	}
	else{
		$TroopCheck = 'notset';
	}
	$TroopExists = false;
	
	//echo $TroopCheck;
	//echo "Balls";
	
	global $conn;
	
	$Salt = uniqid(mt_rand(), true);
	$HashSalt = hash('sha256', $Password.$Salt);
	
	//Checking to see if the username is already in the database
	$result = $conn->query("SELECT userName FROM users WHERE userName = '$Username'");
	
	if (!$result) 
	{
		echo 'Could not run query userName: ' . mysql_error();
		exit;
	}
	
	if($row = $result->fetch_assoc()){
	$DBUsername= $row["userName"];
	
		if($DBUsername === $Username)
		{
			$_SESSION['Error'] = "The Username '" . $Username . "' is already in use";
			header('Location: CreateUser.php');
			//echo "Please " . '<a href="CreateUser.php">Try Again</a>' . "<br>";
			
		}
		
	}
	else
	{
		//Checking to see if the Email is already in the database
		$result = $conn->query("SELECT Email FROM users WHERE Email = '$Email'");
		
		if (!$result) 
		{
			echo 'Could not run query Email: ' . mysql_error();
			exit;
		}
		
		if($row = $result->fetch_assoc()){
			$DBEmail= $row["Email"];
		
			if($DBEmail === $Email)
			{
				$_SESSION['Error'] = "The Email '" . $Email . "' is already in use";
				header('Location: CreateUser.php');
				
			}
		}
		
		else
		{
			
			//Checking to see if the TroopNum is already in the database
			$result = $conn->query("SELECT TID FROM troops WHERE TID = '$TroopNum';");
			
			if (!$result) 
			{
				echo 'Could not run query Troopnum: ' . mysql_error();
				exit;
			}
			
			if($row = $result->fetch_assoc()){
				$DBTroopNum = $row["TID"];
				
				if($DBTroopNum === $TroopNum)
				{
					$TroopExists = true;
					
				}
			}
			#new troop already exists
			if($TroopCheck === 'isset' && $TroopExists)
			{
				$_SESSION['Error'] = "The Troop Num '" . $TroopNum . "' is already in use, make sure you aren't choosing to create a new troop, and enter in the troop password to access these troop records.";
				header('Location: CreateUser.php');
			}
			#new troop available
			else if ($TroopCheck === 'isset')
			{
				$sql = "INSERT INTO troops (TID, Council, Leader, password) VALUES('". $TroopNum . "','". $Council ."','". $Leader ."','". $TroopPassword . "');";
				if($result = $conn->query($sql)){	
				}
				else{
					echo $conn->error;
				}
				$order = "INSERT INTO users (userName, password, salt, Email, TID) 
				VALUES('". $Username ."','" . $HashSalt ."','" . $Salt . "','" . $Email . "','" . $TroopNum . "');";
				
				if($result = $conn->query($order)){
					$_SESSION['Error'] = "Username Created Successfully! Please log in to continue.";
					header('Location: CreateUser.php');		
				}
				else{
					echo $conn->error;
				}
			}
			#not a new troop
			else
			{
				$sql = "SELECT password from troops where TID = '". $TroopNum ."';";
				
				$result = $conn->query($sql);
				
				if($row = $result->fetch_assoc()){
					$DBTroopPass = $row["password"];
							
					if($DBTroopPass === $_POST["TroopPass"])
					{
						$order = "INSERT INTO users (userName, password, salt, Email, TID) 
						VALUES('". $Username ."','" . $HashSalt ."','" . $Salt . "','" . $Email . "','" . $TroopNum . "');";
						
						if($result = $conn->query($order)){
							$_SESSION['Error'] = "Username Created Successfully! Please log in to continue.";
							header('Location: CreateUser.php');			
						}
						else{
							echo $conn->error;
						}
					}
				}
				else{
					echo "Something went wrong please go back and try again";
				}
				
			}
			
			
			

		}


	}

?>