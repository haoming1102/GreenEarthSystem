<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";


$conn  = mysqli_connect($servername, $dbUsername, $dbPassword, 'greenearth');

if (!$conn) {
  die("Connection error: ".mysqli_connect_error());
}
