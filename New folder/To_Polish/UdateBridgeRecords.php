<?php 
include 'query.php';
include 'bootstrap.html';

session_start();

if(isset($_POST['submitform'])){
	//echo substr($_POST['requirements'][0], 0,4) . "<br>";
	
	foreach($_POST['names'] as $names){
		echo $names . "<br>";
	}
	
	foreach($_POST['requirements'] as $reqs){
		largeBridgeUpdate($_POST['names'],substr($_POST['requirements'][0], 0,4),$reqs,0);
		
	}
	
	
	echo "Submitted";
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
<title>Bridge Update</title> 
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
<div class="container">
<div class="row-fluid">
<div class="col-md-12">
<h1>Update Bridge</h1>

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
	$bridges = getAllbridges();
	$scoutsInRank = getAllScouts();
	foreach($bridges as $bridge){
	?>
	<!-- Modal content displaying Scout names-->
	<div id="ModalScout<?php echo $bridge["BID"]?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Scouts</h4>
	</div>
	<div class="modal-body">
	<div id="nameCheckboxes">
	<form method="post" action = "UpdatebridgeRecords.php">
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

	<!-- Modal content displaying badge requirements-->
	<div id="Modal<?php echo $bridge["BID"]?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"><?php echo $bridge["Name"]?></h4>
	</div>
	<div class="modal-body">
	<div id="reqCheckboxes">
	<form method="post" action = "UpdateBadgeRecords.php">
	<p>
	<?php
	
	foreach(getbridgeRequirements($bridge["BID"]) as $req){
		$Name = str_replace(array('"','\''), "", $req["Name"]);
		$Comments = str_replace(array('"','\''), "", $req["Comments"]);
		echo "<input type='checkbox' name='requirements[]' value='" . $req['ARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
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
	<a data-toggle="collapse" class="<?php echo $bridge["BID"]; ?>" href="#collapse<?php echo $bridge["BID"]?>"><div class="row"><?php echo $bridge["Name"]; ?></div></a>
	</h4>
	</div>
	<div id="collapse<?php echo $bridge["BID"]?>" class="panel-collapse collapse">
	<ul class="list-group">
	<div class="container"> 
	<table style="width=33%">
	<tbody>
	<tr>
	<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $bridge["BID"]?>">Scouts</button></td>									
	<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $bridge["BID"]?>">Requirements</button></td>
	<td align="left"> <form method="post" action = "UpdatebridgeRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-secondary btn-lg"></form></td>
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


</div>
</div>
</div>
</div>
</body>
</html>

