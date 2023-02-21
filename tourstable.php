<?php
// Establish a connection to the MySQL server
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'testdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the tours table
    $sql = "CREATE TABLE tours (
                Id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                place VARCHAR(255) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                description TEXT NOT NULL
            )";
    $conn->exec($sql);
    echo "Table tours created successfully.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>