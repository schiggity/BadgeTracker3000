<?php 
#this file creates the connection object: $conn
include 'connect.php';

#returns array of BAID and Name of every badge
function getAllBadges(){
	global $conn;
	$badgeArr = array();
	$sql = "SELECT * FROM `badges`"
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$badgeArr[i] = $row;
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
		$reqs[i] = $row;
	}
	
	return $reqs	
}

#returns array of BAQID, Name and Comments of all Quests for badge x
function getQuestsForBadge($baid){
	global $conn;
	$reqs = array();
	$sql = "select * from badgequests where baqid in (select baqid from badgehasquest where baid =" . $baid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[i] = $row;
	}
	
	return $reqs	
}

#returns array of the Number of scouts: started, completed, and awarded for badge x
function getScoutCountForBadge($baid){
	global $conn;
	$NumComp = 0;
	$QuestsCompleted = array();
	$Startsql = "SELECT COUNT(DISTINCT sid) FROM badges WHERE BAID = " . $baid . ";";
	$Compsql  = "SELECT COUNT(DISTINCT baqid) FROM scoutsdobadge JOIN badgequesthasrequirements ON scoutsdobadge.barid = badgequesthasrequirements.barid WHERE baid = " . $baid . " GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(baqid) FROM badgehasquest WHERE baid = " . $baid . ";";
	$Awardsql = "SELECT COUNT(sid) FROM scoutsawardedbadge WHERE baid = " . $baid . ";";
	
	
	#scouts who started/completed/awarded
	$result = $conn->query($Startsql);
	$started = $result->fetchassoc();
	
	#number of quests completed by each scout for badge x
	$result = $conn->query($Compsql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$QuestsCompleted[i] = $row;
	}
	
	#number of quests needed to complete badge x
	$result = $conn->query($QNsql);
	$QuestsNeeded = $result->fetchassoc();
	
	#number of scouts awarded badge x
	$result = $conn->query($Awardsql);
	$NumAward = $result->fetchassoc();
		
	#comparing number of quests complete by each scout to quests needed for badge x
	foreach ($QuestsCompleted as $quests){
		if($quests == QuestsNeeded){
			$NumComp++;
		}		
	}
	
	#subtract scouts that have finished it
	$started -= ($NumComp + $NumAward);
	
	#subtract scouts awarded from completed
	$NumComp -= $NumAward;
	
	return array($started,$NumComp,$NumAward);	
}







?>