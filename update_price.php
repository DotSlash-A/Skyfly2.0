<?php
// Connect to the MySQL database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get the tour ID and new price from the form
$id = $_POST["id"];
$new_price = $_POST["new_price"];

// Update the price in the database
$sql = "UPDATE tours SET price = '$new_price' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
	echo "Price updated successfully";
} else {
	echo "Error updating price: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>