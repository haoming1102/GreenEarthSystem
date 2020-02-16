<?php
//declare error count for checking the existing of user/email
$errors = array();

//get the data from manageMaterial.php
$materialID = $_POST["materialID"];

$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//use Material table
$materialTable = "use material";
$result = $conn->query($materialTable);

//delete the material 
$updateData = "DELETE FROM material where MATERIAL_ID='$materialID';";
if ($conn->query($updateData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Selected material has been removed successfully!');
	window.location = '/BIT216/manageMaterial.php'; </script>";}
else{
	echo "update fail";}
?>
