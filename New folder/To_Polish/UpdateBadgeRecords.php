<?php 
include 'query.php';
include 'bootstrap.html';

session_start();

$shown = false;
if(isset($_POST['submitform'])){
	//echo substr($_POST['requirements'][0], 0,4) . "<br>";
	if(isset($_POST['names'])){
		
		if(isset($_POST['requirements'])){
			foreach($_POST['requirements'] as $reqs){
				largeBadgeUpdate($_POST['names'],substr($_POST['requirements'][0], 0,4),$reqs,0);
				$shown = true;
			}
		}
		else{
			echo "<script>alert('No Requirements Selected for Update!');</script>";
		}
		
	}
	else{
		echo "<script>alert('No Scouts Selected for Update!');</script>";
	}
	//echo "Submitted";
}
if($shown){
	echo "<script>alert('Badges Updated Successfully!');</script>";
}


if(!isset($_SESSION['user']))
{
	$_SESSION['noLog'] = 1;
	header('location: CreateUser.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Change Page Title Here -->
<title>Badge Update</title> 
</head>

<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
$(<?php echo $_POST['Bcollapse']; ?>).collapse('show');   
});
</script>

<body>

<?php include 'navBar.php'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------>
<div class="col-md-1">
</div>
<div class="col-md-10">
<div class="row-fluid">
<div class="col-md-12">
<h1>Update Badge</h1>

<?php if(isset($_POST['BTab'])){ ?>

<ul class="nav nav-tabs" id="myTab">
<li <?php if($_POST['BTab'] == '1'){echo 'class="active"';} ?> ><a href="#Tab1" data-toggle="tab">Daisies</a></li>
<li <?php if($_POST['BTab'] == '2'){echo 'class="active"';} ?> ><a href="#Tab2" data-toggle="tab">Brownies</a></li>
<li <?php if($_POST['BTab'] == '3'){echo 'class="active"';} ?> ><a href="#Tab3" data-toggle="tab">Juniors</a></li>
<li <?php if($_POST['BTab'] == '4'){echo 'class="active"';} ?> ><a href="#Tab4" data-toggle="tab">Cadettes</a></li>
<li <?php if($_POST['BTab'] == '5'){echo 'class="active"';} ?> ><a href="#Tab5" data-toggle="tab">Seniors</a></li>
<li <?php if($_POST['BTab'] == '6'){echo 'class="active"';} ?> ><a href="#Tab6" data-toggle="tab">Ambassadors</a></li>
</ul>

<?php } else { ?>

<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#Tab1" data-toggle="tab">Daisies</a></li>
<li><a href="#Tab2" data-toggle="tab">Brownies</a></li>
<li><a href="#Tab3" data-toggle="tab">Juniors</a></li>
<li><a href="#Tab4" data-toggle="tab">Cadettes</a></li>
<li><a href="#Tab5" data-toggle="tab">Seniors</a></li>
<li><a href="#Tab6" data-toggle="tab">Ambassadors</a></li>
</ul>
<?php } ?>

<div class="tab-content my-tab">  

<!----------------------------------------- Daisies tab collapsing panel start ------------------------------------------->                    
<div class="tab-pane <?php if(isset($_POST['BTab']) && $_POST['BTab'] != '1'){echo "";}else{ echo "active";} ?>" id="Tab1">
<div class="row">
<div class="col-md-12">
<h3>Daisies</h3>
<?php
$badges = getBadgesByRank("daisy");
$scoutsInRank = getScoutsByRank("daisy");
foreach($badges as $badge){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge["BAID"]) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" class="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!----------------------------------------- Brownies tab collapsing panel start ------------------------------------------->					
<div class="tab-pane <?php if($_POST['BTab'] == '2'){echo "active";} ?>"id="Tab2">  
<div class="row">
<div class="col-md-12">
<h3>Brownies</h3>
<?php
$badges = getBadgesByRank("brownie");
$scoutsInRank = getScoutsByRank("brownie");
foreach($badges as $badge){
	
	
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge['BAID']) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!----------------------------------------- Juniors tab collapsing panel start ------------------------------------------->					
<div class="tab-pane <?php if($_POST['BTab'] == '3'){echo "active";} ?>"id="Tab3">  
<div class="row">
<div class="col-md-12">
<h3>Juniors</h3>
<?php
$badges = getBadgesByRank("junior");
$scoutsInRank = getScoutsByRank("junior");
foreach($badges as $badge){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge['BAID']) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!----------------------------------------- Cadettes tab collapsing panel start ------------------------------------------->					
<div class="tab-pane <?php if($_POST['BTab'] == '4'){echo "active";} ?>"id="Tab4">  
<div class="row">
<div class="col-md-12">
<h3>Cadettes</h3>
<?php
$badges = getBadgesByRank("cadette");
$scoutsInRank = getScoutsByRank("cadette");
foreach($badges as $badge){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge['BAID']) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!----------------------------------------- Seniors tab collapsing panel start ------------------------------------------->					
<div class="tab-pane <?php if($_POST['BTab'] == '5'){echo "active";} ?>" id="Tab5">  
<div class="row">
<div class="col-md-12">
<h3>Seniors</h3>
<?php
$badges = getBadgesByRank("senior");
$scoutsInRank = getScoutsByRank("senior");
foreach($badges as $badge){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge['BAID']) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!----------------------------------------- Ambassadors tab collapsing panel start ------------------------------------------->					
<div class="tab-pane <?php if($_POST['BTab'] == '6'){echo "active";} ?>" id="Tab6">  
<div class="row">
<div class="col-md-12">
<h3>Ambassadors</h3>
<?php
$badges = getBadgesByRank("ambassador");
$scoutsInRank = getScoutsByRank("ambassador");
foreach($badges as $badge){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach($scoutsInRank as $scout){
	$shown = false;
	if(badgeStatus($scout['SID'],$badge['BAID']) != 1){
		$shown = true;
	}
	if($shown){	
		echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
	}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#Modal<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying badge requirements-->
<div id="Modal<?php echo $badge["BAID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $badge["Name"]?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post" action = "UpdateBadgeRecords.php">
<p>
<?php
foreach(getQuestsForBadge($badge["BAID"]) as $quest){
echo "<b>" . $quest["Name"] . ":</b><br>";
foreach(getRequirementsForBadgeQuest($quest["BAQID"]) as $req){
$Name = str_replace(array('"','\''), "", $req["Name"]);
$Comments = str_replace(array('"','\''), "", $req["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $req['BARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<a href="#ModalScout<?php echo $badge["BAID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
<form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $badge["BAID"]; ?>" href="#collapse<?php echo $badge["BAID"]?>"><div class="row"><?php echo $badge["Name"]; ?></div></a>
</h4>
</div>
<div id="collapse<?php echo $badge["BAID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $badge["BAID"]?>">Update</button></td>									
<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $badge["BAID"]?>">Requirements</button></td>
<td align="left"> <form method="post" action = "UpdateBadgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>-->
</tr>

<tr>

</tr>
</tbody>
</table>

</div>
</ul>											
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<!-- END OF TABS-->

</div>
</div>
</div>
</div>
<div class="col-md-1">
</div>

</body>
</html>

