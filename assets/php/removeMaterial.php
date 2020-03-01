<?php
//get the data from manageMaterial.php
$materialID = $_POST["materialID"];

$conn = new mysqli("localhost","root","", "greenearth");
if ($conn->connect_error){
	die("Connection failure");
}

//check if the selected material can be removed or not
//since some collectors may hold it in their material collection
$sql = "SELECT * FROM collectormaterial WHERE MATERIAL_ID='$materialID'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) != 0)
{
	echo "<script type='text/javascript'>
	alert('Sorry, material cannot be removed because some collectors have holded it.');
	window.location = '/BIT216/manageMaterial.php'; </script>";
}
else{
//delete the material
	$deleteData = "DELETE FROM material where MATERIAL_ID='$materialID';";
	if ($conn->query($deleteData)==TRUE){
		echo "<script type='text/javascript'>
		alert('Selected material has been removed successfully!');
		window.location = '/BIT216/manageMaterial.php'; </script>";}
}
?>
