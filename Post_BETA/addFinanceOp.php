<?php

include('query.php');

session_start();



if(isset($_POST["submit"])=="Add Finance")

{
	echo '<h1>Success scout has been input</h1>';
	
	$FinanceType = $_POST['FinanceType'];
	$FID = getlastFID($_POST['FinanceType']) + 1;
	$sidArr = $_POST['names'];
	$Amount = $_POST['Amount'];
	$Purpose = $_POST['Purpose'];
	
	
	var_dump($sidArr);
	
	echo '$FinanceType: ' . $FinanceType;
	echo '$FinanceType: ' . $FID;
	echo '<p> </p>';
	echo '$Amount ' . $Amount;
	echo '<p> </p>';
	
	
	
InsertFinance($FID, $Amount, $sidArr, $Purpose);

header('location: Financial.php');
}
?>