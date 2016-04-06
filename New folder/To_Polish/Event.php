<?php 
session_start();
include 'query.php'; 
//echo $_SESSION['tid'];

if(!isset($_SESSION['user']))
{
$_SESSION['noLog'] = 1;
header('location: CreateUser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Change Page Tiltle Here -->
<title>My Troop</title> 
<?php include 'bootstrap.html';?>
</head>
<body>
<!---------------------------------------------------------------- NAV BAR -------------------------------------------------------->
<?php include 'navBar.php'; ?>

<div class="container">
<div class="row-fluid">
<div class="col-md-12">
<h1>Events</h1>
<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#Tab1" data-toggle="tab">All Troop Events</a></li>
<li><a href="#Tab2" data-toggle="tab">Scouts</a></li>
<li style="float: right;"><a href="addEvent.php"><span class="glyphicon glyphicon-plus"></span> Add Event</a></li>				
</ul>

<!-- All Scouts tab and collapsing panel start -->
<div class="tab-content my-tab"> 
<div class="tab-pane active" id="Tab1">
<div class="row">
<div class="col-md-12">
<h3>All Events</h3>

<?php
$events = getAllEvents();
foreach($events as $event){
	$scouts = getAllScoutsInEvent($event['EID']);
?>
<!-- Modal content displaying Scout names-->
<div id="ModalEvent<?php echo $event["EID"]?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<tbody>
<tr style="text-align: left;">
<td><b>Scouts</b></td>
</tr>
<tr style="text-align: right;">
<td><b>Paid in Full:</b></td>
</tr>
<?php 
foreach($scouts as $scout) {
	$payedInFull = checkIfScoutPayedForEvent($scout['SID'], $event['EID']);
?>
<tr>
<td style="text-align: left;"><br><?php echo $scout['Name'];?></td>
<td style="text-align: right;"><b><?php if($payedInFull){echo "YES";} else{echo "NO";}?></b></td>
</tr>
<?php } ?>
</tbody>
</div>
</div>
</div>
</div>	
<!-- End of Modal displaying names -->

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="E<?php echo $event["EID"]; ?>" href="#collapseE<?php echo $event["EID"];?>">
<div class="row">
<?php echo $event["Title"]; ?>
</div>
</a>
<!-- id tag has capital E before eid and collapse has capital E to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
</h4>
</div>
<div id="collapseE<?php echo $event["EID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
<ul class="list-group">
<div class="container"> 													            
<table  style="width: 90%;">														
<tbody>
<tr>
<td><br><b> <?php echo $event['Description']?> </b></td>
</tr>
<tr>
<td><br><b> <?php echo "Dates: " . $event['StartDate'] . " (start) - " . $event['EndDate'] . " (end)";?> </b></td>
</tr>
<tr>
<td style="text-align: left;"><button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#ModalEvent<?php echo $event["EID"]?>">Scouts Attending</button></td>
<td style="text-align: right;"> 
<form action="editEvent.php" method="post">	
<button type="submit" class="btn btn-secondary btn-lg">Edit</button>
</form> 
</td>
<td style="text-align: right;">
<form action="deleteEventOp.php" method="post">
<input type="hidden" name="EID" value="<?php echo $event['EID'];?>">	
<button type="submit" class="btn btn-secondary btn-lg">Delete</button>
</form>
</td>
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
<!-- End of all troop events tab -->

<!-- Start of individual scout tab -->
<div class="tab-pane active" id="Tab2">
<div class="row">
<div class="col-md-12">
<h3>Individual Scouts</h3>

<?php
$scouts = getAllScouts();
foreach($scouts as $scout){
	$events = getAllEventsByScout($scout['SID']);
?>
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" id="S<?php echo $scout["SID"]; ?>" href="#collapseS<?php echo $scout["SID"];?>">
<div class="row">
<?php echo $scout["Name"]; ?>
</div>
</a>
<!-- id tag has capital S before sid and collapse has capital s to distinguish each unique collapse as to not interfere with panels with similar id numbers -->
</h4>
</div>
<div id="collapseS<?php echo $scout["SID"];?>" class="panel-collapse collapse" class="panel-collapse collapse">
<ul class="list-group">
<div class="container">
<table  style="width: 90%;">														
<tbody>
<tr>
<td><b>Event</b></td>
<td><b>Date Payed</b></td>
<td><b>Full Payment</b></td>
</tr>
<?php
foreach($events as $event){
		$finances = getAScoutsFinancesPerEvent($event['EID'], $scout['SID']);
		echo "<tr><td>". $event['Title'] . "</td>";
		echo "<td>" . $finances['DatePayed'] . "</td>";
		echo "<td>";
		if($finances['FullPayment'] == 0){
			echo "NO";
		} else {
			echo "YES";
		}
		echo "</td></tr>"
?> 													            
</tbody>
</table>
</div>
</ul>											
</div>
</div>
</div>
<?php }} ?>
</div>
</div>
</div>

<!------------------------------------------END OF TABS------------------------------------------>
</div>	
</div>
</div>
</div>			
</body>
</html>	
</body>