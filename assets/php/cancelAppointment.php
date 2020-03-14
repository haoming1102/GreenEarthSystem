<?php
//get the data from viewAppointment.php
$sID = $_POST["submission"];

$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

$deleteData = "DELETE FROM submission where SUBMISSION_ID='$sID';";
if ($conn->query($deleteData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Appointment has been cancelled.');
	window.location = '/BIT216/manageMaterial.php'; </script>";
}
?>
