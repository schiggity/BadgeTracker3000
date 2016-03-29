<?php

include('query.php');

session_start();
$_SESSION['tid'] = '2';


if(isset($_POST["submit"])=="Add Scout")

{
	echo '<h1>Success scout has been input</h1>';
	
	$FinanceType = $_POST['FinanceType'];
	$FID = getlastFID($_POST['FinanceType']) + 1;
	$sidArr = $_POST['names'];
	$Amount = $_POST['Amount'];
	
	
	
	
	echo '$FinanceType: ' . $FinanceType;
	echo '<p> </p>';
	echo '$Amount ' . $Amount;
	echo '<p> </p>';
	
	
	
InsertFinance($FID, $Amount, $sidArr);
}