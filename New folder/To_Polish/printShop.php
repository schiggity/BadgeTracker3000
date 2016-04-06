<?php 
session_start();
include 'query.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Change Page Tiltle Here -->
	<title>Print Shopping List</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="all">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="PrintCSS.css" media="all">
</head>
<body style="width: 1200px !important;">

<script>window.print()</script>

<div class="row">
	<div class="col-xs-12">
		<h3>Badges</h3>
		
		<div class="col-xs-3">
			<p><b>Badges Needed</b></p>
		</div>
		
		<div class="col-xs-9">
			<p><b>Quantity Needed</b></p>
		</div>
		
		<?php
			$badges = getAllBadges();
			foreach($badges as $badge){
				
				$array = getScoutCountForBadge($badge["BAID"]);
				
				if($array[1] > 0){
					
		?>
		
		<?php
			if($scouts = getEarnedByBadge($badge["BAID"]))
			{
				$s = 0;
				foreach($scouts as $scout){
				$s++;
				}
			}
		?>
		
		<div class="col-xs-3">
			<p> <?php echo $badge["Name"]; ?></p>
		</div>
		
		<div class="col-xs-9">
			<p> <?php echo $s; ?></p>
		</div>
		
		
		
		
		
			<?php } } ?>
	</div>
</div>



<div class="row">
	<div class="col-xs-12">
	
		<h3>Journeys</h3>
		
		<div class="col-xs-3">
			<p><b>Journey Badges Needed</b></p>
		</div>
		
		<div class="col-xs-9" >
			<p><b>Quantity Needed</b></p>
		</div>

		
		
		<?php
			$journeys = getAllJourneys();
			foreach($journeys as $j){
				$quests = getQuestsForJourney($j["JID"]);
				foreach($quests as $q){
				
				$array = getScoutCountForJourneyQuest($q["QID"]);
				
				if($array[1] > 0){
					
		?>
		
		<?php
			if($scouts = getEarnedByJourneyQuest($q["QID"]))
			{
				$s = 0;
				foreach($scouts as $scout){
					$s++;
				}
			}
		?>
		
		
		<div class="col-xs-3">
			<p> <?php echo $q["Name"]; ?></p>
		</div>
		
		<div class="col-xs-9">
			<p> <?php echo $s; ?></p>
		</div>
			<?php } } }?>
	</div>
</div>


<div class="row">
	<div class="col-xs-12">
		<h3>Awards</h3>
		
		<div class="col-xs-3">
			<p><b>Award Badges Needed</b></p>
		</div>
		
		<div class="col-xs-9">
			<p><b>Quantity Needed</b></p>
		</div>

		
		<?php
			$awards = getAllAwards();
			foreach($awards as $a){
				
				$array = getAwardScoutCount($a["AID"]);
				//var_dump($array);
				if($array[1] > 0){
					
		?>
		
		<?php
			if($scouts = getEarnedByAward($a["AID"]))
			{
				$s = 0;
				foreach($scouts as $scout){
				$s++;
				}
			}
		?>
		
		<div class="col-xs-3">
			<p> <?php echo $a["Name"]; ?></p>
		</div>
		
		<div class="col-xs-9">
			<p> <?php echo $s; ?></p>
		</div>
		
		
		
		
		
			<?php } } ?>
	</div>
</div>


<div class="row">
	<div class="col-xs-12">
		<h3>Bridges</h3>
		
		<div class="col-xs-3">
			<p><b>Bridge Badges Needed</b></p>
		</div>
		
		<div class="col-xs-9">
			<p><b>Quantity Needed</b></p>
		</div>
		
		<?php
			$bridges = getAllBridges();
			foreach($bridges as $b){
				
				$array = getBridgeScoutCount($b["BID"]);
				
				if($array[1] > 0){
					
		?>
		
		
		<?php
			if($scouts = getEarnedByBridge($b["BID"]))
			{
				$s = 0;
				foreach($scouts as $scout){
				$s++;
				}
			}
		?>
		
		<div class="col-xs-3">
			<p> <?php echo $b["Name"]; ?></p>
		</div>
		
		<div class="col-xs-9">
			<p> <?php echo $s; ?></p>
		</div>
		
		
		
		
			<?php } } ?>
	</div>
</div>

<script>
	window.location.href="MyTroop.php#Tab8";
</script>

	</body>
	
</html>	