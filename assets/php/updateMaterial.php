<?php
$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//get the data from manageMaterial.php
//prevent database error due to user's input
$materialID = $_POST["materialID"];
$materialName = mysqli_real_escape_string($conn, $_POST["materialName"]);
$description = mysqli_real_escape_string($conn, $_POST["description"]);
$pointsPerKg = mysqli_real_escape_string($conn, $_POST["pointsPerKg"]);

//update the material data
$updateData = "update material set MATERIAL_NAME='$materialName', POINTSPERKG='$pointsPerKg', DESCRIPTION='$description' where MATERIAL_ID='$materialID';";
if ($conn->query($updateData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Updated successfully!');
	window.location = '/BIT216/manageMaterial.php'; </script>";}
else{
	echo "update fail";}
?>
