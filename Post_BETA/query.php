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
	$started = 0;
	$NumAward = 0;
	$QuestsCompleted = array();
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdobadge WHERE baid = " . $baid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	$Compsql  = "SELECT COUNT(DISTINCT baqid) as completed FROM scoutsdobadge JOIN badgequesthasrequirements ON scoutsdobadge.barid = badgequesthasrequirements.barid WHERE baid = " . $baid . "  AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(baqid) as questsNeeded FROM badgehasquest WHERE baid = " . $baid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedbadge WHERE baid = " . $baid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
	#scouts who started/completed/awarded
	if($result = $conn->query($Startsql))
	{
		$started = $result->fetch_assoc()["started"];
	}
	
	#number of quests completed by each scout for badge x
	if($result = $conn->query($Compsql))
	{
		for($i = 0; $row = $result->fetch_assoc(); $i++){
			$QuestsCompleted[$i] = $row;
		}
	}
	
	#number of quests needed to complete badge x
	if($result = $conn->query($QNsql))
	{
		$QuestsNeeded = $result->fetch_assoc()["questsNeeded"];
	}
	
	#number of scouts awarded badge x
	if($result = $conn->query($Awardsql))
	{
		$NumAward = $result->fetch_assoc()["awarded"];
	}
		
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
	
	
	
	foreach($sidArr as $sid){
		$sql->bind_param('iiis',$sid,$baid,$barid,date('Y-m-d',$date));
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

function ifCompleteBR($barid,$sid){
	global $conn;
	$sql = "SELECT TheDate from scoutsdobadge where sid = ". $sid ." and barid =". $barid .";";	
	
	if($result = $conn->query($sql)){
		$row = $result->fetch_assoc();		
		return $row["TheDate"];
	}
	else{
		return " ";
	}
		
}


#endregion

#region---------------------------JOURNEYS-----------------------------------

function ifCompleteJR($rid,$sid){
	global $conn;
	$sql = "SELECT TheDate from scoutsdojourney where sid = ". $sid ." and rid =". $rid .";";	
	
	if($result = $conn->query($sql)){
		$row = $result->fetch_assoc();		
		return $row["TheDate"];
	}
	else{
		return " ";
	}
	
	
}



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
	$QuestsCompleted = array();
	$started = 0;
	$NumComp = 0;
	$NumAward = 0;
	
	
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdojourney WHERE qid = " . $qid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	$Compsql  = "SELECT COUNT(DISTINCT scoutsdojourney.rid) as completed FROM scoutsdojourney JOIN questshasquestrequirements ON scoutsdojourney.rid = questshasquestrequirements.rid WHERE scoutsdojourney.qid =". $qid ." AND scoutsdojourney.sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(rid) as reqsNeeded FROM questshasquestrequirements WHERE qid = " . $qid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedquests WHERE qid = ". $qid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
	#scouts who started/completed/awarded
	if($result = $conn->query($Startsql)){
		$started = $result->fetch_assoc()["started"];
	}
	#number of quests completed by each scout for journey x
	if($result = $conn->query($Compsql)){
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$QuestsCompleted[$i] = $row;
	}
	}
	
	#number of reqs needed to complete quest x
	if($result = $conn->query($QNsql)){
		$QuestsNeeded = $result->fetch_assoc()["reqsNeeded"];
	}
	#number of scouts awarded quest x
	if($result = $conn->query($Awardsql)){
		$NumAward = $result->fetch_assoc()["awarded"];
	}
	#comparing number of reqs complete by each scout to reqs needed for quest x
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

