<?php
session_start();

include('query.php');

if(isset($_POST["submit"])=="Add Scout")

{
	echo '<h1>Success scout has been input</h1>';
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$ScoutID = $_POST['ScoutID'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$Address = $_POST['Address'];
	$PhoneNumAC = $_POST['PhoneNumAC'];
	$PhoneNum = $_POST['PhoneNum'];
	$BackupPhoneNumAC = $_POST['BackupPhoneNumAC'];
	$BackupPhoneNum = $_POST['BackupPhoneNum'];
	$Email = $_POST['Email'];
	$Parent1 = $_POST['Parent1'];
	$Parent2 = $_POST['Parent2'];
	$Grade = $_POST['Grade'];
	$Rank = $_POST['Rank'];
	
	$Name = $FirstName . " " . $LastName;
	$DOB = $year . "-" . $month . "-" . $day;
	$PhoneNumber = $PhoneNumAC . $PhoneNum;
	$BackupPhoneNumber = $BackupPhoneNumAC . $BackupPhoneNum;
	
	if (isset($_POST["Parent1"]) && isset($_POST["Parent2"]))
	{
		$Parents = $Parent1 . " & " . $Parent2;
	}
	
	else
	{
		$Parents = $Parent1;
	}
	
	
	
	editScout($ScoutID, $Name, $DOB, $Address, $PhoneNumber, $BackupPhoneNumber, $Email, $Parents, $Grade, $Rank, $_POST['oldsid']);
	$_SESSION['EditScout'] = 1;
	header('Location: MyTroop.php');
}

else{
	echo "Not Working";
}
