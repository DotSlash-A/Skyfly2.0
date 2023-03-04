<?php
// Connect to database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users who have booked all tours
$sql = "SELECT u.id, u.username
        FROM users u
        JOIN bookings b ON u.id = b.user_id
        WHERE NOT EXISTS (
          SELECT t.id FROM tours t
          WHERE NOT EXISTS (
            SELECT * FROM bookings b2
            WHERE b2.tour_id = t.id AND b2.user_id = u.id
          )
        )";

// Execute query and fetch results
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    echo "User ID: " . $row["id"]. " - Username: " . $row["username"]. "<br>";
  }
} else {
  echo "No users found.";
}

// Close database connection
$conn->close();
?>
