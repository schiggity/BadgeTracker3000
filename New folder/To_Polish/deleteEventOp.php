<?php
include('query.php');
session_start();
$val = $_POST['EID'];
deleteEvent($val);
echo 'Event Deleted';
header('location: Event.php');
?>