<?php 
include 'query.php';

$badges = getAllBadges();

foreach( getAllBadges() as $badge){
	echo $badge["BAID"] . ", " . $badge["Name"] ."<br>";
}

foreach(getRequirementsForBadge(6000) as $req){
	echo $req["BARID"] . ", " . $req["Name"] . "<br>	" . $req["Comments"] . "<br><br>";
}

foreach(getQuestsForBadge(6000) as $q){
	echo $q["BAQID"] . ", " . $q["Name"] . "<br>" . $q["Comments"] . "<br><br>";
}



$c = getScoutCountForBadge(6000);
echo $c[0] . $c[1] . $c[2];


completeReq(1,6000,600031,0);

?>