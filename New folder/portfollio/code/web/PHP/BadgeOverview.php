<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<title>Badge Overview</title>
<h1> Badge Overview</h1>
<?php
	$link = mysql_connect('localhost:3306', 'root', '');
	if (!$link){
		exit("Connection unsuccessful. Check if XAMPP is running and check login information.");
	}
	
	if(!mysql_select_db("gsa")){
		exit("Database not found. Make sure XAMPP has the correct files in htdocs folder.");
	}
	
	$sql = "SELECT * FROM `badges`";
	$result = mysql_query($sql, $link);
	
	$badgeArray = array();
	$index = 0;
	while($row = mysql_fetch_assoc($result)){
		$badgeArray[$index] = $row;
		$index++;
	}
	
	usort($badgeArray, function($a, $b){return strcmp($a['Name'], $b['Name']);});
?>
<!-- This section builds the listbox to pick from-->
<p>Select a badge to display:
<form  action="BadgeOverview.php" method="post">
<select name="Badges">
	<?php
		$selected = explode("_",$_POST['Badges']);
		$baid = $selected[0];
		$badgeName = $selected[1];
		echo "<option value='".$baid."'>".$badgeName."</option>";
		
		foreach ($badgeArray as $badge) {
			echo '<option value ="'.$badge['BAID']."_".$badge['Name'].'">'.$badge['Name'].'</option>';
		} 
	?>
</select>
<input type="submit" value="Display" name="displayButton">
</form>
</p>

<!-- This section gets the data to build the display table -->
<?php
	//Gets the name of all the badge quests and their ids
	$sql1 = "SELECT `Name`,`badgehasquest`.`BAQID` FROM `badgehasquest`,`badgequests` WHERE `badgehasquest`.`BAQID`=`badgequests`.`BAQID` AND `badgehasquest`.`BAID`='".$baid."'";
	$result1 = mysql_query($sql1, $link);
	$badgequestArray = array();
	$badgerequirementsArray = array();
	
	//Queries all of the badge quests for their individual requirements
	$index = 0;
	$i = 0;
	while($row = mysql_fetch_assoc($result1)){
		$badgequestArray[$index] = $row;
		
		//Get the name of all badge requirements
		$sql2 = "SELECT `Name`,`badgerequirements`.`BARID`,`badgequesthasrequirements`.`BAQID` FROM `badgerequirements`, `badgequesthasrequirements` WHERE `badgequesthasrequirements`.`BAQID`='".$badgequestArray[$index]['BAQID']."' AND `badgequesthasrequirements`.`BARID` = `badgerequirements`.`BARID`"; 
		$result2 = mysql_query($sql2,$link);
		
		while($row = mysql_fetch_assoc($result2)){
			$badgerequirementsArray[$i] = $row;
			$i++;
		}
		$index++;
	}
	
	//Gets all of the scouts that have worked on the badge
	$sql3 = "SELECT `SID`,`BARID` FROM `scoutsdobadge` WHERE `BAID`=".$baid;
	$result3 = mysql_query($sql3, $link);
	$scoutswhodonebadgeArray = array();
	$index = 0;
	
	while($row = mysql_fetch_assoc($result3)){
		$scoutswhodonebadgeArray[$index] = $row;
		$index++;
	}
?>

<p>
	<!-- This section builds the table -->
<table>
	<?php
		echo "<tr><th>SID</th>";
		echo "<th>".$scoutswhodonebadgeArray[0]['SID']."</th>";
		for($i = 1; $i < $index; $i++){
			if($scoutswhodonebadgeArray[$i]['SID'] != $scoutswhodonebadgeArray[$i-1]['SID']){
				echo "<th>".$scoutswhodonebadgeArray[$i]['SID']."</th>";
			}
		}
		echo "</tr>";
		foreach($badgequestArray as $badgeQuest){
			echo "<tr><th><u>".$badgeQuest['BAQID']."</u></th></tr>";
			foreach($badgerequirementsArray as $badgeRequirements){
				if($badgeRequirements['BAQID'] == $badgeQuest['BAQID']){
					echo "<tr>";
					echo "<th>".$badgeRequirements['BARID']."</th>";
					foreach($scoutswhodonebadgeArray as $scouts){
						for($i = 0; $i < $scouts['SID']; $i++){
							echo "<th></th>";
						}
						if($scouts['BARID'] == $badgeRequirements['BARID']){
							echo "<th>x</th>";
						}
					}
					echo"</tr>";
				}
			}
		}
	?>
</table>
</p>

<p>
<?php
	foreach($badgequestArray as $badgeQuest){
		echo "<u>".$badgeQuest['BAQID']."-".$badgeQuest['Name']."</u><br>";
		foreach($badgerequirementsArray as $badgeRequirements){
			if($badgeRequirements['BAQID'] == $badgeQuest['BAQID']){
				echo $badgeRequirements['BARID']."-".$badgeRequirements['Name']."<br>";
			}
		}
	}
?>
</p>
<?php
	mysql_close($link);
?>
</body>
</html>