#takes an array of scouts to be updated, prepares the statement and executes the insert for each scout
#--this is more efficient than the above function on the DB side.
function largeJourneyUpdate($sidArr, $qid,$rid,$date){
	global $conn;
	
	if($date == 0){
		$date = time();
	}
	
	$sql = $conn->prepare("INSERT INTO scoutsdojourney VALUES(?,?,?,?);");
	
	$sql->bind_param("ssss",$sid,$qid,$rid,date("Y-m-d",$date));
	
	foreach($sidArr as $sid){
		$sql->execute();
	}

}
function getJourneyByScoutByRank($sid,$rank){
	
	global $conn;
	
	$r = determineRank($rank);
	
	//echo $r;
	$arr = array();
	$sql = "SELECT * FROM journey where JID IN(select JID from journeyhasquests where QID IN(select QID from ScoutsDoJourney JOIN scouts ON scoutsdojourney.sid = scouts.sid where scoutsdojourney.sid = ". $sid ." AND scouts.sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . "))) AND JID LIKE '". $r ."';";
	
	//echo $sql;
	$result = $conn->query($sql);
	if ($result)
	{
		//echo "in first";
		if ($result->num_rows > 0)
		{
			{
				//echo "in if";
				for($i = 0; $row = $result->fetch_assoc(); $i++){
					//echo $row["JID"];
					$arr[$i] = $row;
				}
			return $arr;
			}
		}
		else{
			return 'null';
		}
	}else{
		return 'null';		
	}	
	
}



#endregion

#region-------------------------SCOUT RECORD---------------------------------


###
### do more on this when user auth is working these should be by troop ###
###
function getAllScouts(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM scouts WHERE sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") ORDER BY DoB;";
	
	#fill array to be returned
	if($result = $conn->query($sql))
	{
		for($i = 0; $row = $result->fetch_assoc(); $i++){
			$arr[$i] = $row;
		}
	}
	return $arr;	
}

#returns all information about the specified scout
function getScout($sid){
	global $conn;
	$sql = "SELECT * FROM scouts WHERE sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
		
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	return $row;	
}

#returns all scouts in a given rank
function getScoutsByRank($rank){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM scouts WHERE Ranks='" . $rank . "' AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") ORDER BY Name";
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
	$Done	= "SELECT COUNT(DISTINCT baqid) as completed FROM scoutsdobadge JOIN badgequesthasrequirements ON scoutsdobadge.barid = badgequesthasrequirements.barid WHERE baid = ". $baid ." AND sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
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
	$Done	= "SELECT COUNT(DISTINCT scoutsdojourney.rid) as completed FROM scoutsdojourney JOIN questshasquestrequirements ON scoutsdojourney.rid = questshasquestrequirements.rid WHERE scoutsdojourney.qid =". $qid ." AND sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
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
	$Done	= "SELECT COUNT(DISTINCT scoutsdoaward.aid) as completed FROM scoutsdoaward JOIN awardhasrequirements ON scoutsdoaward.aid = awardhasrequirements.aid WHERE scoutsdoaward.aid = ". $aid ." AND sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
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
	
	//$r = determineRank($rank);
	
	$arr = array();
	$sql = "SELECT thedate from scoutsdobadge where sid = " . $sid . " and baid = " . $baid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") order by thedate limit 1;";
	

	#fill array to be returned
	$result = $conn->query($sql);
	
	return $result->fetch_assoc()["thedate"];
	
	
}




function getJourneyDate($sid,$baid){
	global $conn;
	
	//$r = determineRank($rank);
	
	$arr = array();
	$sql = "SELECT thedate from scoutsdojourney where sid = " . $sid . " and qid = " . $baid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") order by thedate limit 1;";
	
	#fill array to be returned
	$result = $conn->query($sql);
	
	return $result->fetch_assoc()["thedate"];
	
	
}

#returns all the badges a scout has completed given the scoutID
function getBadgesByScoutByRank($sid,$rank){
	global $conn;
	
	$r = determineRank($rank);
	
	//echo $r;
	$arr = array();
	$sql = "SELECT * FROM badges where BAID IN(select BAID from ScoutsDoBadge JOIN scouts ON scoutsdobadge.sid = scouts.sid where scoutsdobadge.sid = ". $sid ." AND scouts.sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ")) AND BAID LIKE '". $r ."';";
	
	//echo $sql;
	//$i = 0;
	#fill array to be returned
	$result = $conn->query($sql);
	if ($result)
	{
		//echo "in first";
		if ($result->num_rows > 0)
		{
			{
				//echo "in if";
				for($i = 0; $row = $result->fetch_assoc(); $i++){
					//echo row["baid"];
				$arr[$i] = $row;
			}
			return $arr;
			}
		}
	}
	//return $arr;
}

