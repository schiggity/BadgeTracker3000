<?php 
include 'query.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Change Page Tiltle Here -->
<title>Journey Overview</title> 
<?php include 'bootstrap.html';?>
</head>


<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>

<body>

<?php include 'navBar.html'; ?>

<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container">
<div class="row-fluid">
<div class="col-md-12">
<h1>Journeys</h1>
<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#Tab1" data-toggle="tab">Daisies</a></li>
<li><a href="#Tab2" data-toggle="tab">Brownies</a></li>
<li><a href="#Tab3" data-toggle="tab">Juniors</a></li>
<li><a href="#Tab4" data-toggle="tab">Cadettes</a></li>
<li><a href="#Tab5" data-toggle="tab">Seniors</a></li>
<li><a href="#Tab6" data-toggle="tab">Ambassadors</a></li>
</ul>
<!----------------------------- Daisies tab and collapsing panel start ------------------------------->


<!---------------------------- Brownies tab and collapsing panel start --------------------------------->
<div class="tab-pane" id="Tab2">  
<div class="row">
<div class="col-md-12">
<h3>Brownies</h3>
<?php
$journeys = getJourneysByRank("brownie");
$scoutsInRank = getScoutsByRank("brownie");
foreach($journeys as $journey){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $journey['JID']?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post">
<p>
<?php
foreach($scoutsInRank as $scout){
echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying journey requirements-->
<div id="Modal<?php echo $journey['JID']?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $journey['Name']?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post">
<p>
<?php
foreach(getQuestsForJourney($journey["JID"]) as $jquests){
echo "<b>" . $journey["Name"] . ":</b><br>";
foreach(getRequirementsForJourneyQuest($jquests["QID"]) as $jreqs){
$Name = str_replace(array('"','\''), "", $jreqs["Name"]);
$Comments = str_replace(array('"','\''), "", $jreqs["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $jreqs['RID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo journey["JID"]?>"><?php echo $journey["Name"]; ?></a>
</h4>
</div>
<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $journey["JID"]?>">Scouts</button></td>									
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $journey["JID"]?>">Requirements</button></td>
<td align="left"> <form method="post"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>
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

<!-------------------------- Juniors tab and collapsing panel start --------------------------------->
<div class="tab-pane" id="Tab2">  
<div class="row">
<div class="col-md-12">
<h3>Juniors</h3>
<?php
$journeys = getJourneysByRank("junior");
$scoutsInRank = getScoutsByRank("junior");
foreach($journeys as $journey){
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout<?php echo $journey['JID']?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form method="post">
<p>
<?php
foreach($scoutsInRank as $scout){
echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'>" . $scout['Name'] . "<br>";
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
</div>
</div>
</div>	
</div>

<!-- Modal content displaying journey requirements-->
<div id="Modal<?php echo $journey['JID']?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $journey['Name']?></h4>
</div>
<div class="modal-body">
<div id="reqCheckboxes">
<form method="post">
<p>
<?php
foreach(getQuestsForJourney($journey["JID"]) as $jquests){
echo "<b>" . $journey["Name"] . ":</b><br>";
foreach(getRequirementsForJourneyQuest($jquests["QID"]) as $jreqs){
$Name = str_replace(array('"','\''), "", $jreqs["Name"]);
$Comments = str_replace(array('"','\''), "", $jreqs["Comments"]);
echo "<input type='checkbox' name='requirements[]' value='" . $jreqs['RID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
}
}
?>
</p>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
</div>
</div>
</div>	
</div>

<!--This is for the actual panel -->
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="<?php echo $journey["Name"]; ?>" href="#collapse<?php echo journey["JID"]; ?>"><?php echo $journey["Name"]; ?></a>
</h4>
</div>
<div id="collapse<?php echo $journey["JID"]?>" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 
<table style="width=33%">
<tbody>
<tr>
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $journey["JID"]?>">Scouts</button></td>									
<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $journey["JID"]?>">Requirements</button></td>
<td align="left"> <form method="post"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>
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

<!----------------------- Cadettes tab and collapsing panel start --------------------------------->

<!---------------------------- Seniors tab and collapsing panel start ----------------------------->

<!----------------------- Ambassadors tab and collapsing panel start ------------------------------>


</div>
</div>
</div>
</div>
</body>
</html>

