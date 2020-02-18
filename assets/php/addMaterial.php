
<?php
//declare error count for checking the existing of user/email
$errors = array();

//get the data from manageMaterial.php
$materialName = $_POST["materialName"];
$pointsPerKg = $_POST["pointsPerKg"];
$description = $_POST["description"];

//connect to database
$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//use Material table
$materialTable = "use Material";
$result = $conn->query($materialTable);

//insert the material data
$insertData = "insert into Material(MATERIAL_NAME, POINTSPERKG, DESCRIPTION)
values ('$materialName', '$pointsPerKg', '$description');";
if ($conn->query($insertData)==TRUE){
	echo "<script type='text/javascript'>
	alert('Material has been added successfully!');
	window.location = '/BIT216/manageMaterial.php'; </script>";
}
?>
