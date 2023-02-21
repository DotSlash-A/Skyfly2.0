<?php

// Set up database connection
$servername = "localhost:3307";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=testdb", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the "users" table
    $sql = "CREATE TABLE users (
        id INT(11) NOT NULL AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        usertype ENUM('user', 'admin') NOT NULL DEFAULT 'user',
        PRIMARY KEY (id)
    )";

    // Use exec() because no results are returned
    $conn->exec($sql);
    echo "Table users created successfully";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$conn = null;
?>