#returns all the journeyQuests a scout has completed given the scoutID
function getJourneyQuestsByScoutByRank($sid,$rank){
	global $conn;
	$arr = array();
	
	$r = determineRank($rank);
	
	$sql = "select * from quests where QID in (select QID from scoutsdojourney JOIN scouts ON scouts.sid = scoutsdojourney.sid WHERE scoutsdojourney.sid = ". $sid ." AND scouts.sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ")) AND QID LIKE '". $r . "';";
	
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
	$sql = "select * from awards where AID in (select AID from scoutsdoaward JOIN scouts ON scouts.sid = scoutsdoaward.sid where scoutsdoaward.sid = ". $sid ." AND scouts.sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . "));";
	
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
	$sql = "select * from finances where FID in (select FID from scoutspayduesfinances JOIN scouts ON scouts.sid = scoutspayduesfinances.sid where scoutspayduesfinances.sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . "));";
	
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
	$sql = "select * from events where EID in (select EID from ScoutsGoToEvents JOIN scouts ON scouts.sid = scoutsGoToEvents.sid where scoutsGoToEvents.sid = ". $sid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . "));";
	
	#fill array to be returned
	$result = $conn->query($sql);
	for($i = 0; $row = $result->fetch_assoc(); $i++){
		$arr[$i] = $row;
	}
	return $arr;
	
}

function getHealthRecords($sid){
	global $conn;
	$arr = array();
	
	$sql = "select * from emergencyinfo where SID = ". $sid .";";
	
	if($result = $conn->query($sql)){
		$row = $result->fetch_assoc();
		
		$P = explode("*", row["PrimaryCont"]);
		$arr["Pname"] = $P[0];
		$arr["Pphone"] = $P[1];
		$arr["Prel"] = $P[2];
		
		$S = explode("*", row["SecondaryCont"]);
		$arr["Sname"] = $S[0];
		$arr["Sphone"] = $S[1];
		$arr["Srel"] = $S[2];
		
		$arr["Allergies"] = explode("*", row["Allergies"]);
		
		$arr["Illness"] = explode("*", row["illness"]);
		
		$arr["Other"] = explode("*",row["Other"]);
		
		$arr["Notes"] = $row["notes"];
		
		return $arr;
		
	}
	else{
		return 'err';
	}	
}

function updateHealthRecords($sid,$P,$S,$A,$I,$O,$N){
	global $conn;
	
	$sql = "update emergencyinfo SET PrimaryCont=". $P .", SecondaryCont=". $S .", Allergies=". $A .", illness=". $I .", Other=". $O .", Notes=". $N . " WHERE SID =". $sid .";";
	
	if($result = $conn->query($sql)){
		return;
	}
}

function insertHealthRecords($sid){
	global $conn;
	$sql = "INSERT INTO emergencyinfo VALUES(". $sid .",' * * ',' * * ',' * * * * * * * * * * * ',' * * * * * * * * * * * ',' * * * * * * * * * * * ',' ');";
	
	if($result = $conn->query($sql)){
		return;
	}
	
}





#endregion

#region---------------------------MY TROOP--------------------------------------

function getAllFinance(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM finances WHERE fid IN (SELECT fid FROM troopshavefinances WHERE tid = " . $_SESSION['tid'] . ") ORDER BY thedate;";
	
	#fill array to be returned
	if($result = $conn->query($sql))
	{
		for($i = 0; $row = $result->fetch_assoc(); $i++){
			$arr[$i] = $row;
		}
	}
	return $arr;	
}

