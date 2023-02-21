<?php
// Establish database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the tour to be deleted
$id = $_POST['id'];

// Delete the tour from the tours table
$sql = "DELETE FROM tours WHERE Id=".$id;
if ($conn->query($sql) === TRUE) {
    // Redirect to index.php with success message
    header("Location: trydel.php?delete=success");
} else {
    echo "Error deleting tour: " . $conn->error;
}

// Close database connection
$conn->close();
?>
