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
				largeAwardUpdate($_POST['names'],substr($_POST['requirements'][0], 0,4),$reqs,0);
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
	echo "<script>alert('Awards Updated Successfully!');</script>";
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
<title>Award Update</title> 
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
<h1>Update Award</h1>

<?php if(isset($_POST['BTab'])){ ?>

<ul class="nav nav-tabs" id="myTab">
<li class="active" ><a href="#Tab1" data-toggle="tab">Awards</a></li>

</ul>

<?php } else { ?>

<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#Tab1" data-toggle="tab">Awards</a></li>
</ul>
<?php } ?>

<div class="tab-content my-tab">  

<!----------------------------------------- Daisies tab collapsing panel start ------------------------------------------->                    
<div class="tab-pane active" id="Tab1">
	<div class="row">
	<div class="col-md-12">
	<h3>Awards</h3>
	<?php
	$awards = getAllAwards();
	$scoutsInRank = getAllScouts();
	foreach($awards as $award){
	?>
	<!-- Modal content displaying Scout names-->
	<div id="ModalScout<?php echo $award["AID"]?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Scouts</h4>
	</div>
	<div class="modal-body">
	<div id="nameCheckboxes">
	<form method="post" action = "UpdateAwardRecords.php">
	<p>
	<?php
	foreach($scoutsInRank as $scout){
		$shown = false;
		if(awardStatus($scout['SID'],$award['AID']) != 1){
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
	<a href="#Modal<?php echo $award["AID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#Modal<?php echo $award["AID"]?>"><button type="button" name="Next" id="Next" class="btn btn-default">Next</button></a>
	</div>
	</div>
	</div>	
	</div>

	<!-- Modal content displaying badge requirements-->
	<div id="Modal<?php echo $award["AID"]?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"><?php echo $award["Name"]?></h4>
	</div>
	<div class="modal-body">
	<div id="reqCheckboxes">
	<form method="post" action = "UpdateBadgeRecords.php">
	<p>
	<?php
	
	foreach(getAwardRequirements($award["AID"]) as $req){
		$Name = str_replace(array('"','\''), "", $req["Name"]);
		$Comments = str_replace(array('"','\''), "", $req["Comments"]);
		echo "<input type='checkbox' name='requirements[]' value='" . $req['ARID'] . "'>" . '&nbsp&nbsp&nbsp<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Comments . '">' . $Name. '</a>' . "<br>" ;
	}
	
	?>
	</p>
	</div>
	</div>
	<div class="modal-footer">
	<a href="#ModalScout<?php echo $award["AID"]?>" data-dismiss="modal" data-toggle="modal" data-target="#ModalScout<?php echo $award["AID"]?>"><button type="button" class="btn btn-default pull-left">Back</button></a>
	<form method="post" action = "UpdateAwardRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form>
	</div>
	</div>
	</div>	
	</div>

	<!--This is for the actual panel -->
	<div class="panel-group">
	<div class="panel panel-default">
	<div class="panel-heading">
	<h4 class="panel-title">
	<a data-toggle="collapse" class="<?php echo $award["AID"]; ?>" href="#collapse<?php echo $award["AID"]?>"><div class="row"><?php echo $award["Name"]; ?></div></a>
	</h4>
	</div>
	<div id="collapse<?php echo $award["AID"]?>" class="panel-collapse collapse">
	<ul class="list-group">
	<div class="container"> 
	<table style="width=33%">
	<tbody>
	<tr>
	<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalScout<?php echo $award["AID"]?>">Update</button></td>									
	<!--<td align="left"> <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#Modal<?php echo $award["AID"]?>">Requirements</button></td>
	<td align="left"> <form method="post" action = "UpdateAwardRecords.php"><input type="submit" name="submitform" value="Update" class="btn btn-default"></form></td>-->
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