function getAllEvents(){
	global $conn;
	$arr = array();
	$sql = "SELECT * FROM events WHERE eid IN (SELECT eid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") ORDER BY thedate;";
	
	#fill array to be returned
	if($result = $conn->query($sql))
	{
		for($i = 0; $row = $result->fetch_assoc(); $i++){
			$arr[$i] = $row;
		}
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
	$started = 0;
	$NumAward = 0;
	$QuestsCompleted = array();
	
	$Startsql = "SELECT COUNT(DISTINCT sid) as started FROM scoutsdoaward WHERE aid = " . $aid . " AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	$Compsql  = "SELECT COUNT(DISTINCT scoutsdoaward.aid) as completed FROM scoutsdoaward JOIN awardhasrequirements ON scoutsdoaward.aid = awardhasrequirements.aid WHERE scoutsdoaward.aid =". $aid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ") GROUP BY sid;";	
	$QNsql	  = "SELECT COUNT(arid) as questsNeeded FROM awardhasrequirements WHERE aid = " . $aid . ";";
	$Awardsql = "SELECT COUNT(sid) as awarded FROM scoutsawardedawards WHERE aid = ". $aid ." AND sid IN (SELECT sid FROM scoutsintroop WHERE tid = " . $_SESSION['tid'] . ");";
	
	#scouts who started/completed/awarded
	if($result = $conn->query($Startsql))
	{
		$started = $result->fetch_assoc()["started"];
	}
	#number of quests completed by each scout for journey x
	if($result = $conn->query($Compsql))
	{
		for($i = 0; $row = $result->fetch_assoc(); $i++){
			$QuestsCompleted[$i] = $row;
		}
	}
	
	#number of quests needed to complete journey x
	if($result = $conn->query($QNsql))
	{
		$QuestsNeeded = $result->fetch_assoc()["questsNeeded"];
	}
	
	#number of scouts awarded journey x
	if($result = $conn->query($Awardsql))
	{
		$NumAward = $result->fetch_assoc()["awarded"];
	}	
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

function getLastFID($type)
{
	global $conn;
	
	$sql = "SELECT fid from finances where fid LIKE '" . $type . "' ORDER BY fid DESC LIMIT 1;";
	
	if($result = $conn->query($sql))
	{
		$row = $result->fetch_assoc();
		return $row["fid"];
	}
	else{
		return $type[0] . "0000";
	}
	
	
}

function insertEventFinance($eid, $fid)
{
	global $conn;
}

function insertFinance($fid, $amount)
{
	global $conn;
	
	$sql = "INSERT into finances VALUES(" . $fid. "," . $amount . ");"; 
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
	
	$sql = "INSERT into troophavefinances VALUES(" . $fid. "," . $_SESSION['tid'] . ");";
 
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
}

#endregion

#region--------------------------Add / Edit--------------------------------------- 

function addScout($sid, $name, $dob, $address, $phoneNum, $backupPhoneNum, $email, $parents, $grade, $rank){
	global $conn;
	$sql = "INSERT INTO scouts VALUES(". $sid . ",'" . $name . "','" . $dob . "','" . $address . "','" . $phoneNum . "','" . $backupPhoneNum . "','" . $email . "','" . $parents . "','" . $grade . "','" . $rank . "');";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
	
	$sql = "INSERT INTO scoutsintroop VALUES(". $sid . ",'" . $_SESSION['tid'] . "');";
	
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
	
}

function editScout($sid, $name, $dob, $address, $phoneNum, $backupPhoneNum, $email, $parents, $grade, $rank, $oldsid){
	global $conn;
	
	$conn->query('SET foreign_key_checks = 0');
	
	$sql = "UPDATE scouts SET SID =" . $sid . ", Name ='" . $name . "', DoB ='" . $dob . "', address ='" . $address . "',PhoneNumber ='" . $phoneNum . "', BackupPhone ='" . $backupPhoneNum . "', email ='" . $email . "', Parents ='" . $parents . "',Grade ='" . $grade . "',Ranks ='" . $rank ."' WHERE sid =" . $oldsid . ";";
	if($result = $conn->query($sql)){
		echo 'inserted';		
	}
	else{
		echo $conn->error;
	}
	
	if($sid != $oldsid)
	{
		$sql = "UPDATE scoutsawardedawards SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsawardedbadge SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsawardedbridging SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsawardedquests SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsdoaward SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsdobadge SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsdobridge SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsdojourney SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsgotoevents SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutshasemergencyinfo SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutsintroop SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
		
		$sql = "UPDATE scoutspayduesfinances SET SID =" . $sid . " WHERE SID = " . $oldsid . ";";
		
		if($result = $conn->query($sql)){
			echo 'inserted';		
		}
		else{
			echo $conn->error;
		}
	}
	
	$conn->query('SET foreign_key_checks = 1');
}

#endregion
?>


