<?php
$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//get the data from manageMaterial.php
//prevent database error due to user's input
$materialName = mysqli_real_escape_string($conn, $_POST["materialName"]);
$description = mysqli_real_escape_string($conn, $_POST["description"]);
$pointsPerKg = mysqli_real_escape_string($conn, $_POST["pointsPerKg"]);

//insert the material data
$insertData = "insert into Material(MATERIAL_NAME, POINTSPERKG, DESCRIPTION)
values ('$materialName', '$pointsPerKg', '$description');";
if ($conn->query($insertData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Material has been added successfully!');
	window.location = '/BIT216/manageMaterial.php'; </script>";
} else{
	echo "Error, cannot proceed.";
}
?>
