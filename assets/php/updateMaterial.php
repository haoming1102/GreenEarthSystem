<?php
//get the data from manageMaterial.php
$materialID = $_POST["materialID"];
$materialName = $_POST["materialName"];
$pointsPerKg = $_POST["pointsPerKg"];
$description = $_POST["description"];

$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//update the material data
$updateData = "update material set MATERIAL_NAME='$materialName', POINTSPERKG='$pointsPerKg', DESCRIPTION='$description' where MATERIAL_ID='$materialID';";
if ($conn->query($updateData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Updated successfully!');
	window.location = '/BIT216/manageMaterial.php'; </script>";}
else{
	echo "Something went wrong, update fail.";}
?>
