<?php 
#this file creates the connection object: $conn
include 'connect.php';

function determineRank($rank){
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
			$r = '40%';
			break;
		case "Cadette":
		case "cadette":
		case "c":
			$r = '30%';
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
	return $r;
}
	
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
#returns array of BARID, Name, and comments of all requirements given questID
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
#--if the date provided is 0 the function will default to current time
function completeBadgeReq($sid, $baid, $barid, $date){
	global $conn;
	if($date == 0){
		$date = time();
	}
	$sql = "INSERT INTO scoutsdobadge VALUES(". $sid . "," . $baid . "," . $barid . "," . date("Y-m-d", $date) . ");";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
}

#takes an array of scouts to be updated, prepares the statement and executes the insert for each scout
#--this is more efficient than the above function on the DB side.
function largeBadgeUpdate($sidArr, $baid,$barid,$date){
	global $conn;
	
	if($date == 0){
		$date = time();
	}
	
	$sql = $conn->prepare("INSERT INTO scoutsdobadge VALUES(?,?,?,?);");
	
	$sql->bind_param("ssss",$sid,$baid,$barid,date("Y-m-d",$date));
	
	foreach($sidArr as $sid){
		$sql->execute();
	}

}

#returns the Badges for a certian rank given a rank string like 'Daisy' for example
function getBadgesByRank($rank){
	
	$r = determineRank($rank);
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

#returns the JID and name of every journey
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

#returns the requirements for a journey given the Journey ID
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

#returns the Requirements for a journey given the journey Quest ID
function getRequirementsForJourneyQuest($qid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from questRequirements where RID IN (select Rid from QuestsHasQuestRequirements where qid = " . $qid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;	
}

#returns the Quests for a journey given the JID
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

#returns array of the Number of scouts: started, completed, and awarded for a Journey
function getScoutCountForJourneyQuest($qid){
	global $conn;
	$NumComp = 0;
	$QuestsCompleted = array();
	
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdojourney WHERE qid = " . $qid . ";";
	$Compsql  = "SELECT COUNT(DISTINCT scoutsdojourney.rid) as completed FROM scoutsdojourney JOIN questshasquestrequirements ON scoutsdojourney.rid = questshasquestrequirements.rid WHERE scoutsdojourney.qid =". $qid ." GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(qid) as questsNeeded FROM questshasquestrequirements WHERE qid = " . $qid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedquests WHERE qid = ". $qid .";";
	
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

#inserts that a scout has completed a journey requirement.
#--if date passed is 0 the date will be the current date
function completeJourneyReq($sid, $jid, $rid, $date){
	global $conn;
	if($date == 0){
		$date = time();
	}
	$sql = "INSERT INTO scoutsdojourney VALUES(". $sid . "," . $baid . "," . $barid . "," . date("Y-m-d",$date) . ");";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}	
}

#returns all the journey available to a particular rank given the ranke string "brownie" or "b" for example
function getJourneysByRank($rank){
	
	$r = determineRank($rank);
	
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

#region-------------------------SCOUT RECORD---------------------------------


###
### do more on this when user auth is working these should be by troop ###
###
function getAllScouts(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM scouts ORDER BY DoB;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;	
}

#returns all information about the specified scout
function getScout($sid){
	global $conn;
	$sql = "SELECT * FROM scouts WHERE sid = ". $sid .";";
		
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	return $row;	
}

#returns all scouts in a given rank
function getScoutsByRank($rank){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM scouts WHERE Ranks='" . $rank . "' ORDER BY Name";
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
}


#returns the badge status for the specified scout
#complete 1
#started 0
#neither -1
function badgeStatus($sid,$baid){
	global $conn;
	$Needed = "SELECT COUNT(baqid) as questsNeeded FROM badgehasquest WHERE baid = " . $baid . ";";
	$Done	= "SELECT COUNT(DISTINCT baqid) as completed FROM scoutsdobadge JOIN badgequesthasrequirements ON scoutsdobadge.barid = badgequesthasrequirements.barid WHERE baid = ". $baid ." AND sid = ". $sid .";";
	
	$result = $conn->query($Needed);
	$N = $result->fetch_assoc()["questsNeeded"];
	
	$result = $conn->query($Done);
	$D = $result->fetch_assoc()["completed"];
	
	#f complete return 1
	if($N == $D){
		return 1;
	}
	#f started return 0
	else if ($D > 0){
		return 0;
	}
	#not started or finished return -1
	else{
		return -1;
	}
}

#returns the Journey Quest status for the specified scout
#complete 1
#started 0
#neither -1
function journeyQuestStatus($sid,$qid){
	global $conn;
	$Needed = "SELECT COUNT(qid) as questsNeeded FROM questshasquestrequirements WHERE qid = " . $qid . ";";
	$Done	= "SELECT COUNT(DISTINCT scoutsdojourney.rid) as completed FROM scoutsdojourney JOIN questshasquestrequirements ON scoutsdojourney.rid = questshasquestrequirements.rid WHERE scoutsdojourney.qid =". $qid ." AND sid = ". $sid .";";
	
	$result = $conn->query($Needed);
	$N = $result->fetch_assoc()["questsNeeded"];
	
	$result = $conn->query($Done);
	$D = $result->fetch_assoc()["completed"];
	
	#f complete return 1
	if($N == $D){
		return 1;
	}
	#f started return 0
	else if ($D > 0){
		return 0;
	}
	#not started or finished return -1
	
	else{
		return -1;
	}
}

#returns the award status for the specified scout
#complete 1
#started 0
#neither -1
function awardStatus($sid,$aid){
	global $conn;
	$Needed = "SELECT COUNT(arid) as requirementsNeeded FROM awardhasrequirements WHERE aid = " . $aid . ";";
	$Done	= "SELECT COUNT(DISTINCT scoutsdoaward.aid) as completed FROM scoutsdoaward JOIN awardhasrequirements ON scoutsdoaward.aid = awardhasrequirements.aid WHERE scoutsdoaward.aid = ". $aid ." AND sid = ". $sid .";";
	
	$result = $conn->query($Needed);
	$N = $result->fetch_assoc()["questsNeeded"];
	
	$result = $conn->query($Done);
	$D = $result->fetch_assoc()["completed"];
	
	#f complete return 1
	if($N == $D){
		return 1;
	}
	#f started return 0
	else if ($D > 0){
		return 0;
	}
	#not started or finished return -1
	else{
		return -1;
	}
}

function getBadgeDate($sid,$baid){
	global $conn;
	
	$r = determineRank($rank);
	
	$arr = array();
	$sql = "SELECT thedate from scoutsdobadge where sid = " . $sid . " and baid =" . $baid . "order by thedate limit 1;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	
	return $result->fetch_assoc()["thedate"];
	
	
}

function getJourneyDate($sid,$baid){
	global $conn;
	
	$r = determineRank($rank);
	
	$arr = array();
	$sql = "SELECT thedate from scoutsdojourney where sid = " . $sid . " and qid =" . $baid . "order by thedate limit 1;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	
	return $result->fetch_assoc()["thedate"];
	
	
}

#returns all the badges a scout has completed given the scoutID
function getBadgesByScoutByRank($sid,$rank){
	global $conn;
	
	$r = determineRank($rank);
	
	$arr = array();
	$sql = "SELECT * FROM badges where BAID IN(select BAID from ScoutsDoBadge JOIN scouts ON scoutsdobadge.sid = scouts.sid where scoutsdobadge.sid = ". $sid .") AND BAID LIKE ". $r .";";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
	
}

#returns all the journeyQuests a scout has completed given the scoutID
function getJourneyQuestsByScoutByRank($sid,$Rank){
	global $conn;
	$arr = array();
	
	$r = determineRank($rank);
	
	$sql = "select * from quests where QID in (select QID from scoutsdojourney JOIN scouts ON scouts.sid = scoutsdojourney.sid WHERE scoutsdojourney.sid = ". $sid .") AND QID LIKE ". $r . ";";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;	
}



#returns all the awards a scout has completed given the scoutID
function getAwardsByScout($sid){
	global $conn;
	$arr = array();
	$sql = "select * from awards where AID in (select AID from scoutsdoaward JOIN scouts ON scouts.sid = scoutsdoaward.sid where scoutsdoaward.sid = ". $sid .");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
	
}

#returns all the bridges a scout has completed given the scoutID
function getBridgesByScout($sid){

}

#returns all the financial records a scout is tied to given scoutID
function getFinancesByScout($sid){
	global $conn;
	$arr = array();
	$sql = "select * from finances where FID in (select FID from scoutspayduesfinances JOIN scouts ON scouts.sid = scoutspayduesfinances.sid where scoutspayduesfinances.sid = ". $sid .");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
	
}

#returns all the events a scout has gone to given scoutID
function getEventsByScout($sid){
		global $conn;
	$arr = array();
	$sql = "select * from events where EID in (select EID from ScoutsGoToEvents JOIN scouts ON scouts.sid = scoutsGoToEvents.sid where scoutsGoToEvents.sid = ". $sid .");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
	
}
#endregion

#region---------------------------MY TROOP--------------------------------------

function getAllFinance(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM finances ORDER BY thedate;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;	
}

function getAllEvents(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM events ORDER BY thedate;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
}
#endregion

#region--------------------------AWARDS-----------------------------------------

#returns AID(Award ID),Name of every award
function getAllAwards(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM awards ORDER BY AID;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;	
	
	
}

#returns the requirements for the given awardID
function getAwardRequirements($aid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from awardrequirements where ARID IN(select ARID from awardhasrequirements join awards on awardhasrequirements.aid = awards.aid where aid = ". $aid .");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;	
}


#returns array of the Number of scouts: started, completed, and awarded for an Award
function getAwardScoutCount($aid){
	global $conn;
	$NumComp = 0;
	$QuestsCompleted = array();
	
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdoaward WHERE aid = " . $aid . ";";
	$Compsql  = "SELECT COUNT(DISTINCT scoutsdoaward.aid) as completed FROM scoutsdoaward JOIN awardhasrequirements ON scoutsdoaward.aid = awardhasrequirements.aid WHERE scoutsdoaward.aid =". $aid ." GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(arid) as questsNeeded FROM awardhasrequirements WHERE aid = " . $aid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedawards WHERE aid = ". $aid .";";
	
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

#endregion

#region-------------------------BRIDGING----------------------------------------

#returns the BID and Name for every bridge
function getAllBridges(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM awards ORDER BY BID;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
}

#returns the requirements for a bridgeQuest given the BridgeQuestID
function getBridgeRequirementsByQuest($bqid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from BridgeRequirements where BRID IN (select BRID from BridgeQuestsHasBridgeRequirements where bqid = " . $bqid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;
}

##returns the BridgeQuests given the BridgeID
function getBridgeQuests($bid){
	global $conn;
	$reqs = array();
	$sql = "SELECT * from BridgeQuests where BQID IN (select BQID from BridgingHasBridgeQuest where bid = " . $bid . ");";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$reqs[$i] = $row;
	}
	
	return $reqs;
}

#returns array of the Number of scouts: started, completed, and awarded for a Bridge
function getBridgeScoutCount($bid){
	
	
	
}

#endregion

#region--------------------------FINANCES--------------------------------------- 

#endregion

#region--------------------------FINANCES--------------------------------------- 

function addScout($sid, $name, $dob, $address, $phoneNum, $backupPhoneNum, $email, $parents, $grade, $rank){
	global $conn;
	$sql = "INSERT INTO scouts VALUES(". $sid . "," . $name . "," . $dob . "," . $address . "," . $phoneNum . "," . $backupPhoneNum . "," . $email . "," . $parents . "," . $grade . "," . $rank . ");";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
}

#endregion
?>