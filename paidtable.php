<?php
// Connect to the database
$db_host = 'localhost:3307';
$db_user = 'root';
$db_pass = '';
$db_name = 'testdb';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create the "paid" table
$sql = "CREATE TABLE paid (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    tour_id INT(11) NOT NULL,
    paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tour_id) REFERENCES tours(id)
)";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Table paid created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
