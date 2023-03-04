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

// Get hotel ID from the URL parameter
$tour_id = $_GET['tour_id'];

// Select all bookings that match the hotel ID
$sql = "SELECT * FROM bookings WHERE tour_id = $tour_id";
$result = $conn->query($sql);

// Display all bookings in a table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found for this hotel.";
}

// Close database connection
$conn->close();
?>
