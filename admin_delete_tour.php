
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

// Delete the records from the datetour table that reference the record to be deleted from the tours table
$sql = "DELETE FROM datetour WHERE tour_id=".$id;
if ($conn->query($sql) === TRUE) {
    // Delete the record from the tours table
    $sql = "DELETE FROM tours WHERE Id=".$id;
    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php with success message
        header("Location: admin_dashboard_del.php?delete=success");
    } else {
        echo "Error deleting tour: " . $conn->error;
    }
} else {
    echo "Error deleting tour: " . $conn->error;
}

// Close database connection
$conn->close();
?>