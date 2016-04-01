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
	
	if (isset($_POST["NoID"]))
	{
		$ScoutID = rand(1, 9999);
	}
	
	if (isset($_POST["Parent1"]) && isset($_POST["Parent2"]))
	{
		$Parents = $Parent1 . " & " . $Parent2;
	}
	
	else
	{
		$Parents = $Parent1;
	}
	
	
	//echo '$Name: ' . $Name;
	//echo '<p> </p>';
	//echo '$DOB: ' . $DOB;
	//echo '<p> </p>';
	//echo '$PhoneNumber: ' . $PhoneNumber;
	//echo '<p> </p>';
	//echo '$BackupPhoneNumber: ' . $BackupPhoneNumber;
	//echo '<p> </p>';
	//echo '$Parents: ' . $Parents;
	//echo '<p> </p>';
	//echo '$ScoutID: ' . $ScoutID;
	//echo '<p> </p>';
	//echo '$Address: ' . $Address;
	//echo '<p> </p>';
	//echo '$Email: ' . $Email;
	//echo '<p> </p>';
	//echo '$Grade: ' . $Grade;
	//echo '<p> </p>';
	//echo '$Rank: ' . $Rank;
	//echo '<p> </p>';
	
	addScout($ScoutID, $Name, $DOB, $Address, $PhoneNumber, $BackupPhoneNumber, $Email, $Parents, $Grade, $Rank);
	$_SESSION['AddedScout'] = 1;
	header('Location: AddScout.php');
}

else{
	echo "Not Working";
}
