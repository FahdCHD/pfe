<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$db_name = "pfe";

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
	echo "connection failed: " . $conn->connect_error;
}
?>