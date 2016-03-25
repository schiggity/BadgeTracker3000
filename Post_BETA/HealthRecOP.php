<?php
session_start();
include 'query.php';

$sid = $_POST["sid"];
$P = $_POST['PrimaryName'] . "*" . $_POST['PrimaryNum'] . "*" . $_POST['PrimaryRel'];
$S = $_POST['SecondaryName'] . "*" . $_POST['SecondaryNum'] . "*" . $_POST['SecondaryRel'];

var_dump($S);
var_dump($P);

$A = $_POST['Allergy1'] . "*" . $_POST['Allergy2'] . "*" . $_POST['Allergy3'] . "*" . $_POST['Allergy4'] . "*" . $_POST['Allergy5'] . "*" . $_POST['Allergy6'] . "*" . $_POST['Allergy7'] . "*" . $_POST['Allergy8'] . "*" . $_POST['Allergy9'] . "*" . $_POST['Allergy10'] . "*" . $_POST['Allergy11'] . "*" . $_POST['Allergy12'];

$I = $_POST['Illness1'] . "*" . $_POST['Illness2'] . "*" . $_POST['Illness3'] . "*" . $_POST['Illness4'] . "*" . $_POST['Illness5'] . "*" . $_POST['Illness6'] . "*" . $_POST['Illness7'] . "*" . $_POST['Illness8'] . "*" . $_POST['Illness9'] . "*" . $_POST['Illness10'] . "*" . $_POST['Illness11'] . "*" . $_POST['Illness12'];

$O = $_POST['Other1'] . "*" . $_POST['Other2'] . "*" . $_POST['Other3'] . "*" . $_POST['Other4'] . "*" . $_POST['Other5'] . "*" . $_POST['Other6'] . "*" . $_POST['Other7'] . "*" . $_POST['Other8'] . "*" . $_POST['Other9'] . "*" . $_POST['Other10'] . "*" . $_POST['Other11'] . "*" . $_POST['Other12'];

$N = $_POST['Notes'];

updateHealthRecords($sid,$P,$S,$A,$I,$O,$N);

$_SESSION['editHealth'] = 1;
$_SESSION['sid'] = $sid;

header('location: ScoutRecord.php#HealthRecord');


?>