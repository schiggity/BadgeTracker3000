<?php
session_start();
include 'query.php';
include 'connect.php';
?>

<?php
	$Username = $_POST["Username"];
	$Password = $_POST["Password"];
	
	global $conn;
	
	//Checks for username in DB & grabs salt
	$result = $conn->query("SELECT salt, password, TID FROM users WHERE userName = '$Username'");
	if($result)
	{
		$row = $result->fetch_assoc();
		$Salt = $row["salt"];
		
		$HashSalt = hash('sha256', $Password.$Salt);
		
		if($HashSalt === $row["password"]){
			$_SESSION['user'] = $Username;
			$_SESSION['TID'] = $row["TID"];
			header('Location: MyTroop.php');
		}
		else{
			$_SESSION['Error'] = "Username Password Combination Incorrect";
			header('Location: CreateUser.php');		
		}
	}
	else{
		$_SESSION['Error'] = "Username Password Combination Incorrect";
		header('Location: CreateUser.php');		
	}
	
?>