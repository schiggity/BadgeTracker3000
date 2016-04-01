<?php

include('query.php');

session_start();



if(isset($_POST["submit"])=="Edit Finance")

{
	echo '<h1>Success scout has been input</h1>';
	
	$FID = $_POST['fid'];
	$Amount = $_POST['Amount'];
	$Purpose = $_POST['Purpose'];
	
	
	
	
	
	echo '$FID: ' . $FID;
	echo '<p> </p>';
	echo '$Amount: ' . $Amount;
	echo '<p> </p>';
	echo '$Purpose: ' . $Purpose;
	echo '<p> </p>';
	
	
	if (isset($_POST['FullPay'])){
	Pay($_POST['fid'], $_POST['FullPay']);
	UpdateFin($FID, $Amount, $Purpose);
	}
	
	else
	{
	UpdateFin($FID, $Amount, $Purpose);
	}


header('location: financial.php');
}
?>