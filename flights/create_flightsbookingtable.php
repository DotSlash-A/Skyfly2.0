<?// Establish database connection
	include 'config.php';

  // Create a connection to the database
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check if the connection is successful
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }


// Create flightsbooking table if it does not already exist
$sql = "CREATE TABLE IF NOT EXISTS flightsbooking (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  flight_id INT(11) NOT NULL,
  booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (flight_id) REFERENCES newflights(id)
)";

if (mysqli_query($conn, $sql)) {
  echo "flightsbooking table created successfully";
} else {
  echo "Error creating flightsbooking table: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>