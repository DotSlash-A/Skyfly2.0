<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// // SQL query to create the "numofppl" table
// $sql = "CREATE TABLE numofppl (
//         id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//         tour_id INT(11) NOT NULL,
//         peoplecount INT(11) NOT NULL,
//         FOREIGN KEY (tour_id) REFERENCES tours(Id)
//     )";

$sql = "CREATE TABLE IF NOT EXISTS numofppl (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tour_id INT(6) NOT NULL,
  num_of_people INT(6) NOT NULL,
  FOREIGN KEY (tour_id) REFERENCES bookings(tour_id)
  )";

// Execute the query
if ($conn->query($sql) === TRUE) {
  echo "Table numofppl created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
