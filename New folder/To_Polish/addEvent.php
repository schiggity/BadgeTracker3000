<?php 
include 'query.php'; 
session_start();

if(!isset($_SESSION['user']))
{
$_SESSION['noLog'] = 1;
header('location: CreateUser.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Template</title> <!-- Change Page Tiltle Here -->
<!---------------------------------------------------- Stuff that is necessary for Bootstrap --------------------------------------------->
<?php include 'bootstrap.html';?>
<link rel="stylesheet" type="text/css" href="CreateEventCSS.css">
</head>
<body>

<!---------------------------------------------------------------- NAV BAR STUFF -------------------------------------------------------->
<?php include 'navBar.php'; ?>


<!-------------------------------------------------------------- TABS STUFF ------------------------------------------------------------->
<div class="container-fluid">
<div class="row">
<div class="col-md-3">
<!-- Intentionally left blank -->
</div>
<div id="CreateUserBlock" class="col-md-6 no-float">
<div class="col-md-1">
<!-- Intentionally left blank -->
</div>
<div id="addForm" class="col-md-10 ">
<h1>Add Event</h1>
<form role="form" method="post" action="AddEventOp.php">
<!--Scout Amount owed Amount paid -->

<div class="col-md-6">
<label>Select Scouts Going to Event</label>
<div>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalScout">Scouts</button>
</div>
</div>

<!---->
<?php
$scouts = getAllScouts();
?>
<!-- Modal content displaying Scout names-->
<div id="ModalScout" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Scouts</h4>
</div>
<div class="modal-body">
<div id="nameCheckboxes">
<form action="addEventOp.php" method="post">
<p>
<?php
foreach($scouts as $scout){
echo "<input type='checkbox' name='names[]' value='" . $scout['SID'] . "'> " . $scout['Name'] . "<br>";
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
<!-- End of Modal -->

<!--Enter Title -->
<div class="col-md-12"> 
<div class="form-group">
<label for="Title">Title</label>
<div class="input-group">
<input class="form-control" id="Title" name="Title" type="text" placeholder="Title of the event.">
</div>
</div>
</div>

<!--Enter Description -->
<div class="col-md-12"> 
<div class="form-group">
<label for="Description">Description</label>
<input class="form-control" id="Description" name="Description" type="text" placeholder="Description of event.">
</div>
</div>

<div class="col-md-12"> 
<div class="form-group">
<label for="startDate"> Start Date </label><br>
<div class="col-xs-2"> 
<label for="startDay"> Day </label>
<input class="form-control" id="startDay" name="startDay" type="text" placeholder="ex. 01">
</div>
<div class="col-xs-2"> 
<label for="startMonth"> Month </label>
<input class="form-control" id="startMonth" name="startMonth" type="text" placeholder="ex. 01">
</div>
<div class="col-xs-3"> 
<label for="startYear"> Year </label>
<input class="form-control" id="startYear" name="startYear" type="text" placeholder="ex. 1970">
</div>
</div>
</div>
<br><br><br>

<div class="col-md-12"> 
<div class="form-group">
<label for="startDate"> End Date </label><br>
<div class="col-xs-2"> 
<label for="endDay"> Day </label>
<input class="form-control" id="endDay" name="endDay" type="text" placeholder="ex. 01">
</div>
<div class="col-xs-2"> 
<label for="endMonth"> Month </label>
<input class="form-control" id="endMonth" name="endMonth" type="text" placeholder="ex. 01">
</div>
<div class="col-xs-3"> 
<label for="endYear"> Year </label>
<input class="form-control" id="endYear" name="endYear" type="text" placeholder="ex. 1970">
</div>
</div>
</div>
<br><br><br><br>

<div class="col-md-12"><label for="Finance" style="font-size: 20px;">Financial</label></div>
<div class="col-md-12"> <!--Enter Amount -->
<div class="form-group">
<label for="Amount">Amount</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input class="form-control" id="Amount" name="Amount" pattern="[0-9]+" type="text" placeholder="ex. 12.50">
</div>
</div>
</div>

<div class="col-md-12"> <!--Enter Purpose -->
<div class="form-group">
<label for="Purpose">Purpose</label>
<input class="form-control" id="Purpose" name="Purpose" type="text" placeholder="Description">
</div>
</div>

<!--Submit -->
<div class="col-md-12"> 
<div class="form-group">
<button type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="Add Event">Submit</button>
</form>
</div>
</div>

</div>
<div class="col-md-1">
<!-- Intentionally left blank -->
</div>
</div>
<div class="col-md-3">
<!-- Intentionally left blank -->
</div>
</div>
</div>
</body>
</html>
