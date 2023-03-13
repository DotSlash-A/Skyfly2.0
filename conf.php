<?php
// Database configuration
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

// Create a database connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
