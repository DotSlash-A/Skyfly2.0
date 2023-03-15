<?php

// Database connection parameters
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

// SQL query to create the table
$sql = "CREATE TABLE cardstable (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
cardnumber VARCHAR(16) NOT NULL,
year INT(4) NOT NULL,
name VARCHAR(50) NOT NULL,
phonenumber VARCHAR(15) NOT NULL,
userid INT(6) NOT NULL,
FOREIGN KEY (userid) REFERENCES users(id)
)";

// Execute query
if ($conn->query($sql) === TRUE) {
  echo "Table cards created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();

?>
