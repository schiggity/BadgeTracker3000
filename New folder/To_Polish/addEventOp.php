<?php

include('query.php');

session_start();

if(isset($_POST["submit"])=="Add Event")
{
	echo '<h1>Success scout has been input</h1>';
	
	$startDate = createStartDate($_POST['startDay'], $_POST['startMonth'], $_POST['startYear']);
	$endDate = createEndDate($_POST['endDay'], $_POST['endMonth'], $_POST['endYear']);
	
	$EID = (int)getlastEID() + 2;
	$sidarr = $_POST['names'];
	$title = $_POST['Title'];
	$desc = $_POST['Description'];
	$FID = getlastFID('1%') + 1;
	$Amount = $_POST['Amount'];
	$Purpose = $_POST['Purpose'];
	
	
	var_dump($sidarr);
	
	//echo 'lastEID: ' . (int)getlastEID();
	echo '$EID: ' . $EID;
	echo '$title: ' . $title;
	echo '$desc: ' . $desc;
	echo '$startDate: ' . $startDate;
	echo '$endDate: ' . $endDate;
	echo '$FID: ' . $FID;
	echo '$Amount: ' . $Amount;
	echo '$Purpose: ' . $Purpose;
	
	insertEvent($EID, $sidarr, $title, $desc, $startDate, $endDate, $FID, $Amount, $Purpose);

	header('location: Event.php');
}

function createStartDate($startDay, $startMonth, $startYear)
{
	$time = strtotime('"' . $startMonth . '/' . $startDay . '/' . $startYear . '"');
	$newformat = date('Y-m-d', $time);
	return $newformat;
}

function createEndDate($endDay, $endMonth, $endYear)
{
	$time = strtotime('"' . $endMonth . '/' . $endDay . '/' . $endYear . '"');
	$newformat = date('Y-m-d', $time);
	return $newformat;
}
?>