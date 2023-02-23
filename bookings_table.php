<?php
// Set up the database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Create the bookings table if it doesn't already exist
  $sql = "CREATE TABLE IF NOT EXISTS bookings (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          user_id INT(6) NOT NULL,
          tour_id INT(6) NOT NULL,
          booking_date DATE NOT NULL,
          FOREIGN KEY (user_id) REFERENCES users(id),
          FOREIGN KEY (tour_id) REFERENCES tours(id)
          )";
  $conn->exec($sql);
  echo "Table bookings created successfully";
} catch(PDOException $e) {
  echo "Error creating table: " . $e->getMessage();
}
?>
