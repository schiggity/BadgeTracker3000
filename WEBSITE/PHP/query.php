<?php 
#this file creates the connection object: $conn
include 'connect.php';

#region--------------------------- BADGES -----------------------------------

#returns array of BAID and Name of every badge
function getAllBadges(){
	global $conn;
	$badgeArr = array();
	$sql = "SELECT * FROM `badges` ORDER BY Name;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$badgeArr[$i] = $row;
	}
	
	return $badgeArr;	
}

#returns array of the BARID, Name, and Comments of all requirements for badge x
function getRequirementsForBadge($baid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from badgerequirements where barid IN (select barid from badgequesthasrequirements JOIN badgehasquest ON badgequesthasrequirements.baqid = badgehasquest.baqid where baid = " . $baid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;	
}
function getRequirementsForBadgeQuest($baqid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from badgerequirements where barid IN (select barid from badgequesthasrequirements where baqid = " . $baqid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;	
}

#returns array of BAQID, Name and Comments of all Quests for badge x
function getQuestsForBadge($baid){
	global $conn;
	$reqs = array();
	$sql = "select * from badgequests where baqid in (select baqid from badgehasquest where baid =" . $baid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;	
}

#returns array of the Number of scouts: started, completed, and awarded for badge x
function getScoutCountForBadge($baid){
	global $conn;
	$NumComp = 0;
	$QuestsCompleted = array();
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdobadge WHERE baid = " . $baid . ";";
	$Compsql  = "SELECT COUNT(DISTINCT baqid) as completed FROM scoutsdobadge JOIN badgequesthasrequirements ON scoutsdobadge.barid = badgequesthasrequirements.barid WHERE baid = " . $baid . " GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(baqid) as questsNeeded FROM badgehasquest WHERE baid = " . $baid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedbadge WHERE baid = " . $baid . ";";
	
	#scouts who started/completed/awarded
	$result = $conn->query($Startsql);
	$started = $result->fetch_assoc()["started"];
	
	#number of quests completed by each scout for badge x
	$result = $conn->query($Compsql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$QuestsCompleted[$i] = $row;
	}
	
	#number of quests needed to complete badge x
	$result = $conn->query($QNsql);
	$QuestsNeeded = $result->fetch_assoc()["questsNeeded"];
	
	#number of scouts awarded badge x
	$result = $conn->query($Awardsql);
	$NumAward = $result->fetch_assoc()["awarded"];
		
	#comparing number of quests complete by each scout to quests needed for badge x
	foreach ($QuestsCompleted as $quests){
		if($quests == $QuestsNeeded){
			$NumComp++;
		}		
	}
	
	#subtract scouts that have finished it
	$started -= ($NumComp + $NumAward);
	
	#subtract scouts awarded from completed
	$NumComp -= $NumAward;
	
	return array($started,$NumComp,$NumAward);	
}

#updates the scoutsDoBadge table when a requirement has been done
#--if no date is provided the function will default to the current date
function completeBadgeReq($sid, $baid, $barid, $date){
	global $conn;
	if($date == 0){
		$date = "NOW()";
	}
	$sql = "INSERT INTO scoutsdobadge VALUES(". $sid . "," . $baid . "," . $barid . "," . $date . ");";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
}

function getBadgesByRank($rank){
	switch($rank){
		case "Daisy":
		case "daisy":
		case "d":
			$r = '10%';
			break;
		case "Brownie":
		case "brownie":
		case "b":
			$r = '20%';
			break;
		case "Junior":
		case "junior":
		case "j":
			$r = '30%';
			break;
		case "Cadette":
		case "cadette":
		case "c":
			$r = '40%';
			break;
		case "Senior":
		case "senior":
		case "s":
			$r = '50%';
			break;
		case "Ambassador":
		case "ambassador":
		case "a":
			$r = '60%';
			break;
	}
	
	global $conn;
	$badgeArr = array();
	$sql = "select * from badges where BAID like '" . $r . "' ORDER BY Name;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$badgeArr[$i] = $row;
	}	
	return $badgeArr;	
}
#endregion


#region---------------------------JOURNEYS-----------------------------------
function getAllJourneys(){
	global $conn;
	$jarr = array();
	$sql = "SELECT * FROM journey ORDER BY Name;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$jarr[$i] = $row;
	}
	
	return $jarr;
}

function getRequirementsForJourney($jid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from questrequirements where rid IN (select rid from questshasquestrequirements JOIN journeyhasquests ON questshasquestrequirements.qid = journeyhasquests.qid where jid = " . $jid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	return $reqs;
}

function getQuestsForJourney($jid){
	global $conn;
	$reqs = array();
	$sql = "select * from quests where qid in (select qid from journeyhasquests where jid =" . $jid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}	
	return $reqs;	
}

function getScoutCountForJourney($jid){
	global $conn;
	$NumComp = 0;
	$QuestsCompleted = array();
	
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdojourney WHERE jid = " . $jid . ";";
	$Compsql  = "SELECT COUNT(DISTINCT qid) as completed FROM scoutsdojourney JOIN questshasquestrequirements ON scoutsdojourney.rid = questshasquestrequirements.rid WHERE jid = " . $jid . " GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(qid) as questsNeeded FROM journeyhasquests WHERE jid = " . $jid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedquests WHERE qid IN(select qid from journeyhasquests where jid = " . $jid . ");";
	
	#scouts who started/completed/awarded
	$result = $conn->query($Startsql);
	$started = $result->fetch_assoc()["started"];
	
	#number of quests completed by each scout for journey x
	$result = $conn->query($Compsql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$QuestsCompleted[$i] = $row;
	}
	
	#number of quests needed to complete journey x
	$result = $conn->query($QNsql);
	$QuestsNeeded = $result->fetch_assoc()["questsNeeded"];
	
	#number of scouts awarded journey x
	$result = $conn->query($Awardsql);
	$NumAward = $result->fetch_assoc()["awarded"];
		
	#comparing number of quests complete by each scout to quests needed for journey x
	foreach ($QuestsCompleted as $quests){
		if($quests == $QuestsNeeded){
			$NumComp++;
		}		
	}
	
	#subtract scouts that have finished it
	$started -= ($NumComp + $NumAward);
	
	#subtract scouts awarded from completed
	$NumComp -= $NumAward;
	
	return array($started,$NumComp,$NumAward);	
	
}

function completeJourneyReq($sid, $jid, $rid, $date){
	global $conn;
	if($date == 0){
		$date = "NOW()";
	}
	$sql = "INSERT INTO scoutsdojourney VALUES(". $sid . "," . $baid . "," . $barid . "," . $date . ");";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}	
}

function getJourneysByRank($rank){
	switch($rank){
		case "Daisy":
		case "daisy":
		case "d":
			$r = '10%';
			break;
		case "Brownie":
		case "brownie":
		case "b":
			$r = '20%';
			break;
		case "Junior":
		case "junior":
		case "j":
			$r = '30%';
			break;
		case "Cadette":
		case "cadette":
		case "c":
			$r = '40%';
			break;
		case "Senior":
		case "senior":
		case "s":
			$r = '50%';
			break;
		case "Ambassador":
		case "ambassador":
		case "a":
			$r = '60%';
			break;
	}
	
	global $conn;
	$jarr = array();
	$sql = "select * from journey where jid like '" . $r . "' ORDER BY Name;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$jarr[$i] = $row;
	}	
	return $jarr;	
	
}

#endregion






?>