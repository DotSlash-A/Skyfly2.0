<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve bookings
$sql = "SELECT b.id, u.username, t.place, b.booking_date 
        FROM bookings b 
        JOIN users u ON b.user_id = u.id 
        JOIN tours t ON b.tour_id = t.id";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Display table of bookings
if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Username</th><th>Tour Name</th><th>Booking Date</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["place"]."</td><td>".$row["booking_date"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No bookings found.";
}

$conn->close();
?>
